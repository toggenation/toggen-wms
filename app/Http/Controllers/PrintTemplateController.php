<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrintTemplateUpdateRequest;
use App\Http\Resources\PrintTemplateCollection;
use App\Http\Resources\PrintTemplateResource;
use App\Models\PrintTemplate;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PrintTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('PrintTemplates/Index', [
            'filters' => Request::all('search', 'active'),
            'print_templates' => new PrintTemplateCollection(
                PrintTemplate::orderBy('name')
                    ->filter(Request::only('search', 'active'))
                    ->paginate()
                    ->appends(Request::all())
            )

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('PrintTemplates/Create');
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
    public function edit(PrintTemplate $printTemplate)
    {
        return Inertia::render('PrintTemplates/Edit', [
            'print_template' => new PrintTemplateResource($printTemplate)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrintTemplate $printTemplate, PrintTemplateUpdateRequest $request)
    {

        // dd(request()->file('template')->getClientOriginalName());
        // return "Done";

        $printTemplate->update(
            $request->validated()
        );

        return redirect()->back()->with('success', 'Print Template updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrintTemplate $printTemplate)
    {
        $name = $printTemplate->name;

        $printTemplate->delete();
        return redirect(route('admin.print-templates'))->with("success", sprintf("Print template %s%s%s deleted", chr(34), $name, chr(34)));
    }
}
