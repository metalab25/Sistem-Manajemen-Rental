@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('application.update', $config->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <input type="hidden" name="oldIcon" value="{{ $config->icon }}">
                                    @if ($config->icon)
                                        <img src="{{ asset('storage/' . $config->icon) }}"
                                            class="icon-preview img-fluid rounded-3 d-block mx-auto mb-3">
                                    @else
                                        <img src="{{ asset('/assets/img/logo.png') }}"
                                            class="icon-preview img-fluid rounded-3 d-block mx-auto mb-3">
                                    @endif
                                </div>
                                <div class="mb-0">
                                    <input class="form-control @error('icon') is-invalid @enderror" type="file"
                                        name="icon" id="icon" onchange="previewIcon()">
                                    @error('icon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row form-group mb-3">
                                    <label for="inv_code" class="form-label col-md-3">Format Kode Invoice</label>
                                    <div class="col-md-9">
                                        <input type="text" name="inv_code" id="inv_code"
                                            class="form-control @error('inv_code') is-invalid @enderror"
                                            value="{{ old('inv_code', $config->inv_code) }}">
                                        @error('inv_code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="inv_start_number" class="form-label col-md-3">Nomor Awal Invoice</label>
                                    <div class="col-md-9">
                                        <input type="text" name="inv_start_number" id="inv_start_number"
                                            class="form-control @error('inv_start_number') is-invalid @enderror"
                                            value="{{ old('inv_start_number', $config->inv_start_number) }}">
                                        @error('inv_start_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="google_verification" class="form-label col-md-3">Kode Google Site
                                        Verifikasi</label>
                                    <div class="col-md-9">
                                        <input type="text" name="google_verification" id="google_verification"
                                            class="form-control"
                                            value="{{ old('google_verification', $config->google_verification) }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="web_title" class="form-label col-md-3">Judul Website</label>
                                    <div class="col-md-9">
                                        <input type="text" name="web_title" id="web_title" class="form-control"
                                            value="{{ old('web_title', $config->web_title) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="timezone" class="form-label col-md-3">Zona Waktu</label>
                                    <div class="col-md-9">
                                        <select class="form-control form-select @error('timezone') is-invalid @enderror"
                                            id="timezone" name="timezone">
                                            <option value="Asia/Jakarta"
                                                {{ $config->timezone == 'Asia/Jakarta' ? 'selected' : '' }}>
                                                Asia/Jakarta
                                            </option>
                                            <option value="Asia/Makassar"
                                                {{ $config->timezone == 'Asia/Makassar' ? 'selected' : '' }}>
                                                Asia/Makassar
                                            </option>
                                            <option value="Asia/Pontianak"
                                                {{ $config->timezone == 'Asia/Pontianak' ? 'selected' : '' }}>
                                                Asia/Pontianak
                                            </option>
                                            <option value="Asia/Jayapura"
                                                {{ $config->timezone == 'Asia/Jayapura' ? 'selected' : '' }}>
                                                Asia/Jayapura
                                            </option>
                                        </select>
                                        @error('timezone')
                                            <div class="invalid-feedback">
                                                {{ 'Zona waktu harus dipilih' }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary btn-sm mb-0">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function previewIcon() {
            const icon = document.querySelector('#icon');
            const imgPreview = document.querySelector('.icon-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(icon.files[0]);

            oFReader.onLoad = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
            const blob = URL.createObjectURL(icon.files[0]);
            imgPreview.src = blob;
        }
    </script>
@endpush
