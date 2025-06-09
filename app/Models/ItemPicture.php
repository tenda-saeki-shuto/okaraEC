<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPicture extends Model
{
    //
    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
