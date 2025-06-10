<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredients extends Model
{
    public function Recipes()
    {
        return $this->belongsTo(Recipes::class);
    }
}
