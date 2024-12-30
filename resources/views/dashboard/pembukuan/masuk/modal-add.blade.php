<div class="modal fade" id="modalAddCashIn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalAddCashInLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title" id="modalAddCashInLabel">Tambah Transaksi Kas Masuk</h1>
            </div>
            <form action="{{ route('cashins.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row form-group mb-3">
                        <label for="item" class="form-label col-md-4">Item Transaksi Masuk</label>
                        <div class="col-md-8">
                            <textarea name="item" id="item" cols="30" rows="3"
                                class="form-control @error('item') is-invalid @enderror" placeholder="Tuliskan item transaksi masuk...">{{ old('item') }}</textarea>
                            @error('item')
                                <div class="invalid-feedback">
                                    {{ 'Item transaksi masuk harus diisi' }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <label for="type" class="form-label col-md-4">Tipe Transaksi</label>
                        <div class="col-md-8">
                            <select name="type" id="type"
                                class="form-control form-select @error('type') is-invalid @enderror">
                                <option value="">-- Tipe Transaksi --</option>
                                <option value="Klaim BBM">Klaim BBM</option>
                                <option value="Klaim Kerusakan">Klaim Kerusakan</option>
                                <option value="Komisi">Komisi</option>
                                <option value="Penyewaan">Penyewaan</option>
                                <option value="Ongkir">Ongkir</option>
                                <option value="Uang Cuci">Uang Cuci</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">
                                    {{ 'Tipe transaksi harus dipilih' }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <label for="transaction_at" class="form-label col-md-4">Tanggal Transaksi</label>
                        <div class="col-md-8">
                            <input type="date" name="transaction_at" id="transaction_at"
                                class="form-control @error('transaction_at') is-invalid @enderror"
                                value="{{ old('transaction_at') }}" placeholder="Tuliskan kota alamat...">
                            @error('transaction_at')
                                <div class="invalid-feedback">
                                    {{ 'Tanggal transaksi masuk harus diisi' }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="total" class="form-label col-md-4">Nilai Transaksi</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span>Rp.</span>
                                </div>
                                <input type="number" name="total" id="total"
                                    class="form-control @error('total') is-invalid @enderror"
                                    value="{{ old('total') }}" placeholder="9000000...">
                            </div>
                            @error('total')
                                <div class="invalid-feedback">
                                    {{ 'Nilai transaksi masuk harus diisi' }}
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
