@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header pb-sm-2">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="GET" action="{{ route('reports.index') }}">
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
                                        <div class="btn-group sm-full-fw mb-0 mb-sm-2" role="group"
                                            aria-label="Small button group">
                                            <button type="submit" class="btn btn-primary">Filer</button>
                                            <a href="{{ route('reports.index') }}" class="btn btn-outline-primary">Reset</a>
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
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalAddCashIn">Tambah Data</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive rounded-3 table-shadow">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" width="2%">No.</th>
                                    <th class="text-center align-middle">Tanggal</th>
                                    <th class="text-center align-middle">Item Kas Masuk</th>
                                    <th class="text-center align-middle" width="12%">Nominam</th>
                                    <th class="text-center align-middle">Item Kas Keluar</th>
                                    <th class="text-center align-middle" width="12%">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporanKeuangan as $row)
                                    <tr>
                                        <td class="text-center"
                                            rowspan="{{ max($row['kas_masuk']->count(), $row['kas_keluar']->count()) ?: 1 }}">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center"
                                            rowspan="{{ max($row['kas_masuk']->count(), $row['kas_keluar']->count()) ?: 1 }}">
                                            {{ tanggal_indonesia($row['date'], false) }}
                                        </td>

                                        {{-- Data pertama Kas Masuk --}}
                                        @if ($row['kas_masuk']->isNotEmpty())
                                            <td>{{ $row['kas_masuk']->first()->item }}</td>
                                            <td class="text-end">
                                                {{ formatRupiah($row['kas_masuk']->first()->total, 0, ',', '.') }}</td>
                                        @else
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                        @endif

                                        {{-- Data pertama Kas Keluar --}}
                                        @if ($row['kas_keluar']->isNotEmpty())
                                            <td>{{ $row['kas_keluar']->first()->item }}</td>
                                            <td class="text-end">
                                                {{ formatRupiah($row['kas_keluar']->first()->total, 0, ',', '.') }}</td>
                                        @else
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                        @endif
                                    </tr>

                                    {{-- Data selanjutnya --}}
                                    @php
                                        $maxRow = max($row['kas_masuk']->count(), $row['kas_keluar']->count());
                                    @endphp
                                    @for ($i = 1; $i < $maxRow; $i++)
                                        <tr>
                                            @if ($row['kas_masuk']->has($i))
                                                <td>{{ $row['kas_masuk'][$i]->item }}</td>
                                                <td class="text-end">
                                                    {{ formatRupiah($row['kas_masuk'][$i]->total, 0, ',', '.') }}</td>
                                            @else
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                            @endif

                                            @if ($row['kas_keluar']->has($i))
                                                <td>{{ $row['kas_keluar'][$i]->item }}</td>
                                                <td class="text-end">
                                                    {{ formatRupiah($row['kas_keluar'][$i]->total, 0, ',', '.') }}</td>
                                            @else
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                            @endif
                                        </tr>
                                    @endfor
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-secondary">
                                    <td class="text-center align-middle fw-bold text-uppercase" colspan="5">Total Kas
                                        Masuk</td>
                                    <td class="text-end align-middle fw-bold text-uppercase">
                                        {{ formatRupiah($totalKasMasuk, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center align-middle fw-bold text-uppercase" colspan="5">Total Kas
                                        Keluar</td>
                                    <td class="text-end align-middle fw-bold text-uppercase">
                                        {{ formatRupiah($totalKasKeluar, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="table-secondary">
                                    <td class="text-center align-middle fw-bold text-uppercase" colspan="5">Total Kas
                                    </td>
                                    <td class="text-end align-middle fw-bold text-uppercase">
                                        {{ formatRupiah($pendapatan, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
