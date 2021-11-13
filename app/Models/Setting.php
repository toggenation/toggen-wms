<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function get($name)
    {
        return self::where('name', $name)->firstOrFail()->setting;
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
            $query->orWhere('setting', 'like', '%' . $search . '%');
        })->when($filters['active'] ?? null, function ($query, $active) {
            if ($active === 'active') {
                $query->where('active', true);
            } elseif ($active === 'not-active') {
                $query->where('active', false);
            }
        });
    }
}
