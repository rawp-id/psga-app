@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-3">
        <div class="card card-layout borderless shadow" style="border-radius: 15px;">
            <div class="container mt-3 scroll-vertical">
                <span class="fw-semibold ms-2 d-flex align-items-center" style="font-size: 13px;"><i
                        class="fa-solid fa-hand-holding-heart fs-6 me-1"></i> Layanan Pengaduan</span>
                <hr>
                <div class="mb-3">
                    <a href="/layanan/pelaporan" class="text-decoration-none text-dark">
                        <div class="d-flex justify-content-start align-items-center ms-2">
                            <i class="fa-solid fa-receipt me-3 fs-2"></i>
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">Pelaporan</span>
                                <span class="fw-lighe" style="font-size: 10px;">Layanan Pengaduan</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="mb-3">
                    <a href="/layanan/pengaduan" class="text-decoration-none text-dark">
                        <div class="d-flex justify-content-start align-items-center ms-2">
                            <i class="fa-solid fa-receipt me-3 fs-2"></i>
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">Pengaduan</span>
                                <span class="fw-lighe" style="font-size: 10px;">Layanan Pengaduan</span>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- <a href="/layanan/pengaduan" class="text-decoration-none text-dark">
                    <div class="row mb-3">
                        <div class="col-2">
                            <img src="{{asset('/images/psga-logo.jpg')}}" alt="logo" class="border" width="50vh"
                                style="border-radius: 50px;">
                        </div>
                        <div class="col d-flex justify-content-start align-items-center">
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">Pengaduan</span>
                                <span class="fw-lighe" style="font-size: 10px;">Layanan Pengaduan</span>
                            </div>
                        </div>
                    </div>
                </a> --}}
                <br><br><br><br>
            </div>
        </div>
    </div>

    <div class="col">
        @yield('layanan')
        {{-- <div class="card card-layout borderless shadow" style="border-radius: 15px;">
            <div class="card-header" style="background-color: transparent;">
                <div class="row">
                    <div class="col d-flex justify-content-start align-items-center ms-2" style="margin-left: -10px;">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold fs-5">PSGA </span>
                            <span class="fw-lighe" style="font-size: 12px;">Layanan Pengaduan</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body scroll-vertical">
                <div class="container">
                    @yield('layanan')
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection