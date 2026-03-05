@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="card-body p-5 text-center">
                    
                    <div class="mb-4">
                        <div class="bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-shield-lock-fill text-primary fs-1"></i>
                        </div>
                        <h3 class="fw-bold">Selamat Datang</h3>
                        <p class="text-muted">Gunakan akun Google Kampus Anda untuk mengakses layanan pengaduan.</p>
                    </div>

                    <hr class="my-4 text-secondary opacity-25">

                    <a href="{{ url('/auth/google') }}" class="btn btn-white border shadow-sm w-100 py-3 d-flex align-items-center justify-content-center hover-lift" style="border-radius: 12px; transition: all 0.3s ease;">
                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo" class="me-3" style="width: 20px;">
                        <span class="fw-semibold text-dark">Masuk dengan Google</span>
                    </a>

                    <div class="mt-5">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i> 
                            Pastikan Anda menggunakan email akhiran <strong>@uin-malang.ac.id</strong>
                        </small>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="/" class="text-decoration-none text-muted small hover-primary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        background-color: #fcfcfc;
    }
    .hover-primary:hover {
        color: var(--bs-primary) !important;
    }
</style>
@endsection