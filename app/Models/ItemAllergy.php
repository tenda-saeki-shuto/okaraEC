<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemAllergy extends Model
{
    //商品とのリレーション
    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    //アレルギー参照とのリレーション
    public function allergies()
    {
        return $this->belongsTo(Allergy::class, 'allergy_id');
    }
}
