@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('/assets/img/no-foto.png') }}"
                                        class="foto-preview img-fluid rounded-3 d-block mx-auto mb-3">
                                </div>
                                <div class="mb-0">
                                    <input class="form-control @error('foto') is-invalid @enderror" type="file"
                                        name="foto" id="foto" onchange="previewFoto()">
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header py-3">
                                <h3 class="font-outfit mb-0">Profil</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-3">
                                    <label for="role_id" class="form-label col-md-3">Grup</label>
                                    <div class="col-md-9">
                                        <select class="form-control form-select @error('role_id') is-invalid @enderror"
                                            id="role_id" name="role_id">
                                            <option value="">-- Pilih Grup --</option>
                                            @foreach ($roles as $item)
                                                @if (old('role_id') == $item->id)
                                                    <option value="{{ $item->id }}" selected>
                                                        {{ $item->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->id }}"> {{ $item->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <div class="invalid-feedback">
                                                {{ 'Provinsi harus diisi' }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="name" class="form-label col-md-3">Nama Lengkap</label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name') }}" placeholder="Nama lengkap pengguna...">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="username" class="form-label col-md-3">Username</label>
                                    <div class="col-md-9">
                                        <input type="text" name="username" id="username" class="form-control"
                                            value="{{ old('username') }}" placeholder="Username...">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="password" class="form-label col-md-3">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Kosongkan jika tidak ingin mengubah">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="email" class="form-label col-md-3">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ old('email') }}" placeholder="Email aktif pengguna...">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="phone" class="form-label col-md-3">Telepon</label>
                                    <div class="col-md-9">
                                        <input type="number" name="phone" id="phone" class="form-control"
                                            value="{{ old('phone') }}" placeholder="Nomor telepon pengguna...">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
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
        function previewFoto() {
            const foto = document.querySelector('#foto');
            const imgPreview = document.querySelector('.foto-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto.files[0]);

            oFReader.onLoad = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
            const blob = URL.createObjectURL(foto.files[0]);
            imgPreview.src = blob;
        }
    </script>
@endpush
