<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $province = Province::all();
        $company = Company::findOrFail(1);

        if (!in_array(Auth::user()->role_id, [1, 2])) {
            abort(403);
        }

        return view('dashboard.setting.company.index', [
            'page'     => 'Profil Perusahaan',
            'company'  => $company,
            'province' => $province
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
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        if (!in_array(Auth::user()->role_id, [1, 2])) {
            abort(403); // Tidak diizinkan
        }

        $rules = [
            'name'          => 'required',
            'garage'        => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'postcode'      => 'required',
            'province_id'   => 'required',
            'phone'         => 'required|numeric',
            'whatsapp'      => 'required|numeric',
            'email'         => 'required|email',
            'nib'           => 'required',
            'npwp'          => 'required',
            'owner'         => 'required',
            'logo'          => 'image|mimes:jpg,jpeg,png,bmp,webp|max:2048',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('logo')) {
            if ($request->oldLogo) {
                Storage::delete($request->oldLogo);
            }
            $validatedData['logo'] = $request->file('logo')->store('logo');
        }

        $validatedData['map']           = $request->map;
        $validatedData['website']       = $request->website;
        $validatedData['facebook']      = $request->facebook;
        $validatedData['instagram']     = $request->instagram;
        $validatedData['twitter']       = $request->twitter;
        $validatedData['tiktok']        = $request->tiktok;
        $validatedData['youtube']       = $request->youtube;
        $validatedData['updated_by']    = Auth::user()->id;

        Company::where('id', $company->id)
            ->update($validatedData);

        Alert::success('Success', 'Profil Perusahaan Berhasil Diperbaharui');
        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
