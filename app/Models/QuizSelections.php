<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSelections extends Model
{
    protected $fillable = [
        'quiz_id',
        'content',
        'is_answer',
    ];
    public function Quizzes()
    {
        return $this->belongsTo(Quizzes::class);
    }
}
