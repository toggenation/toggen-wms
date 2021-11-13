<?php

use App\Lib\Barcode\Sscc;
use App\Lib\IconList;
use App\Models\Setting;
use App\Services\Barcode;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('sscc/{sscc?}', function ($sscc = null) {

    $sscc = (new Sscc(new Setting))->get($sscc);

    dd($sscc);
});

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
