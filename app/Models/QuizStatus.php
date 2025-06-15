<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizStatus extends Model
{

    protected $table = 'quiz_status';

    protected $fillable = [
        'quizzes_id',
        'user_id',
        'is_clear'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Quizzes()
    {
        return $this->hasMany(Quizzes::class);
    }
}
