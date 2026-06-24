@extends('layout.main_layout')

@section('title', 'Login - PaketKita')

@section('content')
    <!-- Login Page -->
    <div class="row justify-content-center mt-2 mb-5 align-items-center">
        <div class="col-12 col-md-6 col-lg-4">
               <!-- Success Snackbar -->
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
              <div class=" mb-4 text-center">
                <img src="{{asset('icon/logo2.1.png')}}" style="width: 240px;" class="mx-auto" alt="Logo PaketKita">
                </div>
            <div class="card shadow-lg border-0 rounded-3 p-4">
                <!-- Title -->
                <h2 class="text-center mb-4">Login</h2>
                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <!-- Input Username atau Email -->
                    <div class="mb-3">
                        <label for="usernameOrEmail" class="form-label fw-bold">Username atau Email</label>
                        <input 
                            type="email" 
                            class="form-control @error('username') is-invalid @enderror @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            required 
                            placeholder="Masukkan email" 
                            value="{{ old('username') ?? old('email') }}"
                        >
                    </div>
                
                    <!-- Input Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            required 
                            placeholder="Masukkan password"
                        >
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('user.password') }}" class="custom-link">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn btn-custom w-100 mb-3">Login</button>

                    <div class="text-center">
                        <span class="text-muted">User Baru?</span>
                        <a href="{{ route('register') }}" class="custom-link ms-1">Register</a>
                    </div>
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
