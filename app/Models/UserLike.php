<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    //商品とのリレーション
    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    //ユーザーとのリレーション
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
