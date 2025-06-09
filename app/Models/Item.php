<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //カテゴリとのリレーション
    public function items()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    //商品関連とのリレーション
    public function itemPictures()
    {
        return $this->hasMany(ItemPicture::class);
    }
    public function itemAllergies()
    {
        return $this->hasOne(ItemAllergy::class);
    }
    public function nutritionFacts()
    {
        return $this->hasOne(NutritionFact::class);
    }
    //ユーザー・注文関連とのリレーション
    public function userLikes()
    {
        return $this->hasMany(UserLike::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function regularOrders()
    {
        return $this->hasMany(RegularOrder::class);
    }
}
