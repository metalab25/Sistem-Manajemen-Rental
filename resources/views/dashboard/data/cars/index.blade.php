@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <a href="{{ route('cars.create') }}" class="btn btn-primary float-end sm-full-fw mb-0">Tambah
                                Mobil</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive rounded-3 table-shadow">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" width="3%">No.</th>
                                    <th class="text-center align-middle">Nama</th>
                                    <th class="text-center align-middle">Nopol</th>
                                    <th class="text-center align-middle">Transmisi</th>
                                    <th class="text-center align-middle">Bahan Bakar</th>
                                    <th class="text-center align-middle">Tipe</th>
                                    <th class="text-center align-middle">Kapasitas</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                    <tr class="{{ $car->status == 'Tidak Tersedia' ? 'table-danger' : '' }}">
                                        <td class="text-center align-middle">
                                            {{ ($cars->currentPage() - 1) * $cars->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $car->merk->name . ' ' . $car->name }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $car->nopol }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $car->transmission->alias }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $car->fuel->name }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $car->type->name }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $car->passenger->name }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $car->status }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Tombol
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('cars.show', $car->id) }}"
                                                            class="dropdown-item py-2 align-middle">
                                                            Detail
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item py-2 align-middle"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalUbahStatus-{{ $car->id }}">Ubah
                                                            Status</button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item py-2 align-middle"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditcar-{{ $car->id }}">Ubah
                                                            Data</button>
                                                    </li>
                                                    @if (Auth::check() && in_array(Auth::user()->role_id, [1, 2]))
                                                        <li>
                                                            <a href="{{ route('cars.destroy', $car->id) }}"
                                                                class="dropdown-item py-2 align-middle"
                                                                data-confirm-delete="true">
                                                                Hapus Data
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('dashboard.data.cars.modal-update-status')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        {{ $cars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
