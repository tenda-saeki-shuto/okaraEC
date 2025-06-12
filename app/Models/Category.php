<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function items()
    {
        return $this->hasMany(Item::class);
    }    public function recipes()
    {
        return $this->hasMany(Recipes::class, 'category_id', 'id');
    }
}
