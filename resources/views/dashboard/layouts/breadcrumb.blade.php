<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                @if (request()->segment(1) == 'accountancy')
                    <h3 class="pt-1 mb-0">{{ $page . ' ' . now()->translatedFormat('F Y') }}</h3>
                @else
                    <h3 class="pt-1 mb-0">{{ $page }}</h3>
                @endif

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    @if (request()->segment(1) != 'dashboard')
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $page }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
