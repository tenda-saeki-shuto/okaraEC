<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use App\Models\Quizzes;
use App\Models\QuizSelections;
use App\Models\QuizStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Termwind\Components\Raw;

class QuizController extends Controller
{
    private $quiz;

    public function __construct(Quizzes $quiz)
    {
        $this->quiz = $quiz;
    }
    public function index()
    {
        $quizzes = Quizzes::orderBy("updated_at", "desc")->paginate(20);
        return view("admin.quiz_index", compact('quizzes'));
    }

    public function create()
    {
        $quiz = $this->quiz;
        $selections = ['', '', '', ''];
        return view('admin.quiz_create', compact('quiz', 'selections'));
    }
    public function store(Request $request)
    {
        $quiz_main = $request->validate([
            'title' => 'required|max:30',
            'content' => 'required|max:300',
            'img' => 'nullable|max:300',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);
        $selections = $request->validate([
            'selections.*' => 'required|max:20',
        ]);
        $answer = $request->validate([
            'answer' => 'required|max:20',
        ]);

        $quiz = Quizzes::create($quiz_main);
        foreach ($selections['selections'] as $selection_content) {
            $selection['quiz_id'] = $quiz->id;
            $selection['content'] = $selection_content;
            QuizSelections::create($selection);
        }
        QuizSelections::create([
            "quiz_id" => $quiz->id,
            "content" => $answer['answer'],
            "is_answer" => true,
        ]);

        $request->session()->flash('message', '保存しました');
        return redirect()->route('quiz.index');
    }
    public function show($id) {}
    public function edit(Quizzes $quiz)
    {
        $selections = $quiz->quizSelections;
        return view('admin.quiz_edit', compact('quiz', 'selections'));
    }
    public function update(Request $request, Quizzes $quiz)
    {
        $quiz_main = $request->validate([
            'title' => 'required|max:30',
            'content' => 'required|max:300',
            'img' => 'nullable|max:300',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);
        $selections = $request->validate([
            'selections.*' => 'required|max:20',
        ]);
        $answer = $request->validate([
            'answer' => 'required|max:20',
        ]);

        $quiz->update($quiz_main);
        foreach ($selections['selections'] as $selection_content) {
            $selection['quiz_id'] = $quiz->id;
            $selection['content'] = $selection_content;
            $quiz->QuizSelections()->update($selection);
        }
        $quiz->QuizSelections()->update([
            "quiz_id" => $quiz->id,
            "content" => $answer['answer'],
            "is_answer" => true,
        ]);

        $request->session()->flash('message', '更新しました');
        return redirect()->route('quiz.index');
    }
    public function destroy($id) {}

    // ユーザー側クイズ表示
    public function user_index()
    {
        $user = Auth::user();
        $todayMonth = Carbon::today()->month;

        $quiz_list = Quizzes::with([
            'quizSelections',
            'quizStatus' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }
        ])
            ->whereMonth('start', $todayMonth)
            ->first();
        // dd($quiz_list);
        return view('user.quiz', compact('quiz_list'));
    }

    //クイズの正解表示
    public function answer(Request $request)
    {
        //ユーザーの回答した選択肢
        $user_answer = QuizSelections::find($request->selection_id);
        //ユーザー情報
        $user = Auth::user();
        //クーポン情報
        $coupon = Coupon::find(2);


        if ($user_answer->is_answer === 1) {
            $answer = $user_answer;
            $is_answer = True;
            $massage = '正解！！';

            UserCoupon::create([
                'user_id' => $user->id,
                'coupon_id' => $coupon->id,
                'available' => 1
            ]);
        } else {
            //クイズの正解の選択肢
            $answer = QuizSelections::where('quiz_id', $user_answer->quiz_id)
                ->where('is_answer', 1)
                ->first();

            $is_answer = False;
            $massage = 'ざんね～ん';
        }


        // 回答処理、クイズステータスに追加
        QuizStatus::create([
            'quizzes_id' =>  $user_answer->quiz_id,
            'user_id' => $user->id,
        ]);

        return view('user.quiz_answer', compact('answer', 'is_answer', 'massage', 'coupon'));
    }
}
