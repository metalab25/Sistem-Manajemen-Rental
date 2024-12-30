@extends('dashboard.layouts.master')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
@endpush

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3 class="font-outfit mb-0">{{ $carCount }}</h3>
                            <p class="font-outfit">Mobil Tersedia</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 16 16"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17s3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
                        </svg>
                        <a href="{{ route('cars.index') }}"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3 class="font-outfit mb-0">{{ $customerCount }}</h3>
                            <p class="font-outfit">Penyewa</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 16 16"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                        </svg>
                        <a href="{{ route('customers.index') }}"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3 class="font-outfit mb-0">{{ formatRupiah($totalHariIni) }}</h3>
                            <p class="font-outfit">Penyewaan Hari Ini</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 18 18"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2" />
                            <path
                                d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332H5.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a13 13 0 0 1 1.313-.805h.632z" />
                        </svg>
                        </svg>
                        <a href="{{ route('rentals.index') }}"
                            class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3 class="font-outfit mb-0">{{ formatRupiah($totalBulanIni) }}</h3>
                            <p class="font-outfit">Penyewaan Bulan Ini</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 18 18"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zm.104 7.305L4.9 10.18H3.284l.8-2.375zm9.074 2.297c0-.832-.414-1.36-1.062-1.36-.692 0-1.098.492-1.098 1.36v.253c0 .852.406 1.364 1.098 1.364.671 0 1.062-.516 1.062-1.364z" />
                            <path
                                d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M2.56 12.332h-.71L3.748 7h.696l1.898 5.332h-.719l-.539-1.602H3.1zm7.29-4.105v4.105h-.668v-.539h-.027c-.145.324-.532.605-1.188.605-.847 0-1.453-.484-1.453-1.425V8.227h.676v2.554c0 .766.441 1.012.98 1.012.59 0 1.004-.371 1.004-1.023V8.227zm1.273 4.41c.075.332.422.636.985.636.648 0 1.07-.378 1.07-1.023v-.605h-.02c-.163.355-.613.648-1.171.648-.957 0-1.64-.672-1.64-1.902v-.34c0-1.207.675-1.887 1.64-1.887.558 0 1.004.293 1.195.64h.02v-.577h.648v4.03c0 1.052-.816 1.579-1.746 1.579-1.043 0-1.574-.516-1.668-1.2z" />
                        </svg>
                        <a href="{{ route('rentals.index') }}"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 connectedSortable">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Chart Pendapatan Sewa</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div id="dailyRentalChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 connectedSortable">
                    <div class="card direct-chat direct-chat-primary mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Chart Data Kas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div id="kasChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@4.3.0/dist/apexcharts.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);
            const labels = chartData.map(item => item.date);
            const totals = chartData.map(item => item.total);

            var options = {
                chart: {
                    type: 'area',
                    height: 300,
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Pendapatan Sewa',
                    data: totals
                }],
                xaxis: {
                    categories: labels,
                    labels: {
                        formatter: function(value) {
                            const date = new Date(value);
                            const day = date.getDate();
                            const month = date.toLocaleString('id-ID', {
                                month: 'short'
                            });
                            return `${day} ${month}`;
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return `${(value / 1000).toFixed(0)}rb`;
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(value) {
                        return `Rp. ${(value).toLocaleString('id-ID')}`;
                    },
                    style: {
                        fontSize: '12px',
                        fontWeight: 'bold',
                        colors: ['#ffffff']
                    },
                    background: {
                        enabled: true,
                        foreColor: '#000',
                        padding: 10,
                        borderRadius: 10,
                        borderWidth: 1,
                        borderColor: '#007bff',
                        opacity: 0.9,
                        dropShadow: {
                            enabled: true,
                            top: 1,
                            left: 1,
                            blur: 2,
                            color: '#000',
                            opacity: 0.25
                        }
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return `Rp. ${value.toLocaleString('id-ID')}`;
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#dailyRentalChart"), options);
            chart.render();
        });
    </script>

    <script>
        // Data dari Laravel
        const chartKasMasuk = @json($chartKasMasuk);
        const chartKasKeluar = @json($chartKasKeluar);

        // Memformat data untuk ApexCharts
        const kasMasukData = chartKasMasuk.map(item => ({
            x: item.date,
            y: item.total
        }));

        const kasKeluarData = chartKasKeluar.map(item => ({
            x: item.date,
            y: item.total
        }));

        // Konfigurasi Chart
        const options = {
            chart: {
                type: 'area',
                height: 300,
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                }
            },
            series: [{
                    name: 'Kas Masuk',
                    data: kasMasukData
                },
                {
                    name: 'Kas Keluar',
                    data: kasKeluarData
                }
            ],
            xaxis: {
                type: 'datetime'
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return `${(value / 1000).toFixed(0)}rb`;
                    }
                },
            },
            dataLabels: {
                enabled: true,
                formatter: function(value) {
                    return `Rp. ${(value).toLocaleString('id-ID')}`;
                },
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    colors: ['#ffffff']
                },
                background: {
                    enabled: true,
                    foreColor: '#000',
                    padding: 10,
                    borderRadius: 10,
                    borderWidth: 1,
                    borderColor: '#007bff',
                    opacity: 0.9,
                    dropShadow: {
                        enabled: true,
                        top: 1,
                        left: 1,
                        blur: 2,
                        color: '#000',
                        opacity: 0.25
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return `Rp. ${value.toLocaleString('id-ID')}`;
                    }
                }
            },
            colors: ['#00E396', '#FF4560'],
            legend: {
                show: false
            }
        };

        // Render Chart
        const chart = new ApexCharts(document.querySelector("#kasChart"), options);
        chart.render();
    </script>
@endpush
