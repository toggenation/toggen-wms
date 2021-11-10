<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth

use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\BlankController;
use App\Models\Menu;
use App\Models\Item;
use App\Models\ProductionLine;
use App\Rules\BarcodeRule;
use App\Services\Barcode;
use App\Services\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;


Route::get('login')->name('login')->uses('Auth\LoginController@showLoginForm')->middleware('guest');
Route::post('login')->name('login.attempt')->uses('Auth\LoginController@login')->middleware('guest');
Route::post('logout')->name('logout')->uses('Auth\LoginController@logout');

// Dashboard
Route::get('/')->name('dashboard')->uses('DashboardController')->middleware('auth');

// Users
Route::get('users')->name('users')->uses('UsersController@index')->middleware('remember', 'auth');
Route::get('users/create')->name('users.create')->uses('UsersController@create')->middleware('auth');
Route::post('users')->name('users.store')->uses('UsersController@store')->middleware('auth');
Route::get('users/{user}/edit')->name('users.edit')->uses('UsersController@edit')->middleware('auth');
Route::put('users/{user}')->name('users.update')->uses('UsersController@update')->middleware('auth');
Route::delete('users/{user}')->name('users.destroy')->uses('UsersController@destroy')->middleware('auth');
Route::put('users/{user}/restore')->name('users.restore')->uses('UsersController@restore')->middleware('auth');

// Images
Route::get('/img/{path}', 'ImagesController@show')->where('path', '.*');

// Organizations
Route::get('organizations')->name('organizations')->uses('OrganizationsController@index')->middleware('remember', 'auth');
Route::get('organizations/create')->name('organizations.create')->uses('OrganizationsController@create')->middleware('auth');
Route::post('organizations')->name('organizations.store')->uses('OrganizationsController@store')->middleware('auth');
Route::get('organizations/{organization}/edit')->name('organizations.edit')->uses('OrganizationsController@edit')->middleware('auth');
Route::put('organizations/{organization}')->name('organizations.update')->uses('OrganizationsController@update')->middleware('auth');
Route::delete('organizations/{organization}')->name('organizations.destroy')->uses('OrganizationsController@destroy')->middleware('auth');
Route::put('organizations/{organization}/restore')->name('organizations.restore')->uses('OrganizationsController@restore')->middleware('auth');

// Contacts
Route::get('contacts')->name('contacts')->uses('ContactsController@index')->middleware('remember', 'auth');
Route::get('contacts/create')->name('contacts.create')->uses('ContactsController@create')->middleware('auth');
Route::post('contacts')->name('contacts.store')->uses('ContactsController@store')->middleware('auth');
Route::get('contacts/{contact}/edit')->name('contacts.edit')->uses('ContactsController@edit')->middleware('auth');
Route::put('contacts/{contact}')->name('contacts.update')->uses('ContactsController@update')->middleware('auth');
Route::delete('contacts/{contact}')->name('contacts.destroy')->uses('ContactsController@destroy')->middleware('auth');
Route::put('contacts/{contact}/restore')->name('contacts.restore')->uses('ContactsController@restore')->middleware('auth');

// Reports
Route::get('reports')->name('reports')->uses('ReportsController')->middleware('auth');
Route::name('reports.')->prefix('reports')->group(function () {
    Route::get(
        'shift-report',
        'BlankController@placeHolder'
    )->name('shift-report');
});

// 500 error
Route::get('500', function () {
    echo $fail;
});


// Menus
// Route::get('menus', function () {
//     // $menus = Menu::whereIsRoot()->get();

//     // ddd(Menu::isBroken());
//     $menus = Menu::get()->toTree();
//     $traverse = function ($categories, $store, $prefix = '-') use (&$traverse) {
//         foreach ($categories as $category) {
//             $store[] = $prefix . ' ' . $category->name;
//             $store = $traverse($category->children, $store, $prefix . '-');
//         }

//         return $store;
//     };

//     ddd($traverse($menus, []));
// })->name('menus');


Route::get('m', function () {
    $nodes = Menu::where('active', '=', 1)->defaultOrder()->get();
    // ddd($nodes->modelKeys());
    // $ancestors = Menu::query()
    //     ->whereNotIn('id', $nodes->modelKeys()) // exclude found nodes
    //     ->whereNested(function ($inner) use ($nodes) {
    //         foreach ($nodes as $node) {
    //             $inner->orWhere('_lft', '<', $node->getLft())->where('_rgt', '>', $node->getLft());
    //         }
    //     })
    //     ->get();
    //$tree = $ancestors->merge($nodes)->toTree();

    ddd($nodes->toTree());
});

