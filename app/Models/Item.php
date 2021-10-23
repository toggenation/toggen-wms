<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['code_description'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('description', 'like', '%' . $search . '%');
            $query->orWhere('code', 'like', '%' . $search . '%');
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }


    public function getCodeDescriptionAttribute()
    {
        // join with ' - ' but only if not empty
        return join(' - ', array_filter(
            [
                $this->attributes['code'],
                $this->attributes['description'],
                $this->attributes['quantity']
            ]

        ));
    }

    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }
    public function unit_of_measure()
    {
        return $this->belongsTo(UnitsOfMeasure::class);
    }
}
