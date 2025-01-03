@extends('layanan.app')
@section('layanan')

<div class="card card-layout borderless shadow" style="border-radius: 15px;">
    <div class="card-header" style="background-color: transparent;">
        <div class="row">
            <div class="col d-flex justify-content-start align-items-center ms-2" style="margin-left: -10px;">
                <div class="d-flex flex-column">
                    <span class="fw-semibold fs-5">Formulir Pengaduan</span>
                    <span class="fw-lighe" style="font-size: 12px;">Layanan Pengaduan</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body scroll-vertical">
        <div class="container">
            <form action="#" method="post">
                <h5 class="mb-4 text-center">Identitas Pelaku (Jika Diketahui)</h5>
                <div class="mb-3">
                    <label for="perpetrator_name" class="form-label">Nama Pelaku (jika diketahui) <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="perpetrator_name" name="perpetrator_name" required>
                </div>
                <div class="mb-3">
                    <label for="perpetrator_position" class="form-label">Jabatan posisi pelaku di kampus/non
                        kampus (jika diketahui) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="perpetrator_position" name="perpetrator_position"
                        required>
                </div>
                <div class="mb-3">
                    <label for="incident_location" class="form-label">Lokasi atau tempat kejadian kekerasan
                        <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="incident_location" name="incident_location" required>
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

@endsection