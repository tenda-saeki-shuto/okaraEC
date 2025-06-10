<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //ユーザーとのリレーション
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    //注文詳細とのリレーション
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }
}
