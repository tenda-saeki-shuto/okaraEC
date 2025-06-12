<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'price',
        'content',
        'img',
        'category_id',
        'stock',
        'is_cold',
        'is_frozen',
    ];
    //カテゴリとのリレーション
    public function categories()
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
        return $this->hasMany(ItemAllergy::class);
    }
    public function nutritionFacts()
    {
        return $this->hasOne(ItemNutritionFact::class);
    }


    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'user_likes', 'item_id', 'user_id');
    }


    //ユーザー・注文関連とのリレーション
    // public function userLikes()
    // {
    //     return $this->hasMany(UserLike::class);
    // }
    // public function carts()
    // {
    //     return $this->hasMany(Cart::class);
    // }
    // public function regularOrders()
    // {
    //     return $this->hasMany(RegularOrder::class);
    // }
}
