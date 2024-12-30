@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('cars.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header py-3">
                                <h3 class="font-outfit mb-0">Foto Mobil</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('/assets/img/no-picture.webp') }}"
                                        class="image-preview img-fluid rounded-3 d-block mx-auto mb-3">
                                </div>
                                <div class="mb-0">
                                    <input class="form-control @error('image') is-invalid @enderror" type="file"
                                        name="image" id="image" onchange="previewImage()">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header py-3">
                                <h3 class="font-outfit mb-0">Foto Dalam</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('/assets/img/no-picture.webp') }}"
                                        class="interior-preview img-fluid rounded-3 d-block mx-auto mb-3">
                                </div>
                                <div class="mb-0">
                                    <input class="form-control @error('interior') is-invalid @enderror" type="file"
                                        name="interior" id="interior" onchange="previewInterior()">
                                    @error('interior')
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
                            <div class="card-header py-3">
                                <h3 class="font-outfit mb-0">Data Mobil</h3>
                            </div>
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="owner_id" class="form-label">Pemilik</label>
                                            <select class="form-control form-select @error('owner_id') is-invalid @enderror"
                                                id="owner_id" name="owner_id">
                                                <option value="">-- Pilih Pemilik --</option>
                                                @foreach ($owners as $owner)
                                                    @if (old('owner_id') == $owner->id)
                                                        <option value="{{ $owner->id }}" selected>
                                                            {{ $owner->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $owner->id }}"> {{ $owner->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('owner_id')
                                                <div class="invalid-feedback">
                                                    {{ 'Pemilik mobil harus dipilih' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="merk_id" class="form-label">Brand</label>
                                            <select class="form-control form-select @error('merk_id') is-invalid @enderror"
                                                id="merk_id" name="merk_id">
                                                <option value="">-- Pilih Brand --</option>
                                                @foreach ($merks as $merk)
                                                    @if (old('merk_id') == $merk->id)
                                                        <option value="{{ $merk->id }}" selected>
                                                            {{ $merk->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $merk->id }}"> {{ $merk->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('merk_id')
                                                <div class="invalid-feedback">
                                                    {{ 'Brand mobil harus dipilih' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Nama Mobil</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" placeholder="Tuliskan nama mobil...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ 'Nama mobil harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="nopol" class="form-label">Nomor Polisi</label>
                                            <input type="text" name="nopol" id="nopol"
                                                class="form-control @error('nopol') is-invalid @enderror"
                                                value="{{ old('nopol') }}" placeholder="Tuliskan nama mobil...">
                                            @error('nopol')
                                                <div class="invalid-feedback">
                                                    {{ 'Nomor polisi mobil harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="transmission_id" class="form-label">Transmisi</label>
                                            <select
                                                class="form-control form-select @error('transmission_id') is-invalid @enderror"
                                                id="transmission_id" name="transmission_id">
                                                <option value="">-- Pilih Transmisi --</option>
                                                @foreach ($transmissions as $transmission)
                                                    @if (old('transmission_id') == $transmission->id)
                                                        <option value="{{ $transmission->id }}" selected>
                                                            {{ $transmission->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $transmission->id }}"> {{ $transmission->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('transmission_id')
                                                <div class="invalid-feedback">
                                                    {{ 'Transmisi mobil harus dipilih' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="fuel_id" class="form-label">Bahan Bakar</label>
                                            <select class="form-control form-select @error('fuel_id') is-invalid @enderror"
                                                id="fuel_id" name="fuel_id">
                                                <option value="">-- Pilih Bahan Bakar --</option>
                                                @foreach ($fuels as $fuel)
                                                    @if (old('fuel_id') == $fuel->id)
                                                        <option value="{{ $fuel->id }}" selected>
                                                            {{ $fuel->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $fuel->id }}"> {{ $fuel->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('fuel_id')
                                                <div class="invalid-feedback">
                                                    {{ 'Bahan bakar mobil harus dipilih' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="type_id" class="form-label">Tipe Mobil</label>
                                            <select class="form-control form-select @error('type_id') is-invalid @enderror"
                                                id="type_id" name="type_id">
                                                <option value="">-- Pilih Tipe --</option>
                                                @foreach ($types as $type)
                                                    @if (old('type_id') == $type->id)
                                                        <option value="{{ $type->id }}" selected>
                                                            {{ $type->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $type->id }}"> {{ $type->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('type_id')
                                                <div class="invalid-feedback">
                                                    {{ 'Tipe mobil harus dipilih' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="passenger_id" class="form-label">Kapasitas</label>
                                            <select
                                                class="form-control form-select @error('passenger_id') is-invalid @enderror"
                                                id="passenger_id" name="passenger_id">
                                                <option value="">-- Pilih Kapasitas --</option>
                                                @foreach ($passengers as $passenger)
                                                    @if (old('passenger_id') == $passenger->id)
                                                        <option value="{{ $passenger->id }}" selected>
                                                            {{ $passenger->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $passenger->id }}"> {{ $passenger->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('passenger_id')
                                                <div class="invalid-feedback">
                                                    {{ 'Kapasitas mobil harus dipilih' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="color" class="form-label">Warna Mobil</label>
                                                <input type="text" name="color" id="color"
                                                    class="form-control @error('color') is-invalid @enderror"
                                                    value="{{ old('color') }}" placeholder="Tuliskan warna mobil...">
                                                @error('color')
                                                    <div class="invalid-feedback">
                                                        {{ 'Warna mobil harus diisi' }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="year" class="form-label">Tahun Mobil</label>
                                                <input type="number" name="year" id="year"
                                                    class="form-control @error('year') is-invalid @enderror"
                                                    value="{{ old('year') }}" placeholder="Tuliskan tahun mobil...">
                                                @error('year')
                                                    <div class="invalid-feedback">
                                                        {{ 'Tahun mobil harus diisi' }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-header mb-2">Tarif Mobil</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="basic_price" class="form-label">Modal</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <span>Rp.</span>
                                                </div>
                                                <input type="number" name="basic_price" id="basic_price"
                                                    class="form-control @error('basic_price') is-invalid @enderror"
                                                    value="{{ old('basic_price') }}" placeholder="300000...">
                                            </div>
                                            @error('basic_price')
                                                <div class="invalid-feedback">
                                                    {{ 'Modal mobil harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="rental_price" class="form-label">Tarif Mitra</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <span>Rp.</span>
                                                </div>
                                                <input type="number" name="rental_price" id="rental_price"
                                                    class="form-control @error('rental_price') is-invalid @enderror"
                                                    value="{{ old('rental_price') }}" placeholder="350000...">
                                            </div>
                                            @error('rental_price')
                                                <div class="invalid-feedback">
                                                    {{ 'Tarif mitra mobil harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="public_price" class="form-label">Tarif Retail</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <span>Rp.</span>
                                                </div>
                                                <input type="number" name="public_price" id="public_price"
                                                    class="form-control @error('public_price') is-invalid @enderror"
                                                    value="{{ old('public_price') }}" placeholder="400000...">
                                            </div>
                                            @error('public_price')
                                                <div class="invalid-feedback">
                                                    {{ 'Tarif sewa retail mobil harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="month_price" class="form-label">Tarif Bulanan</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <span>Rp.</span>
                                                </div>
                                                <input type="number" name="month_price" id="month_price"
                                                    class="form-control @error('month_price') is-invalid @enderror"
                                                    value="{{ old('month_price') }}" placeholder="9000000...">
                                            </div>
                                            @error('month_price')
                                                <div class="invalid-feedback">
                                                    {{ 'Tarif bulanan mobil harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('cars.index') }}" class="btn btn-danger btn-sm mb-0">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-sm float-end mb-0">Simpan</button>
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
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.image-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onLoad = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
            const blob = URL.createObjectURL(image.files[0]);
            imgPreview.src = blob;
        }

        function previewInterior() {
            const interior = document.querySelector('#interior');
            const imgPreview = document.querySelector('.interior-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(interior.files[0]);

            oFReader.onLoad = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
            const blob = URL.createObjectURL(interior.files[0]);
            imgPreview.src = blob;
        }
    </script>
@endpush
