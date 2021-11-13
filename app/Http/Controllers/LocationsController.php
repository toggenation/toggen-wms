<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Models\Location;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;
use App\Models\ProductType;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render(
            'Locations/Index',
            [
                // filters passed back to client
                'filters' => Request::only(['search', 'active']),
                'locations' => new LocationCollection(
                    Location::with('product_types')
                        ->orderBy('name')
                        ->filter(Request::only('search', 'active'))
                        ->paginate()
                        ->appends(Request::all())
                )
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Locations/Create', [
            'product_types' => ProductType::all('id', 'name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Location $location, LocationStoreRequest $request)
    {
        $location->create(
            $request->validated()
        );

        return redirect(route('admin.locations'))->with('success', 'Location created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {

        // dd(new LocationResource($location));
        return Inertia::render('Locations/Edit', [
            'location' => new LocationResource($location),
            'product_types' => ProductType::all('id', 'name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationUpdateRequest $request, Location $location)
    {
        $location->update(
            $request->validated()
        );

        return redirect()->back()->with('success', 'Location updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect(route('admin.locations'))->with('success', 'Location deleted.');
    }
}
