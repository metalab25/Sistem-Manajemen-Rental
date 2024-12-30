@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-lg mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                @if ($customer->image)
                                    <img src="{{ asset('storage/' . $customer->image) }}" class="w-100 rounded-2 shadow-sm"
                                        alt="{{ $customer->name }}">
                                @else
                                    <img src="{{ asset('/assets/img/no-picture.webp') }}" class="w-100 rounded-2 shadow-sm"
                                        alt="{{ $customer->name }}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-lg mb-3">
                        <div class="card-header">
                            <h3 class="font-outfit fw-semibold">Informasi Penyewa</h3>
                        </div>
                        <div class="card-body">
                            <div class="row form-group mb-3">
                                <label for="name" class="form-label col-md-2">Nama</label>
                                <div class="col-md-10">
                                    <input type="text" id="name" class="form-control form-control-0"
                                        value={{ $customer->name }}>
                                </div>
                            </div>
                            <div class="row form-group mb-3">
                                <label for="address" class="form-label col-md-2">Alamat</label>
                                <div class="col-md-10">
                                    <textarea type="text" id="address" class="form-control form-control-0">{{ $customer->address . '. Kota/Kabupaten ' . $customer->city . ', ' . $customer->province->name }}</textarea>
                                </div>
                            </div>
                            @if ($customer->email)
                                <div class="row form-group mb-3">
                                    <label for="email" class="form-label col-md-2">Email</label>
                                    <div class="col-md-10">
                                        <input type="text" id="email" class="form-control form-control-0"
                                            value={{ $customer->email }}>
                                    </div>
                                </div>
                            @endif
                            <div class="row form-group mb-3">
                                <label for="phone" class="form-label col-md-2">Telepon</label>
                                <div class="col-md-10">
                                    <input type="text" id="phone" class="form-control form-control-0"
                                        value={{ $customer->phone }}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-lg">
                <div class="card-header">
                    <h3 class="card-title fw-semibold font-outfit">Data Penyewaan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive rounded-3 table-shadow">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" width="3%">No.</th>
                                    <th class="text-center align-middle">Jenis</th>
                                    <th class="text-center align-middle">Mobil</th>
                                    <th class="text-center align-middle">Nopol</th>
                                    <th class="text-center align-middle">Mulai</th>
                                    <th class="text-center align-middle">Selesai</th>
                                    <th class="text-center align-middle">Durasi</th>
                                    <th class="text-center align-middle">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rentals as $index => $rental)
                                    <tr
                                        class="{{ $rental->status == 0 ? 'table-success' : '' }} {{ $rental->pay_status == 'Belum Lunas' ? 'table-danger' : '' }}">
                                        <td class="text-center align-middle">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $rental->type }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $rental->car->merk->name . ' ' . $rental->car->name }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('cars.show', $rental->car_id) }}">
                                                {{ $rental->car->nopol }}
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ tanggal_indonesia($rental->tgl_start, false) . ' ' . \Carbon\Carbon::parse($rental->jam_start)->format('H:i') }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ tanggal_indonesia($rental->tgl_end, false) . ' ' . \Carbon\Carbon::parse($rental->jam_end)->format('H:i') }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $rental->durasi . ' Hari' }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ formatRupiah($rental->total) }}
                                        </td>
                                    </tr>
                                    @include('dashboard.rentals.modal-update-status')
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Data tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
