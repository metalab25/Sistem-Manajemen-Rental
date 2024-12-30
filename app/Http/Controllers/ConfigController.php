<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $config = Config::findOrFail(1);
        if (!in_array(Auth::user()->role_id, [1, 2])) {
            abort(403);
        }

        return view('dashboard.setting.application.index', [
            'page'      => 'Pengaturan Aplikasi',
            'config'    => $config,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Config $config)
    {
        if (!in_array(Auth::user()->role_id, [1, 2])) {
            abort(403);
        }

        $rules = [
            'inv_code'          => 'required',
            'inv_start_number'  => 'required|numeric',
            'icon'              => 'image|mimes:jpg,jpeg,png,bmp,webp|max:2048',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('icon')) {
            if ($request->oldIcon) {
                Storage::delete($request->oldIcon);
            }
            $validatedData['icon'] = $request->file('icon')->store('icon');
        }

        $validatedData['google_verification']   = $request->google_verification;
        $validatedData['timezone']              = $request->timezone;
        $validatedData['web_title']             = $request->web_title;
        $validatedData['updated_by']            = Auth::user()->id;

        // dd($validatedData);

        Config::where('id', $config->id)
            ->update($validatedData);

        Alert::success('Success', 'Pengaturan Aplikasi Berhasil Diperbaharui');
        return redirect()->route('application.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Config $config)
    {
        //
    }
}
