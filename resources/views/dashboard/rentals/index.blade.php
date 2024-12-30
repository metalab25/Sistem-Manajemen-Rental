@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header pb-sm-2">
                    <div class="row">
                        <div class="col-md-9">
                            <form method="GET" action="{{ route('rentals.index') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="search" class="form-control mb-sm-2"
                                            placeholder="Cari nama, mobil, marketing, kota..."
                                            value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="filter_date" class="form-control mb-sm-2"
                                            value="{{ request('filter_date') }}" placeholder="Cari berdasarkan tanggal">
                                    </div>
                                    <div class="col-md-3">
                                        <select name="pay_status" class="form-control form-select mb-sm-2">
                                            <option value="">-- Status Pembayaran --</option>
                                            <option value="Lunas" {{ request('pay_status') == 'Lunas' ? 'selected' : '' }}>
                                                Lunas</option>
                                            <option value="Belum Lunas"
                                                {{ request('pay_status') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="btn-group sm-full-fw mb-0 mb-sm-2" role="group"
                                            aria-label="Small button group">
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                            <a href="{{ route('rentals.index') }}" class="btn btn-outline-primary">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('rentals.create') }}" class="btn btn-primary float-end sm-full-fw mb-0">Tambah
                                Penyewaan</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive rounded-3 table-shadow">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" width="3%">No.</th>
                                    <th class="text-center align-middle">Penyewa</th>
                                    <th class="text-center align-middle">Jenis</th>
                                    <th class="text-center align-middle">Mobil</th>
                                    <th class="text-center align-middle">Nopol</th>
                                    <th class="text-center align-middle">Mulai</th>
                                    <th class="text-center align-middle">Selesai</th>
                                    <th class="text-center align-middle">Durasi</th>
                                    <th class="text-center align-middle">Total</th>
                                    <th class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rentals as $rental)
                                    <tr
                                        class="{{ $rental->status == 0 ? 'table-success' : '' }} {{ $rental->pay_status == 'Belum Lunas' ? 'table-danger' : '' }}">
                                        <td class="text-center align-middle">
                                            {{ ($rentals->currentPage() - 1) * $rentals->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('customers.show', $rental->customer_id) }}">
                                                {{ $rental->customer->name }}
                                            </a>
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
                                        <td class="text-center align-middle">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Tombol
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('rentals.show', $rental->id) }}"
                                                            class="dropdown-item py-2 align-middle">
                                                            Detail Transaksi
                                                        </a>
                                                    </li>
                                                    @if ($rental->status == 1)
                                                        <li>
                                                            <a href="{{ route('rentals.edit', $rental->id) }}"
                                                                class="dropdown-item py-2 align-middle">
                                                                Ubah Transaksi
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="dropdown-item py-2 align-middle"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalEditStatus-{{ $rental->id }}">
                                                                Ubah Status
                                                            </button>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{ route('rentals.print', $rental->id) }}" target="_blank"
                                                            class="dropdown-item py-2 align-middle">
                                                            Cetak Invoice
                                                        </a>
                                                    </li>
                                                    @if (Auth::check() && in_array(Auth::user()->role_id, [1, 2]))
                                                        @if ($rental->status == 1)
                                                            <li>
                                                                <a href="{{ route('rentals.destroy', $rental->id) }}"
                                                                    class="dropdown-item py-2 align-middle"
                                                                    data-confirm-delete="true">
                                                                    Hapus Transaksi
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>
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
                <div class="card-footer">
                    <div class="float-end">
                        {{ $rentals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
