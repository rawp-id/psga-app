@extends('layouts.app')
@section('content')
    {{-- <div class="container mt-3">
        <div class="card borderless shadow" style="border-radius: 15px;">
            <div class="card-body m-4">
                <h5 class="fw-semibold">Track Riwayat Pengaduan Terakhir</h5>
                <hr>
                <div class="container mt-5">
                    <div class="d-flex justify-content-center">
                        <div class="step-container"></div>
                        <div class="step active">1</div>
                        <div class="step-label">Menunggu Konfirmasi</div>
                        <div class="line active"></div>
                        <div class="step ">2</div>
                        <div class="step-label">Penyelesaian Masalah</div>
                        <div class="line"></div>
                        <div class="step">3</div>
                        <div class="step-label">Selesai</div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container mt-5">
        <div class="card borderless shadow" style="border-radius: 15px;">
            <div class="card-body m-4">
                <h5 class="fw-semibold">Riwayat</h5>
                <hr>
                <div class="table-responsive">
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
                            @php
                                $no = 1;
                            @endphp
                            @foreach($pelaporans as $pelaporan)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td><i class="bi bi-ui-checks"></i> Pelaporan - {{ $pelaporan->jenis_pelaporan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pelaporan->created_at)->format('d F Y') }}</td>
                                    <td>
                                        @if($pelaporan->status === 'pending')
                                            <span class="badge rounded-pill text-bg-secondary">
                                                <i class="bi bi-info-circle-fill me-1"></i> Menunggu Konfirmasi
                                            </span>
                                        @elseif($pelaporan->status === 'proses')
                                            <span class="badge rounded-pill text-bg-warning">
                                                <i class="bi bi-hourglass-split me-1"></i> Penyelesaian Masalah
                                            </span>
                                        @elseif($pelaporan->status === 'selesai')
                                            <span class="badge rounded-pill text-bg-success">
                                                <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                            </span>
                                        @else
                                            <span class="badge rounded-pill text-bg-dark">
                                                <i class="bi bi-question-circle-fill me-1"></i> Tidak Diketahui
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.riwayat.showPelaporan', $pelaporan->id) }}" class="btn btn-outline-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($pengaduans as $pengaduan)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td><i class="bi bi-ui-checks"></i> Pengaduan</td>
                                    <td>{{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d F Y') }}</td>
                                    <td>
                                        @if($pengaduan->status === 'pending')
                                            <span class="badge rounded-pill text-bg-secondary">
                                                <i class="bi bi-info-circle-fill me-1"></i> Menunggu Konfirmasi
                                            </span>
                                        @elseif($pengaduan->status === 'proses')
                                            <span class="badge rounded-pill text-bg-warning">
                                                <i class="bi bi-hourglass-split me-1"></i> Penyelesaian Masalah
                                            </span>
                                        @elseif($pengaduan->status === 'selesai')
                                            <span class="badge rounded-pill text-bg-success">
                                                <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                            </span>
                                        @else
                                            <span class="badge rounded-pill text-bg-dark">
                                                <i class="bi bi-question-circle-fill me-1"></i> Tidak Diketahui
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.riwayat.showPengaduan', $pengaduan->id) }}" class="btn btn-outline-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
