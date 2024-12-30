<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Rental;
use App\Models\Customer;
use App\Models\KasMasuk;
use App\Models\KasKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $carCount       = Car::where('status', 'Tersedia')->count();
        $customerCount  = Customer::count();
        $totalHariIni = Rental::whereDate('created_at', Carbon::today())
            ->sum('total');
        $totalBulanIni = Rental::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now('d')->year)
            ->sum('total');

        $chartData = Rental::selectRaw('DATE(tgl_start) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $chartKasMasuk = KasMasuk::selectRaw('DATE(transaction_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $chartKasKeluar = KasKeluar::selectRaw('DATE(transaction_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('dashboard.index', [
            'page'              => 'Dashboard',
            'carCount'          => $carCount,
            'customerCount'     => $customerCount,
            'totalHariIni'      => $totalHariIni,
            'totalBulanIni'     => $totalBulanIni,
            'chartData'         => $chartData,
            'chartKasMasuk'     => $chartKasMasuk,
            'chartKasKeluar'    => $chartKasKeluar
        ]);
    }
}
