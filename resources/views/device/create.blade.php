@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-4 d-flex justify-content-between align-items-center">
            <h2>Tambah Data Device</h2>
        </div>

        @if ($errors->any())
            <div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal</strong> menambahkan data!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <div>
            <form action="/devices/store" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <label for="serial_number" class="form-label">Serial Number</label>
                        <input id="serial_number" type="text" class="form-control @error('serial_number') is-invalid @enderror" name="serial_number" value="{{ old('serial_number') }}">
                        @error('serial_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <label for="meta_data" class="form-label">Meta Data</label>
                        <input type="text" name="meta_data" id="meta_data" class="form-control @error('meta_data') is-invalid @enderror" value="{{ old('meta_data') }}">
                        @error('meta_data')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mt-3 d-flex justify-content-end">
                            <a href="/devices" class="btn btn-secondary me-2">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
