<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    //注文とのリレーション
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
