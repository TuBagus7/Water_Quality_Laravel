@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-4 d-flex justify-content-between align-items-center">
            <h2>Data Device</h2>
            <a href="/devices/create" class="btn btn-primary">Tambah</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Serial Number</th>
                        <th>Meta Data</th>
                        <th style="text-align: center;">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $device)
                        <tr>
                            <td>{{ ($devices->currentPage() - 1) * $devices->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $device->serial_number }}</td>
                            <td>{{ $device->meta_data }}</td>
                            <td>
                                <div class="d-flex g-2 justify-content-center align-items-center">
                                    <a href="/devices/edit/{{ $device->id }}" class="btn btn-sm btn-warning">
                                        Ubah
                                    </a>
                                    {{-- <form action="/devices/delete/{{ $device->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ms-2 btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form> --}}
                                    <button type="button" class="btn btn-sm btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $device->id }}">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('device.components.modal-delete')
                    @endforeach
                </tbody>
            </table>
            <div class="my-4">
                {{ $devices->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