Route::get('admin', 'BlankController@placeHolder')->name('admin');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(
    function () {
        Route::get('badroute', function () {
            return Inertia::render('Admin/BadRoute');
        })->name('bad.route');

        //barcode
        Route::post('barcode', 'BarcodeController@calc')->name('barcode.calc');
        Route::get("barcode", [BarcodeController::class, 'show'])->name('barcode');

        // menus
        Route::get('menus')->name('menus')->uses('MenusController@index')->middleware('remember');
        Route::get('menus/create')->name('menus.create')->uses('MenusController@create');
        Route::post('menus')->name('menus.store')->uses('MenusController@store');
        Route::get('menus/{menu}/edit')->name('menus.edit')->uses('MenusController@edit');
        Route::put('menus/{menu}')->name('menus.update')->uses('MenusController@update');
        Route::put('menus/{menu}/up')->name('menus.up')->uses('MenusController@moveUp');
        Route::put('menus/{menu}/down')->name('menus.down')->uses('MenusController@moveDown');
        Route::put('menus/{menu}/parent')->name('menus.parent')->uses('MenusController@makeRoot');
        Route::put('menus/{menu}/child')->name('menus.child')->uses('MenusController@makeChild');
        Route::delete('menus/{menu}')->name('menus.destroy')->uses('MenusController@destroy');
        Route::put('menus/{menu}/restore')->name('menus.restore')->uses('MenusController@restore');



        //printers
        Route::get('printers', 'BlankController@placeHolder')->name('printers');
        Route::get('print-templates', 'BlankController@placeHolder')->name('print-templates');

        # settings
        Route::get('settings')->name('settings')->uses('SettingsController@index')->middleware('remember');
        Route::get('settings/create')->name('settings.create')->uses('SettingsController@create');
        Route::post('settings')->name('settings.store')->uses('SettingsController@store');
        Route::get('settings/{setting}/edit')->name('settings.edit')->uses('SettingsController@edit');
        Route::put('settings/{setting}')->name('settings.update')->uses('SettingsController@update');
        Route::delete('settings/{setting}')->name('settings.destroy')->uses('SettingsController@destroy');
        Route::put('settings/{setting}/restore')->name('settings.restore')->uses('SettingsController@restore');

        # locations
        Route::get('locations')->name('locations')->uses('LocationsController@index');
        Route::get('locations/create')->name('locations.create')->uses('LocationsController@create');
        Route::post('locations')->name('locations.store')->uses('LocationsController@store');
        Route::get('locations/{location}/edit')->name('locations.edit')->uses('LocationsController@edit');
        Route::put('locations/{location}')->name('locations.update')->uses('LocationsController@update');
        Route::delete('locations/{location}')->name('locations.destroy')->uses('LocationsController@destroy');
        Route::put('locations/{location}/restore')->name('locations.restore')->uses('LocationsController@restore');
    }


);

Route::get('warehouse', 'BlankController@placeHolder')->name('warehouse');

Route::prefix('warehouse')->name('warehouse.')->group(
    function () {
        Route::get('track-pallets', 'BlankController@placeHolder')->name('track-pallets');
        Route::get('dispatch', 'BlankController@placeHolder')->name('dispatch');
    }
);

Route::get('print', 'BlankController@placeHolder')->name('print');
// Route::get('');

Route::prefix('print')->name('print.')->group(
    function () {
        Route::get('pallet-labels', function (Batch $batch) {
            return Inertia::render('Print/LabelPrint', [
                'items' => Item::where('active', 1)
                    ->orderBy('code')
                    ->get(),
                'productionLines' => ProductionLine::where('active', 1)
                    ->orderBy('name')
                    ->get(),
                'batchNos' => $batch::generate()
            ]);
        })->name('pallet-labels');
        Route::get('reprint', 'BlankController@placeHolder')->name('reprint');
        Route::get('choose-label', 'BlankController@placeHolder')->name('choose-label');
    }
);

// route list
Route::get('/rl', function () {

    ddd(array_keys(Route::getRoutes()->getRoutesByName()));
    return Route::getRoutes()->map(function ($route) {
        return $route->getPath();
    });
});

Route::get('data', 'ItemsController@index')->name('data');


Route::prefix('data')->name('data.')->group(
    function () {
        Route::get('items/create', 'BlankController@placeHolder')->name('items.create');
        Route::get('items/{item}/edit')->name('items.edit')->uses('ItemsController@edit')->middleware('auth');
        Route::delete('items/{item}')->name('items.destroy')->uses('ItemsController@destroy')->middleware('auth');
        Route::put('items/{item}/restore')->name('items.restore')->uses('ItemsController@restore')->middleware('auth');
        Route::put('items/{item}')->name('items.update')->uses('ItemsController@update')->middleware('auth');
        Route::get('items/create')->name('items.create')->uses('ItemsController@create')->middleware('auth');
        Route::post('items/store')->name('items.store')->uses('ItemsController@store')->middleware('auth');
    }
);


Route::get('/batch', \BatchController::class)->name('batch');

Route::get('b2', function (Batch $batch) {
    return App::call([$batch, 'generate']);
});

Route::get('temp', fn () => Menu::where('active', '=', 1)->where('parent_id', null)->with(['children' => function ($q) {
    $q->where('active', 1);
}])->get());





Route::post('/pallet/add', 'PalletsController@add')->name('pallet.add');

Route::get(
    '/valid',
    function (Request $request) {
        // $validated = $request->validate([
        //     'barcode' => [new Barcode]
        // ]);
        // ddd($validated);}
        $rules = ['barcode' => [new  BarcodeRule(new Barcode)]];
        $validator = Validator::make($request->all(), $rules);
        $validator->fails();
        dd($validator->errors());
    }
);
