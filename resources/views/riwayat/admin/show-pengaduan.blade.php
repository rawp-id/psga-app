@extends('layouts.app')

@section('content')
    @php
        $isPelaporan = isset($pelaporan);
        $data = $isPelaporan ? $pelaporan : $pengaduan;
        $type = $isPelaporan ? 'Pelaporan' : 'Pengaduan';
    @endphp

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('admin.riwayat.index') }}">Riwayat</a></li>
                        <li class="breadcrumb-item active">Detail {{ $type }}</li>
                    </ol>
                </nav>
                <h2 class="fw-bold text-dark">Pengaduan #{{ $data->id }}</h2>
            </div>
            <a href="{{ route('admin.riwayat.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-chevron-left me-1"></i> Kembali
            </a>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold"><i class="bi bi-info-circle me-2 text-primary"></i>Informasi Kejadian</h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-muted small text-uppercase fw-bold">Jenis Kasus</label>
                                <p class="fw-medium">{{ $isPelaporan ? $data->jenis_pelaporan : 'Pengaduan Umum' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small text-uppercase fw-bold">Lokasi Utama</label>
                                <p class="fw-medium">{{ $data->lokasi }}</p>
                            </div>
                            <div class="col-12">
                                <label class="text-muted small text-uppercase fw-bold">Deskripsi Kronologi</label>
                                <div class="bg-light p-3 rounded-3 mt-1" style="text-align: justify;">
                                    {{ $data->deskripsi }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small text-uppercase fw-bold">Nama Terlapor/Pelaku</label>
                                <p class="fw-medium">{{ $data->nama_pelaku ?? 'Tidak Disebutkan' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small text-uppercase fw-bold">Jabatan Terlapor</label>
                                <p class="fw-medium">{{ $data->jabatan_pelaku ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-file-earmark-pdf fs-2 text-danger me-3"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">Berkas Lampiran</h6>
                                <small class="text-muted">Bukti pendukung laporon (Gambar/Dokumen)</small>
                            </div>
                        </div>
                        @php $file = $isPelaporan ? $data->file_laporan : $data->file_pengaduan; @endphp
                        @if ($file)
                            <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-download me-2"></i> Unduh File
                            </a>
                        @else
                            <span class="text-muted small italic">Tidak ada lampiran</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; background: #f8fafc;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Tindak Lanjut Admin</h6>
                        <form
                            action="{{ $isPelaporan ? route('admin.riwayat.updatePelaporanStatus', $data->id) : route('admin.riwayat.updatePengaduanStatus', $data->id) }}"
                            method="POST">
                            @csrf @method('PATCH')
                            <div class="mb-3">
                                <select name="status" class="form-select border-0 shadow-sm py-2">
                                    <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending
                                        (Menunggu)</option>
                                    <option value="proses" {{ $data->status == 'proses' ? 'selected' : '' }}>Dalam Proses
                                    </option>
                                    <option value="selesai" {{ $data->status == 'selesai' ? 'selected' : '' }}>Selesai /
                                        Clear</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold">Update
                                Status</button>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header bg-white border-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0">Titik Koordinat</h6>
                    </div>
                    <div id="map" style="height: 250px;"></div>
                    <div class="card-body">
                        <a href="https://www.google.com/maps?q={{ $data->latitude }},{{ $data->longitude }}"
                            target="_blank" class="btn btn-dark w-100 rounded-pill py-2 fw-bold">
                            <i class="bi bi-map me-1"></i> Buka Peta
                        </a>
                        {{-- <div class="d-flex justify-content-between small">
                        <span class="text-muted">Lat: {{ $data->latitude ?? '-' }}</span>
                        <span class="text-muted">Lng: {{ $data->longitude ?? '-' }}</span>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Leaflet JS Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lat = {{ $data->latitude ?? -7.9467 }}; // Default Malang
            const lng = {{ $data->longitude ?? 112.6157 }};
            const map = L.map('map', {
                zoomControl: false
            }).setView([lat, lng], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            if ({{ $data->latitude ? 'true' : 'false' }}) {
                L.marker([lat, lng]).addTo(map).bindPopup("Lokasi Kejadian").openPopup();
            }
        });
    </script>
@endsection
