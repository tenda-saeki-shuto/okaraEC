<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSelections extends Model
{
    public function Quizzes()
    {
        return $this->belongsTo(Quizzes::class);
    }
}
