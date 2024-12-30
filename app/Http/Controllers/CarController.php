<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Fuel;
use App\Models\Merk;
use App\Models\Type;
use App\Models\Owner;
use App\Models\Passenger;
use App\Models\Transmission;
use Illuminate\Http\Request;
use App\Helpers\ImageHelpers;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CarController extends Controller
{
    public function index()
    {
        $title = 'Hapus Data Mobil !';
        $text = "Anda yakin ingin menghapus data ini ?";
        confirmDelete($title, $text);

        $cars = Car::select('cars.*')
            ->join('merks', 'cars.merk_id', '=', 'merks.id')
            ->orderBy('merks.name')
            ->paginate(10);

        return view('dashboard.data.cars.index', [
            'page'  => 'Manajemen Mobil',
            'cars'  =>  $cars
        ]);
    }

    public function create()
    {
        $fuels          = Fuel::orderBy('name')->get();
        $transmissions  = Transmission::all();
        $merks          = Merk::orderBy('name')->get();
        $types          = Type::orderBy('name')->get();
        $passengers     = Passenger::all();
        $owners         = Owner::orderBy('name')->get();

        return view('dashboard.data.cars.add', [
            'page'          =>  'Tambah Mobil',
            'merks'         =>  $merks,
            'fuels'         =>  $fuels,
            'types'         =>  $types,
            'transmissions' =>  $transmissions,
            'passengers'    =>  $passengers,
            'owners'        =>  $owners
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'owner_id'          =>  'required',
            'merk_id'           =>  'required',
            'name'              =>  'required',
            'nopol'             =>  'required|unique:cars,nopol',
            'transmission_id'   =>  'required',
            'fuel_id'           =>  'required',
            'type_id'           =>  'required',
            'passenger_id'      =>  'required',
            'basic_price'       =>  'required:numeric',
            'rental_price'      =>  'required:numeric',
            'public_price'      =>  'required:numeric',
            'month_price'       =>  'required:numeric',
            'image'             =>  'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'interior'          =>  'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = ImageHelpers::cropCarImage($request->file('image'), 'cars');
        }

        if ($request->file('interior')) {
            $validatedData['interior'] = ImageHelpers::cropInteriorImage($request->file('interior'), 'cars');
        }

        $validatedData['color'] = $request->color;
        $validatedData['year']  = $request->year;

        Car::create($validatedData);

        Alert::success('Success', 'Mobil baru berhasil ditambahkan');
        return redirect()->route('cars.index');
    }

    public function show(Car $car)
    {
        //
    }

    public function edit(Car $car)
    {
        //
    }

    public function update(Request $request, Car $car)
    {
        //
    }

    public function updateStatus(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:Tersedia,Tidak Tersedia',
        ]);

        $car = Car::findOrFail($id);

        $car->update(['status' => $validatedData['status']]);

        Alert::success('Success', 'Status mobil telah diperbarui.');
        return redirect()->route('cars.index');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        if ($car->interior) {
            Storage::disk('public')->delete($car->interior);
        }

        $car->delete();

        Alert::success('Success', 'Data pengguna berhasil dihapus');
        return redirect()->route('users.index');
    }
}
