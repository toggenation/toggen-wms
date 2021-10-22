<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $appends = ['code_description'];

    public function getCodeDescriptionAttribute()
    {
        // join with ' - ' but only if not empty
        return join(' - ', array_filter(
            [
                $this->attributes['code'], $this->attributes['description'],

                $this->attributes['quantity']
            ]

        ));
    }
}
