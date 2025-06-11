<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipes extends Model
{
    protected $fillable = [
        'title',
        'content',
        'img',
        'time',
        'amount',
        'category_id',
    ];
    //
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function recipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    public function recipeSteps()
    {
        return $this->hasMany(RecipeStep::class);
    }

    public function RecipeNutritionFact()
    {
        return $this->hasMany(RecipeNutritionFact::class);
    }
}
