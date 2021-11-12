<?php

namespace App\Providers;

use App\Services\Batch;
use App\Services\BatchYDDDXX;
use League\Glide\Server;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        JsonResource::withoutWrapping();
    }

    public function register()
    {
        $this->app->bind(Batch::class, BatchYDDDXX::class);
        $this->registerGlide();
    }

    protected function registerGlide()
    {
        $this->app->bind(Server::class, function ($app) {
            // dd(Storage::getDriver());
            return ServerFactory::create([
                'response' => new LaravelResponseFactory(app('request')),
                'source' => Storage::getDriver(),
                'cache' => Storage::getDriver(),
                'cache_path_prefix' => '.glide-cache',
                'base_url' => '/img/',
            ]);
        });
    }
}
