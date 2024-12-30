<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\KasMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KasMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = KasMasuk::query();

        if ($request->has(['start_date', 'end_date']) && $request->start_date && $request->end_date) {
            $query->whereBetween('transaction_at', [$request->start_date, $request->end_date]);
        } else {
            $query->whereMonth('transaction_at', Carbon::now()->month)
                ->whereYear('transaction_at', Carbon::now()->year);
        }

        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        $cashIns = $query->orderBy('transaction_at')->paginate(20);

        $totalSum = $cashIns->sum('total');

        return view('dashboard.pembukuan.masuk.index', [
            'page'      => 'Kas Masuk',
            'cashIns'   => $cashIns,
            'totalSum'  => $totalSum,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'transaction_at'    => 'required',
            'item'              => 'required',
            'total'             => 'required',
            'type'              => 'required',
        ]);

        $validatedData['input_by']   = Auth::user()->id;

        KasMasuk::create($validatedData);

        Alert::success('Success', 'Transaksi masuk baru berhasil disimpan');
        return redirect()->route('cashins.index');
    }

    public function show(KasMasuk $kasMasuk)
    {
        //
    }

    public function edit(KasMasuk $kasMasuk)
    {
        //
    }

    public function update(Request $request, KasMasuk $kasMasuk)
    {
        //
    }

    public function print(Request $request)
    {
        $query = KasMasuk::query();

        // Terapkan filter yang sama seperti di fungsi index
        if ($request->has(['start_date', 'end_date']) && $request->start_date && $request->end_date) {
            $query->whereBetween('transaction_at', [$request->start_date, $request->end_date]);
        } else {
            $query->whereMonth('transaction_at', Carbon::now()->month)
                ->whereYear('transaction_at', Carbon::now()->year);
        }

        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        // Ambil data tanpa paginasi
        $cashIns = $query->orderBy('transaction_at')->get();

        $totalSum = $cashIns->sum('total');

        // Jika menggunakan tampilan HTML untuk cetak
        return view('dashboard.pembukuan.masuk.print', [
            'page'      => 'Cetak Kas Masuk',
            'cashIns'   => $cashIns,
            'totalSum'  => $totalSum,
        ]);

        // Jika menggunakan PDF untuk cetak
        // $pdf = Pdf::loadView('dashboard.pembukuan.masuk.print', compact('cashIns'));
        // return $pdf->stream('kas-masuk.pdf');
    }

    public function destroy(KasMasuk $kasMasuk)
    {
        //
    }
}
