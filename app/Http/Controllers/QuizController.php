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

        // 今月のクイズを取得
        $quiz_list = Quizzes::with([
            'quizSelections',
            'quizStatus' => function ($query) use ($user) {
                if ($user) {
                    $query->where('user_id', $user->id);
                }
            }
        ])
            ->whereMonth('start', $todayMonth)
            ->first();

        // すでに回答済みならリダイレクト
        // if ($user && $quiz_list && $quiz_list->quizStatus->isNotEmpty()) {
        //     return redirect()->route('user.quiz')->with('message', 'すでにクイズに回答済みです');
        // }

        $quiz_list_past = Quizzes::whereMonth('start', '<', $todayMonth)->get();

        return view('user.quiz', compact('quiz_list', 'quiz_list_past'));
    }



    //クイズの正解表示
    public function answer(Request $request)
    {
        // ユーザーの回答した選択肢
        $user_answer = QuizSelections::find($request->selection_id);
        $user = Auth::user();
        $coupon = Coupon::find(2);

        // 正解・不正解判定
        if ($user_answer->is_answer === 1) {
            $answer = $user_answer;
            $is_answer = 1;
            $message = '正解！！';

            // ログインしていればクーポン付与
            if ($user) {
                $now = Carbon::now(); //今の日付
                $base_day = $now->day; //今の日にち
                $two_months_later = $now->copy()->addMonths(2); //2か月後の日付
                $valid_at = $base_day > $two_months_later->daysInMonth //2か月後に日にちがなければ
                    ? $two_months_later->endOfMonth() //月末に
                    : $two_months_later->day($base_day); //そうでなければその日に

                //クーポン追加
                UserCoupon::create([
                    'user_id' => $user->id,
                    'coupon_id' => $coupon->id,
                    'valid_at' => $valid_at
                ]);
            } else {
                // ゲストならセッションに保存
                session([
                    'guest_quiz_id' => $user_answer->quiz_id,
                    'guest_selection_id' => $user_answer->id,
                    'guest_is_answer' => $is_answer,
                    'redirect_after_login' => route('user.quiz'),
                ]);

                //セッションにクイズでクーポンを発行したことを保存
                session()->flash('coupon_quiz', 'クイズ正解おめでとうございます<br>クーポンを獲得しました');
            }
        } else {
            // 不正解時の正解選択肢取得
            $answer = QuizSelections::where('quiz_id', $user_answer->quiz_id)
                ->where('is_answer', 1)
                ->first();

            $is_answer = 0;
            $message = 'ざんね～ん';

            // 不正解でもセッションに保存
            if (!Auth::check()) {
                session([
                    'guest_quiz_id' => $user_answer->quiz_id,
                    'guest_selection_id' => $user_answer->id,
                    'guest_is_answer' => $is_answer,

                    'redirect_after_login' => route('user.quiz_answer'),
                ]);
            }
        }

        // 回答履歴を保存（ログインユーザーのみ）
        if ($user) {
            QuizStatus::create([
                'quizzes_id' => $user_answer->quiz_id,
                'user_id' => $user->id,
                'is_clear' => $is_answer
            ]);
        }

        return view('user.quiz_answer', compact('answer', 'is_answer', 'message', 'coupon'));
    }

    //過去のクイズ画面
    public function past_index($id)
    {
        //クイズを取得
        $quiz_list = Quizzes::with('quizSelections')->where('id', $id)->first();

        return view('user.quiz_past', compact('quiz_list'));
    }

    public function past_answer(Request $request)
    {
        // ユーザーの回答した選択肢
        $user_answer = QuizSelections::find($request->selection_id);

        // 正解・不正解判定
        if ($user_answer->is_answer === 1) {
            $answer = $user_answer;
            $is_answer = 1;
            $message = '正解！！';
        } else {
            // 不正解時の正解選択肢取得
            $answer = QuizSelections::where('quiz_id', $user_answer->quiz_id)
                ->where('is_answer', 1)
                ->first();

            $is_answer = 0;
            $message = 'ざんね～ん';
        }
        return view('user.quiz_past_answer', compact('answer', 'is_answer', 'message'));
    }
}
