@extends('layanan.app')

@section('layanan')
<div class="card shadow-sm" style="border-radius: 20px; border: 2px solid #e2e8f0 !important; border-top: 8px solid #296eff !important;">
    <div class="card-header border-0 bg-transparent pt-4 px-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3 class="fw-bold text-dark mb-1">Pusat Layanan Terpadu</h3>
                <p class="text-muted mb-0" style="font-size: 14px;">UIN Maulana Malik Ibrahim Malang</p>
            </div>
            <div class="p-1 bg-white rounded-circle shadow-sm border border-2">
                <img src="{{ asset('/images/psga-logo.jpg') }}" width="55" class="rounded-circle">
            </div>
        </div>
    </div>

    <div class="card-body px-4 pb-4">
        <div class="text-center my-4 py-4 border-top border-bottom border-2 border-light">
            <h4 class="fst-italic fw-bold text-primary mb-0" style="letter-spacing: 0.5px; text-transform: uppercase; font-size: 1.2rem;">
                “No more silence, stop the violence”
            </h4>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="p-4 bg-light border-start border-primary border-5 h-100 shadow-sm" style="border-radius: 15px;">
                    <h6 class="fw-bold text-primary d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-users fs-5"></i> Opsi Pelaporan
                    </h6>
                    <p class="small text-muted mb-0 lh-lg" style="text-align: justify;">
                        Ditujukan untuk individu <strong>selain korban</strong> (saksi, teman, atau pihak ketiga). Sampaikan apa yang Anda ketahui untuk membantu melindungi sesama di lingkungan kampus.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 bg-light border-start border-danger border-5 h-100 shadow-sm" style="border-radius: 15px;">
                    <h6 class="fw-bold text-danger d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-hand-fist fs-5"></i> Opsi Pengaduan
                    </h6>
                    <p class="small text-muted mb-0 lh-lg" style="text-align: justify;">
                        Disampaikan langsung oleh <strong>korban</strong> kekerasan atau pelecehan. Ini adalah langkah berani untuk mendapatkan perlindungan dan pendampingan profesional dari kami.
                    </p>
                </div>
            </div>
        </div>

        <div class="p-4 text-white shadow-lg" style="background: var(--psga-gradient); border-radius: 20px; border: 2px solid rgba(255,255,255,0.1);">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <h5 class="fw-bold mb-3 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-shield-heart text-warning"></i> Keamanan Anda Prioritas Kami
                    </h5>
                    <p class="mb-0 opacity-90" style="font-size: 15px; line-height: 1.7;">
                        Kami menjamin kerahasiaan identitas Anda sepenuhnya sesuai dengan kode etik layanan pendampingan. Data Anda aman dalam sistem terenkripsi kami.
                    </p>
                </div>
            </div>
            <div class="mt-4 pt-3 border-top border-white border-opacity-25 d-flex align-items-center gap-3">
                <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 35px; height: 35px; min-width: 35px;">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
                <p class="mb-0 fw-medium" style="font-size: 14px;">
                    Silakan pilih kategori di menu samping kiri untuk membuka formulir pengisian.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection