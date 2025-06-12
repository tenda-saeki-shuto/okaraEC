<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeNutritionFact extends Model
{
    protected $fillable = [
        'recipe_id',
        'energy',
        'protein',
        'fat',
        'carb',
        'fiber',
        'salt_eqv',
    ];

    public function Recipes()
    {
        return $this->belongsTo(Recipes::class);
    }
}

