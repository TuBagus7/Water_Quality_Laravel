@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-4 d-flex justify-content-between align-items-center">
            <h2>Tambah Data Sensor</h2>
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
            <form action="/sensors/store" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <label for="nama_sensor" class="form-label">Nama Sensor</label>
                        <input id="nama_sensor" type="text" class="form-control @error('nama_sensor') is-invalid @enderror" name="nama_sensor" value="{{ old('nama_sensor') }}">
                        @error('nama_sensor')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <label for="data" class="form-label">Data</label>
                        <input type="text" name="data" id="data" class="form-control @error('data') is-invalid @enderror" value="{{ old('data') }}">
                        @error('data')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <label for="topic" class="form-label">Topic</label>
                        <input type="text" name="topic" id="topic" class="form-control @error('topic') is-invalid @enderror" value="{{ old('topic') }}">
                        @error('topic')
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
