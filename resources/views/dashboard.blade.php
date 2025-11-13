@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-4 d-flex justify-content-between align-items-center">
            <h2>Dashboard</h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div>
            @auth
            <p>Selamat datang <span class="fw-bold">{{ auth()->user()->name }}</span> di dashboard IoT</p>
            @endauth
            @guest
            <p>Selamat datang di dashboard IoT</p>
            @endguest

            <a href="/update-password" class="btn btn-secondary">
                Ubah Password
            </a>
        </div>
    </div>
@endsection
