<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Quizzes;
use App\Models\QuizSelections;

class QuizController extends Controller
{
    //
    public function index()
    {
        
        return view("admin.quiz_create"); // あとで変える
    }
    public function create()
    {
        return view('admin.quiz_create');
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
            'content' => 'required|max:20',
        ]);

        $quiz = Quizzes::create($quiz_main);
        var_dump($quiz->id);
        foreach ($selections['selections'] as $selection_content) {
            var_dump($selection_content);
            $selection['quiz_id'] = $quiz->id;
            $selection['content'] = $selection_content;
            QuizSelections::create($selection);
        }
        $answer['quiz_id'] = $quiz->id;
        $answer['is_answer'] = true;
        var_dump($answer);
        QuizSelections::create($answer);

        $request->session()->flash('message', '保存しました');
        return redirect()->route('quiz.index');
    }
    public function show($id)
    {
    }
    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }

}
