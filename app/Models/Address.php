<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //ユーザーとのリレーション
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    //都道府県とのリレーション
    public function prefectures()
    {
        return $this->belongsTo(Prefecture::class, 'prefecture_id');
    }

    //代入の許可
    protected $fillable = [
        'user_id',
        'postal_code',
        'prefecture_id',
        'address',
    ];
}
