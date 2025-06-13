<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiries extends Model
{
     protected $fillable = [
        'name',
        'tel',
        'Email',
        'inquiry',
    ];
}
