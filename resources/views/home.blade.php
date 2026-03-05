@extends('layouts.app')

@section('content')
<div class="p-2">
    <div class="row align-items-center mb-5 g-4">
        <div class="col-md-7">
            <h1 class="display-6 fw-bold text-dark mb-3">Selamat Datang di <span class="text-primary">PSGA Maliki</span></h1>
            <p class="text-muted fs-5">Layanan pengaduan dan pendampingan untuk mewujudkan lingkungan kampus yang aman, inklusif, dan bebas dari kekerasan.</p>
            <div class="d-flex flex-wrap gap-3 mt-4">
                <a href="{{ route('layanan.index') }}" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 12px; background: var(--psga-gradient); border:none;">
                    <i class="fa-solid fa-pen-to-square me-2"></i> Buat Pengaduan
                </a>
                <a href="/riwayat" class="btn btn-outline-primary px-4 py-2" style="border-radius: 12px;">
                    <i class="fa-solid fa-clock-rotate-left me-2"></i> Cek Status
                </a>
            </div>
        </div>
        <div class="col-md-5 d-none d-md-block text-center">
            <img src="{{ asset('support.png') }}" alt="Support" class="img-fluid" style="max-height: 250px;">
        </div>
    </div>

    <hr class="my-5 opacity-25">

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card h-100 border-0 bg-light p-3" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="icon-circle bg-primary text-white mb-3 shadow-sm">
                        <i class="fa-solid fa-shield-halved fs-4"></i>
                    </div>
                    <h5 class="fw-bold">Privasi Terjamin</h5>
                    <p class="small text-muted mb-0">Identitas pelapor akan dijaga kerahasiaannya sesuai prosedur perlindungan saksi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 bg-light p-3" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="icon-circle bg-info text-white mb-3 shadow-sm">
                        <i class="fa-solid fa-user-doctor fs-4"></i>
                    </div>
                    <h5 class="fw-bold">Pendampingan Ahli</h5>
                    <p class="small text-muted mb-0">Dapatkan bantuan dari tim konselor dan psikolog profesional yang siap membantu Anda.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 bg-light p-3" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="icon-circle bg-warning text-white mb-3 shadow-sm">
                        <i class="fa-solid fa-bolt fs-4"></i>
                    </div>
                    <h5 class="fw-bold">Respon Cepat</h5>
                    <p class="small text-muted mb-0">Laporan Anda akan segera diproses oleh admin dalam waktu maksimal 1x24 jam kerja.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-primary bg-opacity-10 p-4 p-md-5" style="border-radius: 30px;">
        <h4 class="fw-bold mb-5 text-center">Alur Pengaduan Aman</h4>
        <div class="row g-4">
            <div class="col-6 col-md-3 text-center">
                <div class="step-num shadow-sm mx-auto mb-3">1</div>
                <h6 class="fw-bold">Isi Form</h6>
                <p class="small text-muted d-none d-md-block">Lengkapi data & bukti</p>
            </div>
            <div class="col-6 col-md-3 text-center">
                <div class="step-num shadow-sm mx-auto mb-3">2</div>
                <h6 class="fw-bold">Verifikasi</h6>
                <p class="small text-muted d-none d-md-block">Admin mengecek data</p>
            </div>
            <div class="col-6 col-md-3 text-center">
                <div class="step-num shadow-sm mx-auto mb-3">3</div>
                <h6 class="fw-bold">Tindak Lanjut</h6>
                <p class="small text-muted d-none d-md-block">Konsultasi ahli</p>
            </div>
            <div class="col-6 col-md-3 text-center">
                <div class="step-num shadow-sm mx-auto mb-3">4</div>
                <h6 class="fw-bold">Selesai</h6>
                <p class="small text-muted d-none d-md-block">Kasus teratasi</p>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .step-num {
        width: 45px;
        height: 45px;
        background: var(--psga-gradient);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
</style>
@endsection