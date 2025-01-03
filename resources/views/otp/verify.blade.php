@extends('layouts.app')
@section('content')

<div class="container text-center mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card borderless shadow" style="border-radius: 15px;">
                <div class="card-body">
                    <form action="/confirm-otp" method="POST">
                        @csrf
                        <input type="text" name="number_phone" value="{{session('number_phone')}}" hidden>
                        <p>Verifikasi OTP</p>
                        <p id="countdown" class="text-secondary">02:00</p>
                        <div class="row">
                            <div class="col">
                                <input type="number" name="otp" class="form-control" placeholder="Masukkan OTP"
                                    aria-label="OTP" aria-describedby="basic-addon1" inputmode="numeric">
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-outline-primary"
                                    style="border-radius: 10px">Verifikasi</button>
                            </div>
                        </div>
                    </form>
                    <form action="/resend-otp" method="POST">
                        @csrf
                        {{-- @dd($number_phone) --}}
                        <input type="text" name="number_phone" value="{{session('number_phone')}}" hidden>
                        <button type="submit" id="resend-btn" class="btn btn-link mt-3"
                            style="display: none; text-decoration: none;">Kirim Ulang OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="resendOtpModal" tabindex="-1" aria-labelledby="resendOtpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resendOtpModalLabel">OTP Dikirim Ulang</h5>
            </div>
            <div class="modal-body">
                OTP telah dikirim ulang ke nomor Anda.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    let timeLeft = 120;
    const countdownElement = document.getElementById("countdown");
    const resendButton = document.getElementById("resend-btn");

    function startCountdown() {
        const countdownInterval = setInterval(function() {
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                countdownElement.textContent = "00:00";
                resendButton.style.display = "block";
            } else {
                const minutes = Math.floor(timeLeft / 60).toString().padStart(2, '0');
                const seconds = (timeLeft % 60).toString().padStart(2, '0');
                countdownElement.textContent = `${minutes}:${seconds}`;
                timeLeft--;
            }
        }, 1000);
    }

    function resendOtp() {
        timeLeft = 60; 
        resendButton.style.display = "none";
        countdownElement.textContent = "01:00";
        startCountdown();

        // Show Bootstrap modal instead of alert
        const resendOtpModal = new bootstrap.Modal(document.getElementById('resendOtpModal'));
        resendOtpModal.show();
    }

    // Start countdown on page load
    document.addEventListener("DOMContentLoaded", function() {
        startCountdown();
    });
</script>
@endsection