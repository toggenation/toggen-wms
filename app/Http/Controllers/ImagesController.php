<?php

namespace App\Http\Controllers;

use League\Glide\Server;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;



class ImagesController extends Controller
{
    public function show(Server $glide, $path)
    {
        return $glide->getImageResponse($path, request()->all());
    }
}
