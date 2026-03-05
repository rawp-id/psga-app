@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-1">Dashboard Overview</h2>
            <p class="text-muted small">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>. Berikut adalah ringkasan sistem hari ini.</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 15px; border-left: 5px solid #296eff !important;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Pengaduan Pending</small>
                        <h3 class="fw-bold mb-0 mt-1">{{ $countPengaduanBaru }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-megaphone-fill text-primary fs-4"></i>
                    </div>
                </div>
                <div class="mt-2 text-muted small">Perlu ditinjau</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 15px; border-left: 5px solid #10b981 !important;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Pelaporan Pending</small>
                        <h3 class="fw-bold mb-0 mt-1">{{ $countPelaporanBaru }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-calendar-check-fill text-success fs-4"></i>
                    </div>
                </div>
                <div class="mt-2 text-muted small">Hari ini ({{ now()->format('d M') }})</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 15px; border-left: 5px solid #f59e0b !important;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Total Pengguna</small>
                        <h3 class="fw-bold mb-0 mt-1">{{ number_format($totalUser) }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-people-fill text-warning fs-4"></i>
                    </div>
                </div>
                <div class="mt-2 text-muted small">Mahasiswa & Tendik</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 15px; border-left: 5px solid #6366f1 !important;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Status Sistem</small>
                        <h3 class="fw-bold mb-0 mt-1" style="font-size: 1.5rem;">OPTIMAL</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle text-info">
                        <i class="bi bi-cpu-fill fs-4"></i>
                    </div>
                </div>
                <div class="mt-2 text-muted small">Server Time: {{ now()->format('H:i') }}</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Laporan Terbaru</h5>
                    <a href="{{ route('admin.riwayat.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr class="text-muted small">
                                    <th class="ps-4">Pelapor</th>
                                    <th>Kategori</th>
                                    <th>Waktu</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporanTerbaru as $laporan)
                                <tr>
                                    <td class="ps-4 py-3 font-weight-bold">{{ $laporan->user->name ?? 'Anonim' }}</td>
                                    <td>{{ isset($laporan->jenis_pelaporan) ? 'Pelaporan' : 'Pengaduan' }}</td>
                                    <td class="text-muted small">{{ $laporan->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        @php
                                            $badgeColor = [
                                                'pending' => 'bg-danger',
                                                'proses' => 'bg-warning text-dark',
                                                'selesai' => 'bg-success'
                                            ][$laporan->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $badgeColor }}">{{ ucfirst($laporan->status) }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada laporan masuk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; background: linear-gradient(135deg, #6366f1 0%, #296eff 100%); color: white;">
                <div class="card-body p-4 text-center">
                    <i class="bi bi-lightning-charge-fill fs-1"></i>
                    <h5 class="fw-bold mt-3">Akses Cepat Admin</h5>
                    <p class="small opacity-75">Gunakan fitur ini untuk manajemen data secara instan.</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light fw-bold text-primary border-0">Kelola Pengguna</a>
                        {{-- <a href="#" class="btn btn-outline-light border-2">Download Rekap Bulanan</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection