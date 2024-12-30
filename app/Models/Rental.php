<?php

namespace App\Models;

use App\Models\Car;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table        = 'rentals';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getTypeOptions()
    {
        return ['Lepas Kunci', 'Include', 'Check In', 'Check Out', 'Rent To Rent'];
    }

    /// Generate nomor invoice
    public static function generateInvoiceNumber()
    {
        // Ambil kode invoice dari tabel config
        $config = Config::findOrFail(1);
        $invCode = $config->inv_code;

        // Ambil nilai awal nomor invoice dari tabel config
        $startNumber = $config->inv_start_number ?? 1;

        // Tanggal saat ini
        $day = now()->format('d');
        $month = now()->format('m');
        $year = now()->format('Y');

        // Konversi bulan ke huruf Romawi menggunakan helper
        $romanMonth = hurufRomawi($month);

        // Cari invoice terakhir yang dibuat hari ini
        $latestInvoice = self::whereDate('created_at', today())
            ->where('inv_number', 'like', $invCode . '%') // Pastikan hanya mengambil invoice dengan kode yang sama
            ->orderBy('id', 'desc')
            ->first();

        // Ambil nomor urut terakhir dengan regex atau substring
        if ($latestInvoice) {
            preg_match('/\d{5}(?=-)/', $latestInvoice->inv_number, $matches);
            $lastNumber = $matches[0] ?? $startNumber;
        } else {
            $lastNumber = $startNumber - 1; // Karena akan ditambah 1
        }

        // Hitung nomor urut berikutnya
        $nextNumber = intval($lastNumber) + 1;

        // Format nomor invoice (contoh: INV-00001-25/XII/2024)
        return $invCode . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT) . '-' . $day . '/' . $romanMonth . '/' . $year;
    }
}
