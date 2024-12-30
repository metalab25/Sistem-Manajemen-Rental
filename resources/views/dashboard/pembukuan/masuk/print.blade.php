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
        <div class="header mb-4">
            <div class="d-flex justify-content-center mx-auto mt-5">
                @if ($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" class="logo-kas img-fluid rounded-3 d-block">
                @else
                    <img src="{{ asset('/assets/img/logo.png') }}" class="logo-kas img-fluid rounded-3 d-block">
                @endif
            </div>
            <div class="text-center">
                <h3 class="company-name font-outfit">{{ $company->name }}</h3>
                <p class="font-xs">
                    {{ $company->address . '.' }}<br>
                    {{ $company->city . ', ' . $company->province->name . '. ' . $company->postcode }}<br>
                    {{ 'Telepon : ' . $company->phone . ' - Email : ' . $company->email }}<br>
                    {{ $company->website ?? '' }}
                </p>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-6">
                <div class="text-start">
                    <b>Dicetak :</b> {{ tanggal_indonesia(now()) }}
                </div>
            </div>
            <div class="col-md-6">
                @if (request()->has(['start_date', 'end_date']) && request()->start_date && request()->end_date)
                    <div class="text-end"><b>Mulai : </b>
                        {{ tanggal_indonesia(request()->start_date, false) }}
                        s/d
                        {{ tanggal_indonesia(request()->end_date, false) }}
                    </div>
                @else
                    <div class="text-end"><b>Bulan :</b>
                        <span class="text-uppercase">{{ ' ' . now()->translatedFormat('F Y') }}</span>
                    </div>
                @endif
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="3%">No.</th>
                        <th class="text-center align-middle">Tanggal</th>
                        <th class="text-center align-middle">Item</th>
                        <th class="text-center align-middle">Tipe</th>
                        <th class="text-center align-middle">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cashIns as $index => $cashin)
                        <tr class="{{ $cashin->status == 0 ? 'table-danger' : '' }}">
                            <td class="text-center align-middle">
                                {{ $index + 1 }}
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
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-center text-uppercase">Total</th>
                        <th class="text-center text-uppercase">{{ formatRupiah($totalSum) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
