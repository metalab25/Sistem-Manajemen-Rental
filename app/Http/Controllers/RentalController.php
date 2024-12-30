<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\Customer;
use App\Models\KasMasuk;
use Illuminate\Http\Request;
use App\Helpers\ImageHelpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;

            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            })
                ->orWhereHas('car', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('nopol', 'like', '%' . $search . '%');
                })
                ->orWhere('marketing', 'like', '%' . $search . '%');
        }

        if ($request->has('filter_date') && $request->filter_date) {
            $filterDate = $request->filter_date;
            $query->where(function ($q) use ($filterDate) {
                $q->where('tgl_start', 'like', '%' . $filterDate . '%')
                    ->orWhere('tgl_end', 'like', '%' . $filterDate . '%');
            });
        }

        if ($request->has('pay_status') && $request->pay_status != '') {
            $query->where('pay_status', $request->pay_status);
        }

        $rentals = $query->orderBy('tgl_start', 'desc')->paginate(25);

        $title = 'Hapus Data Transaksi!';
        $text = "Anda yakin ingin menghapus data ini?";
        confirmDelete($title, $text);

        return view('dashboard.rentals.index', [
            'page'      => 'Data Transaksi Penyewaan',
            'rentals'   => $rentals
        ]);
    }

    public function create()
    {
        $typeOptions = Rental::getTypeOptions();
        $customers  = Customer::orderBy('name')->get();
        $cars = Car::select('cars.*')
            ->join('merks', 'cars.merk_id', '=', 'merks.id')
            ->where('cars.status', '=', 'Tersedia')
            ->orderBy('merks.name')->get();
        $invoiceNumber = Rental::generateInvoiceNumber();

        return view('dashboard.rentals.add', [
            'page'          => 'Tambah Penyewaan',
            'customers'     => $customers,
            'cars'          => $cars,
            'inv_number'    => $invoiceNumber,
            'typeOptions'   => $typeOptions
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'inv_number'    => 'required|unique:rentals,inv_number',
            'type'          => 'required',
            'marketing'     => 'required',
            'customer_id'   => 'required',
            'car_id'        => 'required',
            'tgl_start'     => 'required',
            'jam_start'     => 'required',
            'tgl_end'       => 'required',
            'jam_end'       => 'required',
            'durasi'        => 'required|numeric',
            'tarif'         => 'required|numeric',
            'total'         => 'required|numeric',
            'dp'            => 'required|numeric',
            'balance'       => 'required|numeric',
            'image'         => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = ImageHelpers::cropRentalImage($request->file('image'), 'rentals');
        }

        $validatedData['note']      = $request->note;
        $validatedData['user_id']   = Auth::user()->id;

        Rental::create($validatedData);

        Car::where('id', $validatedData['car_id'])->update(['status' => 'Tidak Tersedia']);

        Alert::success('Success', 'Penyewaan baru berhasil disimpan');
        return redirect()->route('rentals.index');
    }

    public function show($id)
    {
        $rental = Rental::findOrFail($id);

        return view('dashboard.rentals.details', [
            'page'      => 'Detail Transaksi Sewa',
            'rental'    => $rental
        ]);
    }

    public function print($id)
    {
        $rental = Rental::findOrFail($id);

        return view('dashboard.rentals.print', [
            'page'      => 'Cetak Invoice Sewa',
            'rental'    => $rental
        ]);
    }

    public function edit($id)
    {
        $typeOptions = Rental::getTypeOptions();
        $customers  = Customer::orderBy('name')->get();
        $cars = Car::select('cars.*')
            ->join('merks', 'cars.merk_id', '=', 'merks.id')
            ->orderBy('merks.name')->get();
        $rental = Rental::findOrFail($id);

        return view('dashboard.rentals.edit', [
            'page'          => 'Ubah Transaksi Sewa',
            'rental'        => $rental,
            'customers'     => $customers,
            'cars'          => $cars,
            'typeOptions'   => $typeOptions
        ]);
    }

    public function update(Request $request, Rental $rental)
    {
        $rules = [
            'type'          => 'required',
            'marketing'     => 'required',
            'customer_id'   => 'required',
            'car_id'        => 'required',
            'tgl_start'     => 'required',
            'jam_start'     => 'required',
            'tgl_end'       => 'required',
            'jam_end'       => 'required',
            'durasi'        => 'required|numeric',
            'tarif'         => 'required|numeric',
            'total'         => 'required|numeric',
            'dp'            => 'required|numeric',
            'balance'       => 'required|numeric',
            'image'         => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldFoto) {
                Storage::delete($request->oldFoto);
            }
            $validatedData['image'] = ImageHelpers::cropRentalImage($request->file('image'), 'rentals');
        }

        $validatedData['note']          = $request->note;
        $validatedData['updated_by']    = Auth::user()->id;

        $rental->update($validatedData);

        Car::where('id', $validatedData['car_id'])->update(['status' => 'Tidak Tersedia']);

        Alert::success('Success', 'Transaksi penyewaan berhasil diperbaharui');
        return redirect()->route('rentals.index');
    }

    public function updateDone(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'status'        => 'required|in:0,1',
            'pay_status'    => 'required|in:Lunas,Belum Lunas',
        ]);

        $rental = Rental::findOrFail($id);

        if ($validatedData['status'] == '0' && $validatedData['pay_status'] == 'Lunas') {
            $validatedData['closing_at'] = now();

            Car::where('id', $rental->car_id)->update(['status' => 'Tersedia']);

            KasMasuk::create([
                'transaction_at'    => $validatedData['closing_at'],
                'item'              => 'Sewa ' . $rental->car->merk->name . ' ' . $rental->car->name . ' ' . $rental->car->nopol . ' ' . $rental->type . ' Tanggal ',
                'total'             => $rental->total,
                'type'              => 'Penyewaan',
                'rent_date'         => $rental->tgl_start,
                'input_by'          => Auth::user()->id,
            ]);
        } elseif ($validatedData['status'] == '0' && $validatedData['pay_status'] == 'Belum Lunas') {
            $validatedData['closing_at'] = null;
        } elseif ($validatedData['status'] == '1') {
            $validatedData['closing_at'] = null;

            Car::where('id', $rental->car_id)->update(['status' => 'Tidak Tersedia']);
        }

        $rental->update($validatedData);

        Alert::success('Success', 'Status transaksi penyewaan telah selesai');
        return redirect()->route('rentals.index');
    }

    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);

        if ($rental->image) {
            Storage::disk('public')->delete($rental->image);
        }

        $rental->delete();
        Car::where('id', $rental->car_id)->update(['status' => 'Tersedia']);

        Alert::success('Success', 'Data transaksi penyewaan berhasil dihapus');
        return redirect()->route('rentals.index');
    }
}
