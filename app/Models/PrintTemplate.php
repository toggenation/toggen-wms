<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use League\Glide\Server;

class PrintTemplate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setTemplateAttribute($template)
    {
        if (!$template) return;

        $path = config('toggen.print.template.templates');

        $this->handleUploadAttribute($template, 'template', $path);
    }

    public function setImageAttribute($image)
    {
        if (!$image) return;

        $path = config('toggen.print.template.examples');

        $this->handleUploadAttribute($image, 'image', $path);
    }

    protected function handleUploadAttribute($field, $attribute, $dir)
    {
        $this->attributes[$attribute] = $field instanceof UploadedFile
            ? $field->storeAs($dir, $field->getClientOriginalName())
            : $field;
    }

    public function getImageSettings()
    {
        $route = request()->route()->getName();

        if ($route == 'admin.print-templates.edit') {
            return ['w' => 210, 'h' => 297, 'fit' => 'contain', 'border' => '1,lightgray,shrink'];
        }

        return ['w' => 30, 'h' => 40, 'fit' => 'contain', 'border' => '1,lightgray,shrink'];
    }
    public function getImageUrlAttribute()
    {

        return $this->photoUrl($this->getImageSettings());
    }

    public function photoUrl(array $attributes)
    {


        if ($this->image) {
            //$path = storage_path('app');

            $glide = App::make(Server::class);
            $path = url($glide->getBaseUrl() . '/' . $this->image) . "?";
            $path .= http_build_query($attributes);

            return $path;
        }
    }

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
