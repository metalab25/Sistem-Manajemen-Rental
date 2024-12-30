@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary float-end sm-full-fw mb-0" data-bs-toggle="modal"
                                data-bs-target="#modalAddOwner">Tambah Pemilik</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive rounded-3 table-shadow">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" width="3%">No.</th>
                                    <th class="text-center align-middle">Nama Lengkap</th>
                                    <th class="text-center align-middle">Email</th>
                                    <th class="text-center align-middle">Telepon</th>
                                    <th class="text-center align-middle">Kota/Kabupaten</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($owners as $owner)
                                    <tr>
                                        <td class="text-center align-middle">
                                            {{ ($owners->currentPage() - 1) * $owners->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $owner->name }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $owner->email ?? '-' }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $owner->phone }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $owner->city }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $owner->city }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('owners.show', $owner->id) }}"
                                                    class="btn btn-info btn-sm">Detail</a>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditOwner-{{ $owner->id }}">Ubah</button>
                                                @if (Auth::check() && in_array(Auth::user()->role_id, [1, 2]))
                                                    <a href="{{ route('owners.destroy', $owner->id) }}"
                                                        class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @include('dashboard.data.owner.modal-edit')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        {{ $owners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.data.owner.modal-add')
@endsection
