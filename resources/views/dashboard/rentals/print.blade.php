<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | {{ $page }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ '/assets/img/logo.png' }}">
    <link rel="shortcut icon" href="{{ '/assets/img/logo.png' }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/print.css') }}">
</head>

<body>
    <div class="container">
        <div class="header my-3 pb-3 pt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="justify-content-start">
                        @if ($company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}"
                                class="logo-inv img-fluid rounded-3 d-block">
                        @else
                            <img src="{{ asset('/assets/img/logo.png') }}" class="logo-inv img-fluid rounded-3 d-block">
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="justify-content-end">
                        <div class="text-end">
                            <h3 class="font-outfit fw-bold mb-0">{{ $company->name }}</h3>
                            <p class="font-xs">
                                {{ $company->address . '.' }}<br>
                                {{ $company->city . ', ' . $company->province->name . '. ' . $company->postcode }}<br>
                                {{ 'Telepon : ' . $company->phone . ' - Email : ' . $company->email }}<br>
                                {{ $company->website ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="inv-detail mt-5">
            <div class="row">
                <div class="col-md-4">
                    <ul class="customer">
                        <li><b>Nama :</b> {{ $rental->customer->name }}</li>
                        <li><b>Kota :</b> {{ $rental->customer->city }}</li>
                        <li><b>Telepon :</b> {{ $rental->customer->phone }}</li>
                    </ul>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <ul class="customer text-end">
                        <li>Nomor Invoice. : <b>{{ $rental->inv_number }}</b></li>
                        <li>Tanggal Invoice : <b>{{ tanggal_indonesia(now(), false) }}</b></li>
                        @if ($rental->pay_status == 'Belum Lunas')
                            <li>Tanggal Jatuh Tempo :
                                <b>{{ tanggal_indonesia(\Carbon\Carbon::now()->addDays(3), false) }}</b>
                            </li>
                        @elseif ($rental->pay_status == 'Lunas')
                            <li>Status Pembayaran :
                                <b>{{ $rental->pay_status }}</b>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </section>
        <section class="inv-data-sewa mt-5">
            <div class="table-responsive">
                <table class="table table-bordered mb-5">
                    <thead>
                        <tr class="table-secondary">
                            <th class="text-center align-middle" width="2%">No.</th>
                            <th class="text-center align-middle">Item</th>
                            <th class="text-center align-middle">Durasi</th>
                            <th class="text-center align-middle">Layanan</th>
                            <th class="text-center align-middle">Jumlah</th>
                            <th class="text-center align-middle">Tarif</th>
                            <th class="text-center align-middle">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" rowspan="3">1</td>
                            <td class="align-middle fw-bold text-uppercase">
                                {{ $rental->car->merk->name . ' ' . $rental->car->name . ' - ' . $rental->car->nopol }}
                            </td>
                            <td class="text-center align-middle" rowspan="3">{{ $rental->durasi }}</td>
                            <td class="text-center align-middle" rowspan="3">{{ $rental->type }}</td>
                            <td class="text-center align-middle" rowspan="3">1</td>
                            <td class="text-center align-middle" rowspan="3">{{ formatRupiah($rental->tarif) }}</td>
                            <td class="text-end align-middle" rowspan="3">{{ formatRupiah($rental->total) }}</td>
                        </tr>
                        <tr>
                            <td class="align-middle">
                                {{ 'Mulai : ' . tanggal_indonesia($rental->tgl_start) . ' ' . \Carbon\Carbon::parse($rental->jam_start)->format('H:i') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">
                                {{ 'Selesai : ' . tanggal_indonesia($rental->tgl_end) . ' ' . \Carbon\Carbon::parse($rental->jam_end)->format('H:i') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-end align-middle fw-bold" colspan="6">Down Payment</td>
                            <td class="text-end align-middle fw-bold">{{ formatRupiah($rental->dp) }}</td>
                        </tr>
                        <tr>
                            <td class="text-end align-middle fw-bold" colspan="6">Sisa Pembayaran</td>
                            <td class="text-end align-middle fw-bold">{{ formatRupiah($rental->balance) }}</td>
                        </tr>
                        <tr>
                            <td class="text-end align-middle fw-bold" colspan="6">Total Pembayaran</td>
                            <td class="text-end align-middle fw-bold">{{ formatRupiah($rental->total) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="terbilang text-capitalize">
                        <b>Terbilang : </b> <i>{{ terbilang($rental->total) . ' Rupiah' }}</i>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    @if ($rental->pay_status == 'Lunas')
                        <div
                            class="status-pembayaran bg-success text-center text-white text-uppercase fw-bold align-center">
                            {{ $rental->pay_status }}
                        </div>
                    @elseif ($rental->pay_status == 'Belum Lunas')
                        <div
                            class="status-pembayaran bg-danger text-center text-white text-uppercase fw-bold align-center">
                            {{ $rental->pay_status }}
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>


    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
