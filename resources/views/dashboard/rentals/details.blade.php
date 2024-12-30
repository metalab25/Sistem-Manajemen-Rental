@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <input type="hidden" name="oldLogo" value="{{ $company->logo }}">
                                @if ($rental->image)
                                    <img src="{{ asset('storage/' . $rental->image) }}"
                                        class="logo-preview img-fluid rounded-3 d-block mx-auto">
                                @else
                                    <img src="{{ asset('/assets/img/no-picture.webp') }}"
                                        class="logo-preview img-fluid rounded-3 d-block mx-auto">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase" width="15%">Nama Penyewa</td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase" colspan="4">{{ $rental->customer->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase">No. Identitas
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase" colspan="4">
                                            {{ $rental->customer->id_number ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase">Alamat Tinggal
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase" colspan="4">
                                            {{ $rental->customer->address . '. ' . $rental->customer->city . ', ' . $rental->customer->province->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase">Nomor Telepon
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase" colspan="4">
                                            {{ $rental->customer->phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase">Alamat Email
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase" colspan="4">
                                            {{ $rental->customer->email ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0 py-2" colspan="6">
                                            <div class="form-header text-uppercase py-2">Data Penyewaan</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase">Kendaraan
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ $rental->car->merk->name . ' ' . $rental->car->name }}
                                        </td>
                                        <td class="align-center fw-semibold text-uppercase">Plat Nomor
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ $rental->car->nopol }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase">Tanggal Sewa
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ tanggal_indonesia($rental->tgl_start, false) }}
                                        </td>
                                        <td class="align-center fw-semibold text-uppercase">Jam Sewa
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ \Carbon\Carbon::parse($rental->jam_start)->format('H:i') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase">Tanggal Selesai
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ tanggal_indonesia($rental->tgl_end, false) }}
                                        </td>
                                        <td class="align-center fw-semibold text-uppercase">Jam Selesai
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ \Carbon\Carbon::parse($rental->jam_end)->format('H:i') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase">Tarif Perhari
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ formatRupiah($rental->tarif) }}
                                        </td>
                                        <td class="align-center fw-semibold text-uppercase">Durasi Sewa
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ $rental->durasi . ' Hari' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase">Total
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ formatRupiah($rental->total) }}
                                        </td>
                                        <td class="align-center fw-semibold text-uppercase" width="17%">Status Pembayaran
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ $rental->pay_status }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase" width="17%">DP Pembayaran
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ formatRupiah($rental->dp) }}
                                        </td>
                                        <td class="align-center fw-semibold text-uppercase" width="16%">Sisa Pembayaran
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ formatRupiah($rental->balance) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-center fw-semibold text-uppercase">Jenis Sewa
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ $rental->type }}
                                        </td>
                                        <td class="align-center fw-semibold text-uppercase">Marketing
                                        </td>
                                        <td class="align-center fw-semibold" width="1%">:</td>
                                        <td class="align-center text-uppercase">
                                            {{ $rental->marketing }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3">
                        <a href="{{ route('rentals.index') }}" class="btn btn-danger btn-sm mb-0">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm float-end mb-0" id="printBtn">Cetak
                            Invoice</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.getElementById('printBtn').addEventListener('click', function() {
            window.open("{{ route('rentals.print', $rental->id) }}", "_blank");
        });
    </script>
@endpush
