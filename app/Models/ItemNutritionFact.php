<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemNutritionFact extends Model
{
    protected $fillable = [
        'item_id',
       'energy',
        'protein',
        'fat',
        'carb',
        'salt_eqv',
        'fiber',
    ];
    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
