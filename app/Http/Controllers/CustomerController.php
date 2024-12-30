<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Helpers\ImageHelpers;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('name')->paginate(7);

        return view('dashboard.data.customers.index', [
            'page'      => 'Manajemen Penyewa',
            'customers' => $customers
        ]);
    }

    public function create()
    {
        $province = Province::all();

        return view('dashboard.data.customers.add', [
            'page'      => 'Manajemen Penyewa',
            'province'  => $province
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'          =>  'required',
            'id_number'     =>  'required|unique:customers,id_number',
            'address'       =>  'required',
            'city'          =>  'required',
            'province_id'   =>  'required',
            'email'         =>  'nullable|email',
            'phone'         =>  'required|numeric|unique:customers,phone',
            'image'         =>  'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = ImageHelpers::cropCardImage($request->file('image'), 'card');
        }

        $validatedData['company'] = $request->company;

        Customer::create($validatedData);

        Alert::success('Success', 'Penyewa baru berhasil ditambahkan');
        return redirect()->route('customers.index');
    }

    public function show($id)
    {
        $customer = Customer::with('rentals')->findOrFail($id);

        return view('dashboard.data.customers.details', [
            'page'      => 'Detail Data Penyewa',
            'customer'  => $customer,
            'rentals'   => $customer->rentals,
        ]);
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $province = Province::all();

        return view('dashboard.data.customers.edit', [
            'page'      => 'Detail Data Penyewa',
            'customer'  => $customer,
            'province'  => $province
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'name'          =>  'required',
            'address'       =>  'required',
            'city'          =>  'required',
            'province_id'   =>  'required',
            'image'         =>  'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        $validatedData = $request->validate($rules);

        if ($request->id_number !== $customer->id_number) {
            $request->validate([
                'id_number' => 'required|unique:customers,id_number,' . $customer->id,
            ]);
            $validatedData['id_number'] = $request->email;
        }

        if ($request->email !== $customer->email) {
            $request->validate([
                'email' => 'email|unique:customers,email,' . $customer->id,
            ]);
            $validatedData['email'] = $request->email;
        }

        if ($request->phone !== $customer->phone) {
            $request->validate([
                'phone' => 'required|unique:customers,phone,' . $customer->id,
            ]);
            $validatedData['phone'] = $request->email;
        }

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = ImageHelpers::cropCardImage($request->file('image'), 'card');
        }

        $customer->update($validatedData);

        Alert::success('Success', 'Data penyewa berhasil diperbaharui');
        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        //
    }
}
