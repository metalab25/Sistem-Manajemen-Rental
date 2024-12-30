<div class="modal fade" id="modalEditStatus-{{ $rental->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modalEditStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title" id="modalEditStatusLabel">Ubah Status Transaksi Sewa</h1>
            </div>
            <form action="{{ route('rentals.done', $rental->id) }}" method="post">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="row form-group mb-3">
                        <label for="inv_number" class="form-label col-md-3">Nomor Invoice</label>
                        <div class="col-md-9">
                            <input type="text" name="inv_number" id="inv_number" class="form-control"
                                value="{{ old('inv_number', $rental->inv_number) }}" readonly>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <label for="status" class="form-label col-md-3">Status</label>
                        <div class="col-md-9">
                            <select name="status" id="status"
                                class="form-control form-select @error('status') is-invalid @enderror">
                                <option value="">-- Pilih Status --</option>
                                <option value="0" {{ $rental->status == '0' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                                <option value="1" {{ $rental->status == '1' ? 'selected' : '' }}>
                                    On Rent
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
                        <label for="pay_status" class="form-label col-md-3">Pembayaran</label>
                        <div class="col-md-9">
                            <select name="pay_status" id="pay_status"
                                class="form-control form-select @error('pay_status') is-invalid @enderror">
                                <option value="">-- Pilih Status Pembayaran --</option>
                                <option value="Lunas" {{ $rental->pay_status == 'Lunas' ? 'selected' : '' }}>
                                    Lunas
                                </option>
                                <option value="Belum Lunas"
                                    {{ $rental->pay_status == 'Belum Lunas' ? 'selected' : '' }}>
                                    Belum Lunas
                                </option>
                            </select>
                            @error('pay_status')
                                <div class="invalid-feedback">
                                    {{ 'Status pembayaran harus dipilih' }}
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
