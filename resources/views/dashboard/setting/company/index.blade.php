@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('company.update', $company->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <input type="hidden" name="oldLogo" value="{{ $company->logo }}">
                                    @if ($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}"
                                            class="logo-preview img-fluid rounded-3 d-block mx-auto mb-3">
                                    @else
                                        <img src="{{ asset('/assets/img/logo.png') }}"
                                            class="logo-preview img-fluid rounded-3 d-block mx-auto mb-3">
                                    @endif
                                </div>
                                <div class="mb-0">
                                    <input class="form-control @error('logo') is-invalid @enderror" type="file"
                                        name="logo" id="logo" onchange="previewLogo()">
                                    @error('logo')
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
                                    <label for="garage" class="form-label col-md-3">Nama Garasi</label>
                                    <div class="col-md-9">
                                        <input type="text" name="garage" id="garage" class="form-control"
                                            value="{{ old('garage', $company->garage) }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="company" class="form-label col-md-3">Nama Perusahaan</label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('company', $company->name) }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="owner" class="form-label col-md-3">Nama Direktur</label>
                                    <div class="col-md-9">
                                        <input type="text" name="owner" id="owner" class="form-control"
                                            value="{{ old('owner', $company->owner) }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="nib" class="form-label col-md-3">NIB</label>
                                    <div class="col-md-9">
                                        <input type="text" name="nib" id="nib" class="form-control"
                                            value="{{ old('nib', $company->nib) }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="npwp" class="form-label col-md-3">NPWP</label>
                                    <div class="col-md-9">
                                        <input type="text" name="npwp" id="npwp" class="form-control"
                                            value="{{ old('npwp', $company->npwp) }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="address" class="form-label col-md-3">Alamat Garasi</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="address" id="address" cols="30" rows="3">{{ old('address', $company->address) }}</textarea>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="city" class="form-label col-md-3">Kota/Kabupaten</label>
                                    <div class="col-md-9">
                                        <input type="text" name="city" id="city" class="form-control"
                                            value="{{ old('city', $company->city) }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="postcode" class="form-label col-md-3">Kode Pos</label>
                                    <div class="col-md-9">
                                        <input type="number" name="postcode" id="postcode" class="form-control"
                                            value="{{ old('postcode', $company->postcode) }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="province_id" class="form-label col-md-3">Provinsi</label>
                                    <div class="col-md-9">
                                        <select class="form-control form-select @error('province_id') is-invalid @enderror"
                                            id="province_id" name="province_id">
                                            <option value="">-- Pilih Provinsi --</option>
                                            @foreach ($province as $item)
                                                @if (old('province_id', $company->province_id) == $item->id)
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
                                    <label for="map" class="form-label col-md-3">Lokasi Garasi</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="map" id="map" cols="30" rows="5"
                                            placeholder="Embed Google Maps...">{{ old('map', $company->map ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="email" class="form-label col-md-3">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ old('email', $company->email) }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="phone" class="form-label col-md-3">Telepon</label>
                                    <div class="col-md-9">
                                        <input type="number" name="phone" id="phone" class="form-control"
                                            value="{{ old('phone', $company->phone) }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="whatsapp" class="form-label col-md-3">WhatsApp</label>
                                    <div class="col-md-9">
                                        <input type="number" name="whatsapp" id="whatsapp" class="form-control"
                                            value="{{ old('whatsapp', $company->whatsapp) }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="website" class="form-label col-md-3">Website</label>
                                    <div class="col-md-9">
                                        <input type="url" name="website" id="website" class="form-control"
                                            value="{{ old('website', $company->website ?? '') }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="facebook" class="form-label col-md-3">Facebook</label>
                                    <div class="col-md-9">
                                        <input type="url" name="facebook" id="facebook" class="form-control"
                                            value="{{ old('facebook', $company->facebook ?? '') }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="twitter" class="form-label col-md-3">Twitter</label>
                                    <div class="col-md-9">
                                        <input type="url" name="twitter" id="twitter" class="form-control"
                                            value="{{ old('twitter', $company->twitter ?? '') }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="instagram" class="form-label col-md-3">Instagram</label>
                                    <div class="col-md-9">
                                        <input type="url" name="instagram" id="instagram" class="form-control"
                                            value="{{ old('instagram', $company->instagram ?? '') }}">
                                    </div>
                                </div>
                                <div class="row form-group mb-3">
                                    <label for="tiktok" class="form-label col-md-3">Tiktok</label>
                                    <div class="col-md-9">
                                        <input type="url" name="tiktok" id="tiktok" class="form-control"
                                            value="{{ old('tiktok', $company->tiktok ?? '') }}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="youtube" class="form-label col-md-3">Youtube</label>
                                    <div class="col-md-9">
                                        <input type="url" name="youtube" id="youtube" class="form-control"
                                            value="{{ old('youtube', $company->youtube ?? '') }}">
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
        function previewLogo() {
            const logo = document.querySelector('#logo');
            const imgPreview = document.querySelector('.logo-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(logo.files[0]);

            oFReader.onLoad = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
            const blob = URL.createObjectURL(logo.files[0]);
            imgPreview.src = blob;
        }
    </script>
@endpush
