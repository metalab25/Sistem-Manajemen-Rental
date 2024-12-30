<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\KasMasuk;
use App\Models\KasKeluar;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Jika filter tidak diterapkan, gunakan bulan berjalan
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Ambil data kas masuk
        $chartKasMasuk = KasMasuk::selectRaw('DATE(transaction_at) as date, item as item, SUM(total) as total')
            ->whereBetween('transaction_at', [$startDate, $endDate])
            ->groupBy('date', 'item')
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('date');

        // Ambil data kas keluar
        $chartKasKeluar = KasKeluar::selectRaw('DATE(transaction_at) as date, item as item, SUM(total) as total')
            ->whereBetween('transaction_at', [$startDate, $endDate])
            ->groupBy('date', 'item')
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('date');

        // Gabungkan data berdasarkan tanggal
        $allDates = $chartKasMasuk->keys()->merge($chartKasKeluar->keys())->unique()->sort();

        // Format laporan keuangan
        $laporanKeuangan = $allDates->map(function ($date) use ($chartKasMasuk, $chartKasKeluar) {
            return [
                'date' => $date,
                'kas_masuk' => $chartKasMasuk->get($date) ?? collect([]),
                'kas_keluar' => $chartKasKeluar->get($date) ?? collect([]),
            ];
        });

        // Hitung total kas masuk dan kas keluar
        $totalKasMasuk = $chartKasMasuk->flatten(1)->sum('total');
        $totalKasKeluar = $chartKasKeluar->flatten(1)->sum('total');
        $pendapatan = $totalKasMasuk - $totalKasKeluar;

        return view('dashboard.pembukuan.report.index', [
            'page' => 'Laporan Keuangan',
            'laporanKeuangan' => $laporanKeuangan,
            'totalKasMasuk' => $totalKasMasuk,
            'totalKasKeluar' => $totalKasKeluar,
            'pendapatan' => $pendapatan,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }

    public function print()
    {
        // 
    }
}
