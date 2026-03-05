@extends('layouts.app')

@section('content')
<div class="row g-4 h-100">
    <div class="col-12 col-md-4 col-lg-3">
        <div class="card border-0 shadow-sm sticky-sidebar" style="border-radius: 20px; border: 2px solid #e2e8f0 !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center mb-4 px-2 pt-2">
                    <div class="text-primary bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 45px; height: 45px; border: 2px solid rgba(41, 110, 255, 0.2);">
                        <i class="fa-solid fa-hand-holding-heart fs-5"></i>
                    </div>
                    <span class="fw-bold text-dark fs-5">Layanan PSGA</span>
                </div>
                
                <div class="nav flex-column nav-pills gap-3">
                    <a href="/layanan/pelaporan" 
                       class="nav-link border-2 d-flex align-items-center p-3 {{ Request::is('layanan/pelaporan') ? 'active-layanan' : 'text-dark bg-light border-light' }}" 
                       style="border-radius: 16px; transition: all 0.3s ease; border: 0.1px solid gray !important;">
                        <i class="fa-solid fa-bullhorn fs-4 me-3"></i>
                        <div class="d-flex flex-column text-start">
                            <span class="fw-bold mb-0" style="font-size: 14px;">Pelaporan</span>
                            <small class="opacity-75" style="font-size: 10px;">Oleh Saksi / Teman</small>
                        </div>
                    </a>

                    <a href="/layanan/pengaduan" 
                       class="nav-link border-2 d-flex align-items-center p-3 {{ Request::is('layanan/pengaduan') ? 'active-layanan' : 'text-dark bg-light border-light' }}" 
                       style="border-radius: 16px; transition: all 0.3s ease; border: 0.1px solid gray !important;">
                        <i class="fa-solid fa-user-shield fs-4 me-3"></i>
                        <div class="d-flex flex-column text-start">
                            <span class="fw-bold mb-0" style="font-size: 14px;">Pengaduan</span>
                            <small class="opacity-75" style="font-size: 10px;">Langsung oleh Korban</small>
                        </div>
                    </a>
                </div>

                <div class="mt-4 px-1">
                    <div class="p-3 bg-light rounded-4 border border-2" style="border-style: dashed !important; border-color: #cbd5e1 !important;">
                        <small class="text-muted fw-medium" style="font-size: 11px; line-height: 1.5;">
                            <i class="fa-solid fa-circle-info me-1 text-primary"></i> 
                            Pilih kategori yang sesuai untuk mendapatkan penanganan yang tepat.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8 col-lg-9">
        <div class="content-scroll-area">
            @yield('layanan')
        </div>
    </div>
</div>

<style>
    /* Sticky Sidebar Logic */
    @media (min-width: 992px) {
        .sticky-sidebar {
            position: sticky;
            top: 20px;
            z-index: 10;
        }
        
        /* Memastikan area konten punya scroll sendiri jika melebihi tinggi layar */
        .content-scroll-area {
            height: auto;
        }
    }

    .active-layanan {
        background: var(--psga-gradient) !important;
        color: white !important;
        box-shadow: 0 10px 20px rgba(41, 110, 255, 0.25);
        transform: scale(1.02);
    }
    
    /* Menebalkan border navigasi saat tidak aktif */
    .nav-link.border-light {
        border: 2px solid #f1f5f9 !important;
    }

    .nav-link:hover:not(.active-layanan) {
        border-color: var(--psga-blue) !important;
        background: #fff !important;
        color: var(--psga-blue) !important;
    }
</style>
@endsection