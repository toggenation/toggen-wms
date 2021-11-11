<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class PrintTemplate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setTemplateAttribute($template)
    {
        // dd(config('toggen.templates'));
        // dd(storage_path('app/public'));
        if (!$template) return;

        $path = config('toggen.print.template.templates');

        $this->handleUploadAttribute($template, 'template', $path);
    }



    public function setImageAttribute($image)
    {
        // dd(config('toggen.templates'));
        // dd(storage_path('app/public'));

        if (!$image) return;
        // {
        //     // don't null out image if it's not there
        //     unset($this->attributes['image']);
        //     return;
        // }


        $path = config('toggen.print.template.examples');

        $this->handleUploadAttribute($image, 'template', $path);

        // $this->attributes['image'] = $image instanceof UploadedFile
        //     ? $image->storeAs($path, $image->getClientOriginalName())
        //     : $image;
    }

    protected function handleUploadAttribute($field, $attribute, $dir)
    {
        dd($field);
        $this->attributes[$attribute] = $field instanceof UploadedFile
            ? $field->storeAs($dir, $field->getClientOriginalName())
            : $field;
    }

    //   public function getTemplateAttribute()
    // {
    //     return $this->photoUrl(['w' => 40, 'h' => 40, 'fit' => 'crop']);
    // }

    // public function photoUrl(array $attributes)
    // {
    //     if ($this->photo_path) {
    //         return URL::to(App::make(Server::class)->fromPath($this->photo_path, $attributes));
    //     }
    // }


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
}
