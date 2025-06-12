<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tel', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //とのリレーション
    //アドレス（住所）
    public function address()
    {
        return $this->hasOne(Address::class);
    }
    public function userLikes()
    {
        return $this->hasMany(UserLike::class, 'user_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }
    public function regularOrders()
    {
        return $this->hasMany(RegularOrder::class, 'user_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
    public function userCoupons()
    {
        return $this->hasMany(UserCoupon::class, 'user_id');
    }

    public function addresses()
    {
        return $this->hasOne(Address::class, 'user_id');

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class);

    }
}
