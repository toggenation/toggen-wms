<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;
use App\Http\Resources\MenuCollection;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

// use Illuminate\Support\Facades\Redirect;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('Menus/Index', [
            'filters' => Request::all('search', 'trashed'),
            'menus' => new MenuCollection(
                Menu::defaultOrder()
                    ->withDepth()
                    ->orderBy('name')
                    ->paginate()
                    ->appends(Request::all())
            ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Menus/Create', [
            // 'user' => new UserResource($user),
            'root_menus' => Menu::whereIsRoot()->get(),
            'routes' => array_keys(Route::getRoutes()->getRoutesByName())

            // 'roles' => Role::where('active', 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStoreRequest $request)
    {

        Menu::create($request->validated());

        return Redirect::route('admin.menus')->with('success', 'Setting created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        // ddd($menu);
        return Inertia::render('Menus/Edit', [
            // 'user' => new UserResource($user),
            'menu' => $menu,
            'root_menus' => Menu::whereIsRoot()->get()

            // 'roles' => Role::where('active', 1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */

    public function update(Menu $menu, MenuUpdateRequest $request)
    {
        $parentId = $request->input('parent_id');

        if (!is_null($parentId) && $menu->parent_id !== $parentId) {
            return $this->makeChild($menu, $request->input('parent_id'));
        };

        $menu->update($request->validated());

        return Redirect::back()->with('success', 'Menu updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus')->with('success', "Menu deleted.");
    }

    public function moveUp(Menu $menu, $places = 1)
    {
        $menu->up($places);
        // $menu->save();
        // return redirect()->route('admin.menus');
        return Redirect::back()->with('success', 'Menu updated.');
    }

    public function moveDown(Menu $menu, $places = 1)
    {
        $menu->down($places);
        return Redirect::back()->with('success', 'Menu updated.');
    }

    public function makeRoot(Menu $menu)
    {
        $menu->makeRoot()->save();
        return Redirect::back()->with('success', 'Menu updated.');
    }

    public function makeChild(Menu $menu, $parentId)
    {
        $parent = Menu::find($parentId);
        $parent->appendNode($menu);

        return Redirect::back()->with('success', 'Menu updated.');
    }
}
