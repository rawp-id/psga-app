@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5 text-center">
                    <div class="bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-shield-check text-primary fs-1"></i>
                    </div>

                    <h4 class="fw-bold">Masukkan Kode OTP</h4>
                    <p class="text-muted small">Kode telah dikirim ke nomor <span class="fw-bold text-dark">+62{{ session('number_phone') }}</span></p>

                    <form action="/confirm-otp" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="number_phone" value="{{ session('number_phone') }}">
                        
                        <div class="mb-4">
                            <input type="number" name="otp" class="form-control form-control-lg text-center fw-bold letter-spacing-lg py-3" 
                                   placeholder="0 0 0 0 0 0" required
                                   style="border-radius: 12px; font-size: 1.5rem; letter-spacing: 0.5rem;">
                        </div>

                        <div id="countdown-container" class="mb-4">
                            <span class="text-muted small">Kirim ulang dalam: </span>
                            <span id="countdown" class="fw-bold text-primary">02:00</span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 mb-3 shadow-sm fw-bold" style="border-radius: 12px;">
                            Verifikasi Sekarang
                        </button>
                    </form>

                    <form action="/resend-otp" method="POST" id="resend-form">
                        @csrf
                        <input type="hidden" name="number_phone" value="{{ session('number_phone') }}">
                        <button type="submit" id="resend-btn" class="btn btn-link text-decoration-none fw-bold small" style="display: none;">
                            <i class="bi bi-arrow-clockwise"></i> Kirim Ulang Kode
                        </button>
                    </form>

                    <div class="mt-4 pt-3 border-top">
                        <a href="/" class="text-decoration-none text-muted small">
                            Nanti saja, masuk ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resendOtpModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow" style="border-radius: 15px;">
            <div class="modal-body text-center p-4">
                <i class="bi bi-check-circle-fill text-success fs-1 mb-2"></i>
                <h6 class="fw-bold">Terkirim!</h6>
                <p class="text-muted small mb-0">Kode OTP baru telah dikirim ulang.</p>
                <button type="button" class="btn btn-light btn-sm mt-3 w-100" data-bs-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>

<style>
    .letter-spacing-lg::placeholder {
        letter-spacing: normal;
        font-size: 1rem;
        font-weight: normal;
    }
</style>

<script>
    let timeLeft = 120;
    const countdownElement = document.getElementById("countdown");
    const resendButton = document.getElementById("resend-btn");

    function startCountdown() {
        const countdownInterval = setInterval(function() {
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                document.getElementById("countdown-container").style.display = "none";
                resendButton.style.display = "inline-block";
            } else {
                const minutes = Math.floor(timeLeft / 60).toString().padStart(2, '0');
                const seconds = (timeLeft % 60).toString().padStart(2, '0');
                countdownElement.textContent = `${minutes}:${seconds}`;
                timeLeft--;
            }
        }, 1000);
    }

    document.addEventListener("DOMContentLoaded", startCountdown);
</script>
@endsection