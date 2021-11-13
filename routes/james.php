<?php

use App\Lib\IconList;
use Illuminate\Support\Facades\Route;

Route::get('readjs', function () {

    $iconList = (new IconList)->get();

    dd($iconList);

    dd([
        "app_path" => app_path(),
        "base_path" => base_path(),
        "config_path" => config_path(),
        "database_path" => database_path(),
        // "mix" => mix(),
        "public_path" => public_path(),
        "resource_path" => resource_path(),
        "storage_path" => storage_path()

    ]);

    /*
array:7 [▼
  "app_path" => "/var/www/html/app"
  "base_path" => "/var/www/html"
  "config_path" => "/var/www/html/config"
  "database_path" => "/var/www/html/database"
  "public_path" => "/var/www/html/public"
  "resource_path" => "/var/www/html/resources"
  "storage_path" => "/var/www/html/storage"
]
    */
});
