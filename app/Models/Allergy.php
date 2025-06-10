<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    //
    public function itemAllergies()
    {
        return $this->hasMany(ItemAllergy::class);
    }
}
