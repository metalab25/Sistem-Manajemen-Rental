<div class="modal fade" id="modalUbahStatus-{{ $car->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modalUbahStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title" id="modalUbahStatusLabel">Ubah Status Transaksi Sewa</h1>
            </div>
            <form action="{{ route('cars.updateStatus', $car->id) }}" method="post">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="row form-group mb-3">
                        <label for="name" class="form-label col-md-3">Mobil</label>
                        <div class="col-md-9">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $car->merk->name . ' ' . $car->name . ' - ' . $car->nopol }}" readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="status" class="form-label col-md-3">Status</label>
                        <div class="col-md-9">
                            <select name="status" id="status"
                                class="form-control form-select @error('status') is-invalid @enderror">
                                <option value="">-- Pilih Status --</option>
                                <option value="Tersedia" {{ $car->status == 'Tersedia' ? 'selected' : '' }}>
                                    Tersedia
                                </option>
                                <option value="Tidak Tersedia" {{ $car->status == 'Tidak Tersedia' ? 'selected' : '' }}>
                                    Tidak Tersedia
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ 'Status mobil harus dipilih' }}
                                </div>
                            @enderror
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
