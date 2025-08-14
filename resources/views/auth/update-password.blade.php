@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 75vh;">
            <div class="col-md-4">
                <h2 class="mb-3">Ubah Password</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error-password'))
                    <div class="alert alert-danger">
                        {{ session('error-password') }}
                    </div>
                @endif
                <form action="/update-password" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-3">
                        <label for="old_password" class="form-label">Password Lama</label>
                        <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror">
                        @error('old_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror">
                        @error('new_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-block d-block w-100">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
