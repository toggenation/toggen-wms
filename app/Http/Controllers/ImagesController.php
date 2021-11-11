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

    public function testShow(Server $glide, $path)
    {
        dd($glide->getBaseUrl());
        return $glide->getImageResponse($path, request()->all());
    }

    // public function testShow(Filesystem $filesystem, $path)
    // {
    //     // dd($filesystem->getDriver());
    //     $server = ServerFactory::create([
    //         'response' => new LaravelResponseFactory(app('request')),
    //         'source' => $filesystem->getDriver(),
    //         'cache' => $filesystem->getDriver(),
    //         'cache_path_prefix' => '.cache',
    //         'base_url' => 'img',
    //     ]);

    //     return $server->getImageResponse($path, request()->all());
    // }
}
