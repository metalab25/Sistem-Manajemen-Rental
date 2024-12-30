@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('customers.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header py-3">
                                <h3 class="font-outfit mb-0">Foto Kartu Identitas</h3>
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
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header py-3">
                                <h3 class="font-outfit mb-0">Data Penyewa</h3>
                            </div>
                            <div class="card-body">
                                <div class="row form-group mb-3">
                                    <label for="name" class="form-label col-md-3">Nama Lengkap</label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}"
                                            placeholder="Tuliskan nama lengkap sesuai kartu identitas...">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ 'Nama lengkap harus diisi' }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="id_number" class="form-label col-md-3">Nomor Kartu Identitas</label>
                                    <div class="col-md-9">
                                        <input type="text" name="id_number" id="id_number"
                                            class="form-control @error('id_number') is-invalid @enderror"
                                            value="{{ old('id_number') }}" placeholder="Tuliskan nomor kartu identitas...">
                                        @error('id_number')
                                            <div class="invalid-feedback">
                                                {{ 'Nomor kartu identitas harus diisi' }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="address" class="form-label col-md-3">Alamat Tempat Tinggal</label>
                                    <div class="col-md-9">
                                        <textarea name="address" id="address" cols="30" rows="2"
                                            class="form-control @error('address') is-invalid @enderror" placeholder="Tuliskan alamat tempat tinggal...">{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ 'Alamat tempat tinggal harus diisi' }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="city" class="form-label col-md-3">Kota/Kabupaten</label>
                                    <div class="col-md-9">
                                        <input type="text" name="city" id="city"
                                            class="form-control @error('city') is-invalid @enderror"
                                            value="{{ old('city') }}" placeholder="Tuliskan kota tempat tinggal...">
                                        @error('city')
                                            <div class="invalid-feedback">
                                                {{ 'Kota tempat tinggal harus diisi' }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="province_id" class="form-label col-md-3">Provinsi</label>
                                    <div class="col-md-9">
                                        <select class="form-control form-select @error('province_id') is-invalid @enderror"
                                            id="province_id" name="province_id">
                                            <option value="">-- Pilih Provinsi --</option>
                                            @foreach ($province as $item)
                                                @if (old('province_id') == $item->id)
                                                    <option value="{{ $item->id }}" selected>
                                                        {{ $item->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->id }}"> {{ $item->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                            <div class="invalid-feedback">
                                                {{ 'Provinsi harus diisi' }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="email" class="form-label col-md-3">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" placeholder="Tuliskan email aktif...">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ 'Email aktif harus diisi' }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="phone" class="form-label col-md-3">Telepon</label>
                                    <div class="col-md-9">
                                        <input type="number" name="phone" id="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" placeholder="Tuliskan nomor telepon...">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ 'Nomor telepon harus diisi' }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="company" class="form-label col-md-3">Perusahaan</label>
                                    <div class="col-md-9">
                                        <input type="text" name="company" id="company"
                                            class="form-control @error('company') is-invalid @enderror"
                                            value="{{ old('company') }}" placeholder="Tuliskan nama perusahaan...">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer py-3">
                                <a href="{{ route('users.index') }}" class="btn btn-danger btn-sm mb-0">Kembali</a>
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
    </script>
@endpush
