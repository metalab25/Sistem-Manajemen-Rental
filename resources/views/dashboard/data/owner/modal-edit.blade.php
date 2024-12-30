<div class="modal fade" id="modalEditOwner-{{ $owner->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modalEditOwnerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title" id="modalEditOwnerLabel">Tambah Pemilik Kendaraan</h1>
            </div>
            <form action="{{ route('owners.update', $owner->id) }}" method="post">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="row form-group mb-3">
                        <label for="name" class="form-label col-md-3">Nama Lengkap</label>
                        <div class="col-md-9">
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $owner->name) }}"
                                placeholder="Tuliskan nama lengkap pemilik kendaraan...">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <label for="adddress" class="form-label col-md-3">Alamat</label>
                        <div class="col-md-9">
                            <textarea name="address" id="address" cols="30" rows="2"
                                class="form-control @error('address') is-invalid @enderror" placeholder="Tuliskan alamat...">{{ old('address', $owner->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <label for="city" class="form-label col-md-3">Kota/Kabupaten</label>
                        <div class="col-md-9">
                            <input type="text" name="city" id="city"
                                class="form-control @error('city') is-invalid @enderror"
                                value="{{ old('city', $owner->city) }}" placeholder="Tuliskan kota alamat...">
                            @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <label for="province_id" class="form-label col-md-3">Provinsi</label>
                        <div class="col-md-9">
                            <select class="form-control form-select @error('province_id') is-invalid @enderror"
                                id="province_id" name="province_id">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach ($province as $item)
                                    @if (old('province_id', $owner->province_id) == $item->id)
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
                                value="{{ old('email', $owner->email) }}" placeholder="Tuliskan email...">
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <label for="phone" class="form-label col-md-3">Telepon</label>
                        <div class="col-md-9">
                            <input type="number" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $owner->phone) }}" placeholder="Tuliskan nomor telepon...">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <label for="status" class="form-label col-md-3">Status</label>
                        <div class="col-md-9">
                            <select name="status" id="status"
                                class="form-control form-select @error('status') is-invalid @enderror">
                                <option value="">-- Pilih Status --</option>
                                <option value="Investor" {{ $owner->status == 'Investor' ? 'selected' : '' }}>Investor
                                </option>
                                <option value="Mitra" {{ $owner->status == 'Mitra' ? 'selected' : '' }}>Mitra
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ 'Status pemilik harus dipilih' }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="garage" class="form-label col-md-3">Perusahaan</label>
                        <div class="col-md-9">
                            <input type="text" name="garage" id="garage" class="form-control"
                                value="{{ old('garage', $owner->garage) }}" placeholder="Tuliskan nama perusahaan...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
