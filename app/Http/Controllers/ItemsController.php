<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Http\Resources\ItemCollection;
use App\Models\Item;
use App\Http\Resources\ItemResource;
use App\Models\ProductType;
use App\Models\UnitsOfMeasure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ddd(Item::where('active', 1)->orderBy('code')->paginate(5));
        return Inertia::render('Items/Index', [
            'filters' => Request::all('search', 'trashed'),
            'items' =>  new ItemCollection(
                Item::orderBy('code')
                    ->filter(Request::only('search', 'trashed'))
                    ->paginate()
                    ->appends(Request::all())
            )
            // 'organizations' => new OrganizationCollection(
            //     Auth::user()->account->organizations()
            //         ->orderBy('name')
            //         ->filter(Request::only('search', 'trashed'))
            //         ->paginate()
            //         ->appends(Request::all())
            // ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Items/Create', [
            'product_types' => ProductType::all('id', 'name'),
            'units_of_measure' => UnitsOfMeasure::all('id', 'name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Item $item, ItemStoreRequest $request)
    {
        $item->create(
            $request->validated()
        );

        return Redirect::route('data')->with('success', 'Item created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return Inertia::render('Items/Edit', [
            'item' => new ItemResource($item),
            'product_types' => ProductType::all('id', 'name'),
            'units_of_measure' => UnitsOfMeasure::all('id', 'name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Item $item, ItemUpdateRequest $request)
    {
        $item->update(
            $request->validated()
        );

        return Redirect::back()->with('success', 'Item updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return Redirect::back()->with('success', 'Item deleted.');
    }


    public function restore(Item $item)
    {
        $item->restore();

        return Redirect::back()->with('success', 'Item restored.');
    }
}
