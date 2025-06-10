<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //注文とのリレーション
    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
