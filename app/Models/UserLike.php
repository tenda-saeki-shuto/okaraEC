<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    //
    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
