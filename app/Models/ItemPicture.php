<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPicture extends Model
{
    protected $fillable = [
        'item_id',
        'img',
    ];
    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
