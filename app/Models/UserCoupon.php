<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    protected $fillable = [
        'user_id',
        'coupon_id',
        'available'
    ];
    //ユーザーとのリレーション
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //都道府県とのリレーション
    public function coupons()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}
