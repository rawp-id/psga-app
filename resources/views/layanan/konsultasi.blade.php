@extends('layouts.app')
@section('content')
<div class="row">

    <div class="col-3">
        <div class="card card-layout borderless shadow" style="border-radius: 15px;">
            {{-- <div class="card-header borderless" style="border-radius: 15px 15px 0px 0px;">
                <span class="fs-4 fw-semibold ms-2 mt-2" style="color: #296eff;">Pesan</span>
            </div> --}}

            <div class="container mt-3 scroll-vertical">
                <span class="fw-semibold ms-2 d-flex align-items-center" style="font-size: 13px;"><i
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
                                <span class="fw-semibold">Pelaporan</span>
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
                                <span class="fw-semibold">Pengaduan</span>
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
                                <span class="fw-semibold">Konsultasi (Non Korban)</span>
                                <span class="fw-lighe" style="font-size: 10px;">Layanan Pengaduan</span>
                            </div>
                        </div>
                    </div>
                </a>

                <br><br><br><br>

            </div>

        </div>
    </div>

    <div class="col">
        <div class="card card-layout borderless shadow" style="border-radius: 15px;">
            <div class="card-header" style="background-color: transparent;">
                <div class="row">
                    {{-- <div class="col-1">
                        <img src="{{asset('/images/psga-logo.jpg')}}" alt="logo" class="border" width="60vh"
                            style="border-radius: 50px;">
                    </div> --}}
                    <div class="col d-flex justify-content-start align-items-center ms-2" style="margin-left: -10px;">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold fs-5">Formulir Pelaporan</span>
                            <span class="fw-lighe" style="font-size: 12px;">Layanan Pengaduan</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body scroll-vertical">
                <div class="container">
                    {{-- <h2 class="mb-4">Formulir Pelaporan</h2> --}}
                    <form action="#" method="post">
                        <h5 class="mb-4 mt-5 text-center">Identitas Pelaku (Jika Diketahui)</h5>
                        <div class="mb-3">
                            <label for="perpetrator_name" class="form-label">Nama Pelaku (jika diketahui) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="perpetrator_name" name="perpetrator_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="perpetrator_position" class="form-label">Jabatan posisi pelaku di kampus/non
                                kampus (jika diketahui) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="perpetrator_position"
                                name="perpetrator_position" required>
                        </div>
                        <div class="mb-3">
                            <label for="incident_location" class="form-label">Lokasi atau tempat kejadian kekerasan
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="incident_location" name="incident_location"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="incident_description" class="form-label">Deskripsikan secara singkat kronologi
                                kejadian <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="incident_description" name="incident_description"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-primary w-100 mt-3 mb-5">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection