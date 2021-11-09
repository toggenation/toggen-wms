<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingCollection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Settings/Index', [
            'filters' => Request::all('search', 'active'),
            'settings' => new SettingCollection(
                Setting::orderBy('name')
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
        return Inertia::render('Settings/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = Request::validate([
            'name' => [
                'required',
                'unique:settings'
            ],
            'setting' => ['required'],
            'comment' => ['nullable']
        ]);

        $active = Request::has('active') ? request('active') : false;
        $data['active'] = $active;

        // dd($active);

        $setting = Setting::create($data);

        return Redirect::route('admin.settings')->with('success', 'Setting created.');
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
        return Inertia::render('Settings/Edit', [
            'setting' => Setting::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Setting $setting, Request $request)
    {
        // dd($setting->id);
        $setting->update(
            Request::validate([
                'active' => ['boolean'],
                'setting' => ['required'],
                'name' => [
                    'required',
                    Rule::unique('settings', 'name')->ignore($setting->id)
                ],
                'comment' => ['nullable']
            ])
        );

        return Redirect::back()->with('success', 'Setting updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return Redirect::to(route('admin.settings'))->with('success', 'Setting deleted.');
    }
}
