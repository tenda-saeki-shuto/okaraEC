<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredients extends Model
{
    protected $fillable = [
        'recipe_id',
        'name',
        'amount',
    ];
    public function Recipes()
    {
        return $this->belongsTo(Recipes::class);
    }
}
