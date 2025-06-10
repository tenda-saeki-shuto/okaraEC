<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quizzes extends Model
{
    // public function QuizStatus()
    // {
    //     return $this->hasMany(QuizStatus::class);
    // }

    public function QuizSelections()
    {
        return $this->hasMany(QuizSelections::class);
    }
}
