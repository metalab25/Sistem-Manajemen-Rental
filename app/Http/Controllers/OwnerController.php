<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $province   = Province::all();
        $owners     =  Owner::orderBy('name')->paginate(8);

        if (!in_array(Auth::user()->role_id, [1, 2])) {
            abort(403);
        }

        $title = 'Hapus Pemilik Kendaraan !';
        $text = "Anda yakin ingin menghapus data ini ?";
        confirmDelete($title, $text);

        return view('dashboard.data.owner.index', [
            'page'      => 'Pemilik Kendaraan',
            'owners'    => $owners,
            'province'  => $province
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'          =>  'required',
            'address'       =>  'required',
            'city'          =>  'required',
            'province_id'   =>  'required',
            'email'         =>  'nullable|email|unique:owners,email',
            'phone'         =>  'required|numeric|unique:owners,phone',
            'status'        =>  'required',
        ]);

        $validatedData['garage']        = $request->garage;
        $validatedData['created_by']    = Auth::user()->id;

        Owner::create($validatedData);

        Alert::success('Success', 'Pemilik Kendaraan Berhasil Ditambahkan');
        return redirect()->route('owners.index');
    }

    public function show(Owner $owner)
    {
        //
    }

    public function edit(Owner $owner)
    {
        //
    }

    public function update(Request $request, Owner $owner)
    {
        $rules = [
            'name'          =>  'required',
            'address'       =>  'required',
            'city'          =>  'required',
            'province_id'   =>  'required',
            'status'        =>  'required',
        ];

        $validatedData = $request->validate($rules);

        if ($request->email !== $owner->email) {
            $request->validate([
                'email' => 'nullable|email|unique:owners,email,' . $owner->id,
            ]);
            $validatedData['email'] = $request->email;
        }

        if ($request->phone !== $owner->phone) {
            $request->validate([
                'phone' => 'required|numeric|unique:owners,phone,' . $owner->id,
            ]);
            $validatedData['phone'] = $request->phone;
        }

        $owner->update($validatedData);

        Alert::success('Success', 'Data pemilik kendaraan berhasil diperbaharui');
        return redirect()->route('owners.index');
    }

    public function destroy($id)
    {
        $owner = Owner::findOrFail($id);

        if (!in_array(Auth::user()->role_id, [1, 2])) {
            abort(403);
        }

        $owner->delete();

        Alert::success('Success', 'Data pemilik kendaraan berhasil dihapus');
        return redirect()->route('owners.index');
    }
}
