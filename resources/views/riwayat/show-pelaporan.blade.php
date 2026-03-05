@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Detail Pelaporan</h2>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 text-primary">Informasi Laporan</h5>
                </div>
                <div class="card-body" style="max-height: 70dvh; overflow-y: auto;">
                    <dl class="row">
                        <dt class="col-sm-4 text-muted">Jenis Pelaporan</dt>
                        <dd class="col-sm-8 fw-semibold">{{ $pelaporan->jenis_pelaporan }}</dd>

                        <dt class="col-sm-4 text-muted">Status Saat Ini</dt>
                        <dd class="col-sm-8">
                            @php
                                $statusMap = [
                                    'pending' => ['bg-secondary', 'Menunggu Konfirmasi'],
                                    'proses'  => ['bg-warning text-dark', 'Penyelesaian Masalah'],
                                    'selesai' => ['bg-success', 'Selesai']
                                ];
                                $current = $statusMap[$pelaporan->status] ?? ['bg-dark', ucfirst($pelaporan->status)];
                            @endphp
                            <span class="badge rounded-pill {{ $current[0] }} px-3">{{ $current[1] }}</span>
                        </dd>

                        <hr class="my-3">

                        <dt class="col-sm-4 text-muted">Nama Pelaku</dt>
                        <dd class="col-sm-8">{{ $pelaporan->nama_pelaku ?? 'Tidak Disebutkan' }}</dd>

                        <dt class="col-sm-4 text-muted">Jabatan Pelaku</dt>
                        <dd class="col-sm-8">{{ $pelaporan->jabatan_pelaku ?? '-' }}</dd>

                        <dt class="col-sm-4 text-muted">Lokasi Kejadian</dt>
                        <dd class="col-sm-8">
                            {{ $pelaporan->lokasi }}
                            @if($pelaporan->latitude && $pelaporan->longitude)
                                <div class="mt-1">
                                    <a href="https://www.google.com/maps?q={{ $pelaporan->latitude }},{{ $pelaporan->longitude }}" target="_blank" class="badge bg-light text-primary border border-primary text-decoration-none">
                                        <i class="bi bi-map me-1"></i> Buka Peta
                                    </a>
                                </div>
                            @endif
                        </dd>

                        <dt class="col-sm-4 text-muted">Deskripsi</dt>
                        <dd class="col-sm-8 text-justify">{{ $pelaporan->deskripsi }}</dd>

                        <dt class="col-sm-4 text-muted">File Laporan</dt>
                        <dd class="col-sm-8">
                            @if ($pelaporan->file_laporan)
                                <a href="{{ asset('storage/' . $pelaporan->file_laporan) }}" class="btn btn-sm btn-outline-info" target="_blank">
                                    <i class="bi bi-file-earmark-arrow-down me-1"></i> Buka Lampiran
                                </a>
                            @else
                                <span class="text-muted italic small">Tidak ada lampiran</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4 text-muted pt-2">Kontak Follow Up</dt>
                        <dd class="col-sm-8 pt-2">
                            @if ($pelaporan->follow_up_contact)
                                @foreach (json_decode($pelaporan->follow_up_contact) as $contact)
                                    <span class="badge bg-light text-dark border">{{ $contact }}</span>
                                @endforeach
                            @endif
                            <div class="small text-muted mt-1">{{ $pelaporan->follow_up_contact_other }}</div>
                        </dd>
                    </dl>
                </div>
                <div class="card-footer bg-light text-muted small">
                    Dilaporkan pada: {{ $pelaporan->created_at->format('d M Y, H:i') }}
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-body text-center py-4">
                    <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-calendar-check text-primary fs-3"></i>
                    </div>
                    <h5 class="fw-bold">Jadwal Konsultasi</h5>
                    
                    @if ($pelaporan->konsultasi && $pelaporan->konsultasi->jadwal_konsultasi)
                        <div class="mt-3 text-start bg-light p-3 rounded border border-dashed">
                            <label class="small text-muted d-block">Waktu:</label>
                            <span class="fw-bold d-block">{{ \Carbon\Carbon::parse($pelaporan->konsultasi->jadwal_konsultasi)->translatedFormat('l, d F Y') }}</span>
                            <span class="text-primary fw-semibold">{{ \Carbon\Carbon::parse($pelaporan->konsultasi->jadwal_konsultasi)->format('H:i') }} WIB</span>
                            
                            <label class="small text-muted d-block mt-2">Metode:</label>
                            <span class="badge bg-info text-dark">{{ ucfirst($pelaporan->konsultasi->type_konsultasi) }}</span>

                            @if($pelaporan->konsultasi->link_konsultasi)
                                <a href="{{ $pelaporan->konsultasi->link_konsultasi }}" target="_blank" class="btn btn-primary btn-sm w-100 mt-3">
                                    <i class="bi bi-camera-video me-1"></i> Gabung Konsultasi
                                </a>
                            @endif
                        </div>
                    @else
                        <p class="text-muted small mt-2">Belum ada jadwal konsultasi yang ditetapkan oleh petugas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection