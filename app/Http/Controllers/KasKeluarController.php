<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KasKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = KasKeluar::query();

        $cashOut = $query->orderBy('transaction_at')->paginate(20);

        $totalSum = $cashOut->sum('total');

        return view('dashboard.pembukuan.keluar.index', [
            'page'      => 'Kas Keluar',
            'cashOuts'  => $cashOut,
            'totalSum'  => $totalSum,
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
        $validatedData = $request->validate([
            'transaction_at'    => 'required',
            'item'              => 'required',
            'total'             => 'required',
            'image'             => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('kas_keluar');
        }

        $validatedData['input_by']   = Auth::user()->id;

        KasKeluar::create($validatedData);

        Alert::success('Success', 'Transaksi keluar baru berhasil disimpan');
        return redirect()->route('cashouts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(KasKeluar $kasKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KasKeluar $kasKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KasKeluar $kasKeluar)
    {
        //
    }

    public function print()
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KasKeluar $kasKeluar)
    {
        //
    }
}
