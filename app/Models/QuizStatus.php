<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizStatus extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Quizzes()
    {
        return $this->hasMany(Quizzes::class);
    }
}
