<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
            $query->orWhere('description', 'like', '%' . $search . '%');
        })->when($filters['active'] ?? null, function ($query, $active) {
            if ($active === 'active') {
                $query->where('active', true);
            } elseif ($active === 'not-active') {
                $query->where('active', false);
            }
        });
    }

    public function product_types()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }
}
