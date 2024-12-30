@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="float-end">
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mb-0">Tambah Pengguna</a>
                            </div>
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
                                    <th class="text-center align-middle">Username</th>
                                    <th class="text-center align-middle">Email</th>
                                    <th class="text-center align-middle">Telepon</th>
                                    <th class="text-center align-middle">Grup</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">
                                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->username }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td class="text-center">
                                            {{ $user->phone }}
                                        </td>
                                        <td>
                                            {{ $user->role->name }}
                                        </td>
                                        <td class="text-center">
                                            @if ($user->status == 1)
                                                <i class="fas fa-circle-check text-success"></i>
                                            @else
                                                <i class="fas fa-circle-xmark text-danger"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-warning btn-sm">Ubah</a>
                                                @if ($user->id == 1)
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        disabled>Hapus</button>
                                                @else
                                                    <a href="{{ route('users.destroy', $user->id) }}"
                                                        class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-3">
                    <div class="float-end">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
