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
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function recipeIngredients()
    {
        return $this->hasMany(RecipeIngredients::class, 'recipe_id');
    }

    public function recipeSteps()
    {
        return $this->hasMany(RecipeSteps::class, 'recipe_id');
    }
    public function recipeNutritionFacts()
    {
        return $this->hasOne(RecipeNutritionFact::class, 'recipe_id');
    }
}
