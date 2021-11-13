<?php

namespace App\Http\Controllers;

use App\Events\PalletLabelPrint;
use App\Http\Requests\PalletLabelPrintRequest;
use App\Models\Item;
use App\Models\ProductionLine;
use App\Services\Batch;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrintController extends Controller
{

    public function pallet(Batch $batch)
    {
        return Inertia::render('Print/LabelPrint', [
            'items' => Item::where('active', 1)
                ->orderBy('code')
                ->get(),
            'productionLines' => ProductionLine::where('active', 1)
                ->orderBy('name')
                ->get(),
            'batchNos' => $batch::generate()
        ]);
    }

    public function palletPrint(PalletLabelPrintRequest $request)
    {

        PalletLabelPrint::dispatch($request->validated());

        dd($request->validated());

        //Pallet::make([])

        // create a pallet record
        // attach an item to it filled with the correct detail
        // trigger a print (can I rollback)

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
