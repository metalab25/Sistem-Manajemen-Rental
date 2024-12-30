@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header pb-sm-2">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="GET" action="{{ route('cashins.index') }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                            value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <p class="text-center align-middle pt-2 mb-0">S/D</p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="end_date" id="end_date" class="form-control mb-sm-2"
                                            value="{{ request('end_date') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <select name="status" id="status" class="form-select mb-sm-2">
                                            <option value="">Semua</option>
                                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Normal
                                            </option>
                                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Void
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="btn-group sm-full-fw mb-0 mb-sm-2" role="group"
                                            aria-label="Small button group">
                                            <button type="submit" class="btn btn-primary">Filer</button>
                                            <a href="{{ route('cashins.index') }}" class="btn btn-outline-primary">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group sm-full-fw float-end mb-0" role="group" aria-label="Small button group">
                                <a href="{{ route('cashins.print', request()->query()) }}" target="_blank"
                                    class="btn btn-dark">Cetak Data</a>
                                <a href="" class="btn btn-success">Export Data</a>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalAddCashIn">Tambah Data</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive rounded-3 table-shadow">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" width="3%">No.</th>
                                    <th class="text-center align-middle">Tanggal</th>
                                    <th class="text-center align-middle">Item</th>
                                    <th class="text-center align-middle">Tipe</th>
                                    <th class="text-center align-middle">Jumlah</th>
                                    <th class="text-center align-middle">Input</th>
                                    @if (Auth::check() && in_array(Auth::user()->role_id, [1, 2]))
                                        <th class="text-center align-middle">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashIns as $cashin)
                                    <tr class="{{ $cashin->status == 0 ? 'table-danger' : '' }}">
                                        <td class="text-center align-middle">
                                            {{ ($cashIns->currentPage() - 1) * $cashIns->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="align-middle">
                                            {{ tanggal_indonesia($cashin->transaction_at, false) }}
                                        </td>
                                        <td class="align-middle">
                                            @if ($cashin->type == 'Penyewaan')
                                                {{ $cashin->item . ' ' . tanggal_indonesia($cashin->rent_date, false) }}
                                            @else
                                                {{ $cashin->item }}
                                            @endif

                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $cashin->type }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ formatRupiah($cashin->total) }}
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($cashin->type == 'Penyewaan')
                                                Sistem
                                            @else
                                                {{ $cashin->user->name }}
                                            @endif

                                        </td>
                                        @if (Auth::check() && in_array(Auth::user()->role_id, [1, 2]))
                                            <td class="text-center align-middle">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Tombol
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('cashins.show', $cashin->id) }}"
                                                                class="dropdown-item py-2 align-middle">
                                                                Detail Transaksi
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('cashins.edit', $cashin->id) }}"
                                                                class="dropdown-item py-2 align-middle">
                                                                Ubah Transaksi
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ route('cashins.destroy', $cashin->id) }}"
                                                                class="dropdown-item py-2 align-middle"
                                                                data-confirm-delete="true">
                                                                Hapus Transaksi
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-center text-uppercase">Total</th>
                                    <th class="text-center text-uppercase">{{ formatRupiah($totalSum) }}</th>
                                    <th></th>
                                    @if (Auth::check() && in_array(Auth::user()->role_id, [1, 2]))
                                        <th></th>
                                    @endif
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        {{ $cashIns->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.pembukuan.masuk.modal-add')
@endsection
