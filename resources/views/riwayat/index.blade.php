@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <div class="card borderless shadow" style="border-radius: 15px;">
            <div class="card-body m-4">
                <h5 class="fw-semibold">Track Riwayat Pengaduan Terakhir</h5>
                <hr>
                <div class="container mt-5">
                    <div class="d-flex justify-content-center">
                        <div class="step-container">
                        </div>
                        <!-- Step 1 -->
                        {{-- <div class="text-center"> --}}
                            <div class="step active">1</div>
                            <div class="step-label">Menunggu Konfirmasi</div>
                        {{-- </div> --}}
                        <div class="line active"></div>

                        <!-- Step 2 -->
                        {{-- <div class="text-center"> --}}
                            <div class="step ">2</div>
                            <div class="step-label">Penyelesaian Masalah</div>
                        {{-- </div> --}}
                        <div class="line"></div>

                        <!-- Step 3 -->
                        {{-- <div class="text-center"> --}}
                            <div class="step">3</div>
                            <div class="step-label">Selesai</div>
                        {{-- </div> --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="card borderless shadow" style="border-radius: 15px;">
            <div class="card-body m-4">
                <h5 class="fw-semibold">Riwayat Pengaduan</h5>
                <hr>
                <table class="table">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><i class="bi bi-ui-checks"></i> Pengaduan</td>
                            <td>12 Desember 2024</td>
                            <td>
                                <span class="badge rounded-pill text-bg-secondary">
                                    <i class="bi bi-info-circle-fill me-1"></i> Menunggu Konfirmasi
                                </span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-outline-primary">Detail</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
