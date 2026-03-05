@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('riwayat.index') }}">Riwayat</a></li>
                    <li class="breadcrumb-item active">Detail Pengaduan</li>
                </ol>
            </nav>
            <h2 class="fw-bold">Detail Pengaduan</h2>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h5 class="card-title mb-0 text-primary fw-semibold">
                        <i class="bi bi-info-square me-2"></i>Informasi Pengaduan
                    </h5>
                </div>
                <div class="card-body px-4" style="max-height: 70dvh; overflow-y: auto;">
                    <dl class="row">
                        <dt class="col-sm-4 text-muted">Lokasi</dt>
                        <dd class="col-sm-8 fw-semibold">{{ $pengaduan->lokasi }}</dd>

                        <dt class="col-sm-4 text-muted">Status</dt>
                        <dd class="col-sm-8">
                            @php
                                $statusMap = [
                                    'pending' => ['bg-secondary', 'Menunggu Konfirmasi', 'bi-clock'],
                                    'proses'  => ['bg-warning text-dark', 'Penyelesaian Masalah', 'bi-hourglass-split'],
                                    'selesai' => ['bg-success', 'Selesai', 'bi-check-circle']
                                ];
                                $st = $statusMap[$pengaduan->status] ?? ['bg-dark', ucfirst($pengaduan->status), 'bi-question'];
                            @endphp
                            <span class="badge rounded-pill {{ $st[0] }} px-3">
                                <i class="bi {{ $st[2] }} me-1"></i> {{ $st[1] }}
                            </span>
                        </dd>

                        <hr class="my-4">

                        <dt class="col-sm-4 text-muted">Nama Pelaku</dt>
                        <dd class="col-sm-8">{{ $pengaduan->nama_pelaku ?? 'Tidak Disebutkan' }}</dd>

                        <dt class="col-sm-4 text-muted">Jabatan Pelaku</dt>
                        <dd class="col-sm-8">{{ $pengaduan->jabatan_pelaku ?? '-' }}</dd>

                        <dt class="col-sm-4 text-muted">Lokasi Kejadian</dt>
                        <dd class="col-sm-8">
                            @if($pengaduan->latitude && $pengaduan->longitude)
                                {{-- <span class="text-small font-monospace">{{ $pengaduan->latitude }}, {{ $pengaduan->longitude }}</span> --}}
                                <a href="https://www.google.com/maps?q={{ $pengaduan->latitude }},{{ $pengaduan->longitude }}" target="_blank" class="badge bg-light text-primary border border-primary text-decoration-none">
                                    <i class="bi bi-map me-1"></i> Buka Peta
                                </a>
                            @else
                                <span class="text-muted italic">-</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4 text-muted pt-3">Deskripsi</dt>
                        <dd class="col-sm-8 pt-3 text-break">{{ $pengaduan->deskripsi }}</dd>

                        <dt class="col-sm-4 text-muted pt-3">Data Pengaduan</dt>
                        <dd class="col-sm-8 pt-3">{{ $pengaduan->data_pengaduan ?? '-' }}</dd>

                        <dt class="col-sm-4 text-muted pt-3">Lampiran File</dt>
                        <dd class="col-sm-8 pt-3">
                            @if ($pengaduan->file_pengaduan)
                                <a href="{{ asset('storage/' . $pengaduan->file_pengaduan) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-file-earmark-arrow-down me-1"></i> Unduh Berkas
                                </a>
                            @else
                                <span class="text-muted small italic">Tidak ada lampiran</span>
                            @endif
                        </dd>
                    </dl>
                </div>
                <div class="card-footer bg-light border-0 py-3 text-center">
                    <small class="text-muted">Diajukan pada {{ $pengaduan->created_at->format('d M Y') }} pukul {{ $pengaduan->created_at->format('H:i') }}</small>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4 text-center">
                    <div class="mb-3 text-primary">
                        <i class="bi bi-calendar2-event fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Agenda Konsultasi</h5>
                    
                    @if ($pengaduan->konsultasi && $pengaduan->konsultasi->jadwal_konsultasi)
                        <div class="text-start bg-light p-3 rounded border border-dashed">
                            <div class="mb-2">
                                <label class="small text-muted d-block">Tanggal & Waktu:</label>
                                <span class="fw-bold">{{ \Carbon\Carbon::parse($pengaduan->konsultasi->jadwal_konsultasi)->translatedFormat('l, d F Y') }}</span>
                                <br>
                                <span class="text-primary font-monospace">{{ \Carbon\Carbon::parse($pengaduan->konsultasi->jadwal_konsultasi)->format('H:i') }} WIB</span>
                            </div>

                            <div class="mb-3">
                                <label class="small text-muted d-block">Metode:</label>
                                <span class="badge bg-info-subtle text-info border border-info px-2">
                                    {{ ucfirst($pengaduan->konsultasi->type_konsultasi) }}
                                </span>
                            </div>

                            @if($pengaduan->konsultasi->link_konsultasi)
                                <a href="{{ $pengaduan->konsultasi->link_konsultasi }}" target="_blank" class="btn btn-primary w-100 shadow-sm">
                                    <i class="bi bi-camera-video me-2"></i> Klik Link Konsultasi
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="py-3">
                            <p class="text-muted mb-0 small">Belum ada jadwal konsultasi yang tersedia untuk pengaduan ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection