@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5 text-center">
                    <div class="bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-whatsapp text-success fs-1"></i>
                    </div>

                    <h4 class="fw-bold">Verifikasi WhatsApp</h4>
                    <p class="text-muted small">Masukkan nomor WhatsApp Anda untuk menerima kode OTP dan notifikasi laporan.</p>

                    <form action="/send-otp" method="POST" class="mt-4 text-start">
                        @csrf
                        <label class="form-label small fw-bold text-secondary">Nomor Telepon</label>
                        <div class="input-group mb-4 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                            <span class="input-group-text bg-light border-end-0 px-3">+62</span>
                            <input type="number" name="number_phone" class="form-control border-start-0 py-3" 
                                   placeholder="812xxxx" required
                                   style="box-shadow: none;">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-arrow-right-short fs-4"></i>
                            </button>
                        </div>
                    </form>

                    <div class="mt-4 pt-3 border-top">
                        <p class="text-muted small mb-2">Ingin mengisi nanti?</p>
                        <a href="/" class="text-decoration-none fw-semibold small text-primary hover-underline">
                            Lewati Langkah Ini <i class="bi bi-chevron-right small"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const phoneInput = document.querySelector("input[name='number_phone']");
        phoneInput.addEventListener("input", function() {
            this.value = this.value.replace(/^0+/, '').replace(/[^0-9]/g, '');
        });
    });
</script>
@endsection