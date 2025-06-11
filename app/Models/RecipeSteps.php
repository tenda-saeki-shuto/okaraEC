<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeSteps extends Model
{
    protected $fillable = [
        'recipe_id',
        'content',
        'img',
    ];
    public function Recipes()
    {
        return $this->belongsTo(Recipes::class);
    }
}
