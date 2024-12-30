@extends('dashboard.layouts.master')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <a href="{{ route('customers.create') }}" class="btn btn-primary float-end sm-full-fw mb-0">Tambah
                                Penyewa</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" width="3%">No.</th>
                                    <th class="text-center align-middle">Nama Lengkap</th>
                                    <th class="text-center align-middle">Nomor Identitas</th>
                                    <th class="text-center align-middle">Email</th>
                                    <th class="text-center align-middle">Telepon</th>
                                    <th class="text-center align-middle">Kota/Kabupaten</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td class="text-center align-middle">
                                            {{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $customer->name }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $customer->id_number }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $customer->email ?? '-' }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $customer->phone }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $customer->city }}
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($customer->status == 0)
                                                -
                                            @else
                                                {{ $customer->status }}
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('customers.show', $customer->id) }}"
                                                    class="btn btn-info btn-sm">Detail</a>
                                                <a href="{{ route('customers.edit', $customer->id) }}"
                                                    class="btn btn-warning btn-sm">Ubah</a>
                                                @if (Auth::check() && in_array(Auth::user()->role_id, [1, 2]))
                                                    <a href="{{ route('customers.destroy', $customer->id) }}"
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
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
