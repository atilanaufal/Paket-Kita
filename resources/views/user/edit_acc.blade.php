@extends('layout.main_layout')

@section('title', 'Edit Akun - PaketKita')

@section('content')
    <div class="row justify-content-center mt-4 mb-5 align-items-center">
        <div class="col-12 col-md-6 col-lg-4">
            @if (session('success'))
                <div class="container mt-3">
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="container mt-3">
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <!-- Logo -->
            <div class="mb-4 text-center">
                <img src="{{ asset('icon/logo2.1.png') }}" style="width: 240px;" alt="Logo PaketKita">
            </div>
            <div class="card shadow-lg border-0 rounded-3 p-4">
                <!-- Title -->
                <h2 class="text-center mb-4">Edit Akun</h2>
                <!-- Register Form -->
                <form action="{{ route('user.edit', Auth::id()) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control" id="username" name="username"  placeholder="Masukkan username">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password"  placeholder="Masukkan password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  placeholder="Konfirmasi password">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email"  placeholder="Masukkan email">
                    </div>

                    <button type="submit" class="btn btn-custom w-100 my-3">Konfirmasi</button>

                </form>
            </div>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => {
                alert.remove(); // Menghapus elemen dari DOM
            }, 150); // Waktu tambahan untuk menyelesaikan animasi fade
        }, 3000); // Alert hilang otomatis setelah 3 detik
    }
});
</script>
@endsection
