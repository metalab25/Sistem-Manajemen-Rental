@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('rentals.update', $rental->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header py-3">
                                <h3 class="font-outfit mb-0">Foto Dokumentasi Sewa</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <input type="hidden" name="oldImage" value="{{ $rental->image }}">
                                    @if ($rental->image)
                                        <img src="{{ asset('storage/' . $rental->image) }}"
                                            class="image-preview img-fluid rounded-3 d-block mx-auto mb-3">
                                    @else
                                        <img src="{{ asset('/assets/img/no-picture.webp') }}"
                                            class="image-preview img-fluid rounded-3 d-block mx-auto mb-3">
                                    @endif
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
                                <h3 class="font-outfit mb-0">Informasi Penyewaan</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="inv_number" class="form-label">Nomor Invoice</label>
                                            <input type="text" name="inv_number" id="inv_number" class="form-control"
                                                value="{{ old('inv_number ', $rental->inv_number) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="type" class="form-label">Jenis Sewa</label>
                                            <select name="type" id="type"
                                                class="form-control form-select @error('type') is-invalid @enderror">
                                                <option value="">-- Pilih Jenis Sewa --</option>
                                                @foreach ($typeOptions as $type)
                                                    <option value="{{ $type }}"
                                                        {{ old('type', $rental->type) == $type ? 'selected' : '' }}>
                                                        {{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">
                                                    {{ 'Jenis sewa harus dipilih' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="customer_id" class="form-label">Penyewa</label>
                                            <select
                                                class="form-control form-select @error('customer_id') is-invalid @enderror"
                                                id="customer_id" name="customer_id">
                                                <option value="">-- Pilih Penyewa --</option>
                                                @foreach ($customers as $item)
                                                    @if (old('customer_id', $rental->customer_id) == $item->id)
                                                        <option value="{{ $item->id }}" selected>
                                                            {{ $item->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}"> {{ $item->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                                <div class="invalid-feedback">
                                                    {{ 'Penyewa harus dipilih' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="car_id" class="form-label">Mobil</label>
                                            <select class="form-control form-select @error('car_id') is-invalid @enderror"
                                                id="car_id" name="car_id">
                                                <option value="">-- Pilih Mobil --</option>
                                                @foreach ($cars as $item)
                                                    @if (old('car_id', $rental->car_id) == $item->id)
                                                        <option value="{{ $item->id }}" selected>
                                                            {{ $item->merk->name . ' ' . $item->name . ' - ' . $item->nopol }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->merk->name . ' ' . $item->name . ' - ' . $item->nopol }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('car_id')
                                                <div class="invalid-feedback">
                                                    {{ 'Mobil harus dipilih' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="tgl_start" class="form-label">Tanggal Mulai</label>
                                            <input type="date" name="tgl_start" id="tgl_start"
                                                class="form-control @error('tgl_start') is-invalid @enderror"
                                                value="{{ old('tgl_start', $rental->tgl_start) }}">
                                            @error('tgl_start')
                                                <div class="invalid-feedback">
                                                    {{ 'Tanggal mulai harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="jam_start" class="form-label">Jam Mulai</label>
                                            <input type="time" name="jam_start" id="jam_start"
                                                class="form-control @error('jam_start') is-invalid @enderror"
                                                value="{{ old('jam_start', $rental->jam_start) }}">
                                            @error('jam_start')
                                                <div class="invalid-feedback">
                                                    {{ 'Jam mulai harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="tgl_end" class="form-label">Tanggal Selesai</label>
                                            <input type="date" name="tgl_end" id="tgl_end"
                                                class="form-control @error('tgl_end') is-invalid @enderror"
                                                value="{{ old('tgl_end', $rental->tgl_end) }}">
                                            @error('tgl_start')
                                                <div class="invalid-feedback">
                                                    {{ 'Tanggal selesai harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="jam_end" class="form-label">Jam Selesai</label>
                                            <input type="time" name="jam_end" id="jam_end"
                                                class="form-control @error('jam_end') is-invalid @enderror"
                                                value="{{ old('jam_end', $rental->jam_end) }}">
                                            @error('jam_end')
                                                <div class="invalid-feedback">
                                                    {{ 'Jam selesai harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="durasi" class="form-label">Durasi Sewa</label>
                                            <div class="input-group mb-3">
                                                <input type="number" name="durasi" id="durasi"
                                                    class="form-control @error('durasi') is-invalid @enderror"
                                                    value="{{ old('durasi', $rental->durasi) }}" placeholder="0...">
                                                <div class="input-group-text">
                                                    <span>Hari</span>
                                                </div>
                                            </div>
                                            @error('durasi')
                                                <div class="invalid-feedback">
                                                    {{ 'Durasi sewa harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="tarif" class="form-label">Tarif Sewa</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <span>Rp.</span>
                                                </div>
                                                <input type="number" name="tarif" id="tarif"
                                                    class="form-control @error('tarif') is-invalid @enderror"
                                                    value="{{ old('tarif', $rental->tarif) }}" placeholder="9000000..."
                                                    oninput="hitungTotal()">
                                            </div>
                                            @error('tarif')
                                                <div class="invalid-feedback">
                                                    {{ 'Tarif sewa harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="total" class="form-label">Total Sewa</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <span>Rp.</span>
                                                </div>
                                                <input type="number" name="total" id="total"
                                                    class="form-control @error('total') is-invalid @enderror"
                                                    value="{{ old('total', $rental->total) }}" placeholder="9000000..."
                                                    readonly>
                                            </div>
                                            @error('total')
                                                <div class="invalid-feedback">
                                                    {{ 'Total biaya sewa harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="marketing" class="form-label">Penanggung Jawab</label>
                                            <input type="text" name="marketing" id="marketing"
                                                class="form-control @error('marketing') is-invalid @enderror"
                                                value="{{ old('marketing', $rental->marketing) }}"
                                                placeholder="Nama penanggung jawab...">
                                            @error('marketing')
                                                <div class="invalid-feedback">
                                                    {{ 'Penanggung jawab sewa harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="dp" class="form-label">Pembayaran Awal</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <span>Rp.</span>
                                                </div>
                                                <input type="number" name="dp" id="dp" class="form-control"
                                                    value="{{ old('dp', $rental->dp) }}" placeholder="9000000..."
                                                    oninput="updateBalance()">
                                            </div>
                                            @error('dp')
                                                <div class="invalid-feedback">
                                                    {{ 'Pembayaran awal harus diisi' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="balance" class="form-label">Sisa Pembayaran</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <span>Rp.</span>
                                                </div>
                                                <input type="number" name="balance" id="balance" class="form-control"
                                                    value="{{ old('balance', $rental->balance) }}" readonly>
                                            </div>
                                            @error('balance')
                                                <div class="invalid-feedback">
                                                    {{ 'Sisa pembayaran harus dihitung' }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="note" class="form-label">Catatan/Keterangan</label>
                                    <textarea name="note" id="note" cols="30" rows="5" class="form-control"
                                        placeholder="Tuliskan catatan atau keterangan kondisi sewa">{{ old('note') }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('rentals.index') }}" class="btn btn-danger btn-sm mb-0">Kembali</a>
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

        function hitungTotal() {
            let durasi = parseFloat(document.getElementById('durasi').value) || 0;
            let tarif = parseFloat(document.getElementById('tarif').value) || 0;

            let total = durasi * tarif;

            document.getElementById('total').value = total;
        }

        function updateBalance() {
            const total = parseFloat(document.getElementById('total').value) || 0;
            const dp = parseFloat(document.getElementById('dp').value) || 0;
            const balance = total - dp;
            document.getElementById('balance').value = balance >= 0 ? balance : 0;
        }

        document.getElementById('total').addEventListener('input', updateBalance);
    </script>
@endpush
