@extends('layouts.app')
@section('content')
<div class="row">

    <div class="col-3">
        <div class="card card-layout borderless shadow" style="border-radius: 15px;">
            <div class="card-header borderless" style="border-radius: 15px 15px 0px 0px;">
                <span class="fs-4 fw-semibold ms-2 mt-2" style="color: #296eff;">Pesan</span>
            </div>

            <div class="container mt-3 scroll-vertical">
                {{-- <span class="fw-semibold ms-2 d-flex align-items-center" style="font-size: 13px;"><i
                        class="fa-solid fa-hand-holding-heart fs-6 me-1"></i> Layanan Pengaduan</span>
                <hr>
                <a href="#" class="text-decoration-none text-dark">
                    <div class="row mb-3">
                        <div class="col-2">
                            <img src="{{asset('/images/psga-logo.jpg')}}" alt="logo" class="border" width="50vh"
                                style="border-radius: 50px;">
                        </div>
                        <div class="col d-flex justify-content-start align-items-center">
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">PSGA Pelaporan</span>
                                <span class="fw-lighe" style="font-size: 10px;">Layanan Pengaduan</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="text-decoration-none text-dark">
                    <div class="row mb-3">
                        <div class="col-2">
                            <img src="{{asset('/images/psga-logo.jpg')}}" alt="logo" class="border" width="50vh"
                                style="border-radius: 50px;">
                        </div>
                        <div class="col d-flex justify-content-start align-items-center">
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">PSGA Pengaduan</span>
                                <span class="fw-lighe" style="font-size: 10px;">Layanan Pengaduan</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="text-decoration-none text-dark">
                    <div class="row mb-3">
                        <div class="col-2">
                            <img src="{{asset('/images/psga-logo.jpg')}}" alt="logo" class="border" width="50vh"
                                style="border-radius: 50px;">
                        </div>
                        <div class="col d-flex justify-content-start align-items-center">
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">PSGA Konsultasi (Non Korban)</span>
                                <span class="fw-lighe" style="font-size: 10px;">Layanan Pengaduan</span>
                            </div>
                        </div>
                    </div>
                </a> --}}

                <span class="fw-semibold ms-2 d-flex align-items-center" style="font-size: 13px;"><i
                        class="fa-solid fa-inbox fs-6 me-1"></i> Layanan Konsultasi PSGA</span>
                <hr>
                <a href="#" class="text-decoration-none text-dark">
                    <div class="row mb-3">
                        <div class="col-2">
                            <img src="{{asset('/images/psga-logo.jpg')}}" alt="logo" class="border" width="50vh"
                                style="border-radius: 50px;">
                        </div>
                        <div class="col d-flex justify-content-start align-items-center">
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">Admin PSGA MALIKI</span>
                                <span class="fw-lighe" style="font-size: 10px;">Layanan PSGA</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="text-decoration-none text-dark">
                    <div class="row mb-3">
                        <div class="col-2">
                            <img src="{{asset('/images/psga-logo.jpg')}}" alt="logo" class="border" width="50vh"
                                style="border-radius: 50px;">
                        </div>
                        <div class="col d-flex justify-content-start align-items-center">
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">Konselor Sebaya</span>
                                <span class="fw-lighe" style="font-size: 10px;">Layanan PSGA</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="text-decoration-none text-dark">
                    <div class="row mb-3">
                        <div class="col-2">
                            <img src="{{asset('/images/psga-logo.jpg')}}" alt="logo" class="border" width="50vh"
                                style="border-radius: 50px;">
                        </div>
                        <div class="col d-flex justify-content-start align-items-center">
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">Psikolog</span>
                                <span class="fw-lighe" style="font-size: 10px;">Layanan PSGA</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="text-decoration-none text-dark">
                    <div class="row mb-3">
                        <div class="col-2">
                            <img src="{{asset('/images/psga-logo.jpg')}}" alt="logo" class="border" width="50vh"
                                style="border-radius: 50px;">
                        </div>
                        <div class="col d-flex justify-content-start align-items-center">
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">Ahli Hukum</span>
                                <span class="fw-lighe" style="font-size: 10px;">Layanan PSGA</span>
                            </div>
                        </div>
                    </div>
                </a>

                <br><br><br><br><br><br><br><br>

            </div>

        </div>
    </div>

    <div class="col">
        <div class="card card-layout borderless shadow" style="border-radius: 15px;">
            <div class="card-header" style="background-color: transparent;">
                <div class="row">
                    <div class="col-1">
                        <img src="{{asset('/images/psga-logo.jpg')}}" alt="logo" class="border" width="60vh"
                            style="border-radius: 50px;">
                    </div>
                    <div class="col d-flex justify-content-start align-items-center" style="margin-left: -10px;">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold fs-5" style="color: #296eff;">PSGA Pelaporan</span>
                            <span class="fw-lighe" style="font-size: 12px;">Layanan Pengaduan</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body scroll-vertical">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-1">
                            <img src="{{asset('/images/psga-logo.jpg')}}" alt="logo" class="border" width="60vh"
                                style="border-radius: 50px;">
                        </div>
                        <div class="col mt-3">
                            <span class="fw-semibold">PSGA Pelaporan</span>
                            <div class="card mt-2">
                                <div class="card-body">
                                    <span>Hai Sobat PSGA, Laporan yang disampaikan oleh korban kekerasan atau
                                        pelecehan seksual secara
                                        langsung kepada pihak yang berwenang. Pelaporan ini merupakan langkah
                                        awal
                                        untuk memulai proses penanganan dan pendampingan kasus.</span>
                                </div>
                            </div>
                            <div class="card mt-2">
                                <div class="card-body">
                                    <span>Hai Sobat, siapa namamu?</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <div class="row text-end">
                        <div class="col-1"></div>
                        <div class="col mt-3">
                            <span class="fw-semibold">Rifky Aryo</span>
                            <div class="card mt-2">
                                <div class="card-body">
                                    <span>Rifky Aryo</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <img src="./foto.jpg" alt="logo" class="border" width="65vh" height="65vh"
                                style="object-fit: cover; border-radius: 50px;">
                        </div>
                    </div>
                </div>

                <br><br><br><br><br><br><br><br><br><br><br><br>

            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col ms-3">
                        <!-- <input type="text" class="form-control"> -->
                        <textarea class="form-control" name="" id=""></textarea>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-primary">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
                <div class="container ms-2">
                    <span style="font-size: 12px;">*Terms and Privacy Policy</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection