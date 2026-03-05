@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-1">Arsip Riwayat</h2>
            <p class="text-muted">Pantau dan kelola semua status laporan masuk.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="small text-muted text-uppercase">
                            <th class="ps-4 py-3">No</th>
                            <th>Layanan & Jenis</th>
                            <th>Tanggal Masuk</th>
                            <th>Status</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        {{-- Gabungan Pelaporan & Pengaduan --}}
                        @foreach($pelaporans->concat($pengaduans)->sortByDesc('created_at') as $item)
                        <tr>
                            <td class="ps-4 text-muted">{{ $no++ }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if(isset($item->jenis_pelaporan))
                                        <div class="icon-shape bg-primary-subtle text-primary rounded-3 me-3 p-2">
                                            <i class="bi bi-file-earmark-text-fill"></i>
                                        </div>
                                        <div>
                                            <span class="d-block fw-bold text-dark">Pelaporan</span>
                                            <small class="text-muted">{{ $item->jenis_pelaporan }}</small>
                                        </div>
                                    @else
                                        <div class="icon-shape bg-info-subtle text-info rounded-3 me-3 p-2">
                                            <i class="bi bi-megaphone-fill"></i>
                                        </div>
                                        <div>
                                            <span class="d-block fw-bold text-dark">Pengaduan</span>
                                            <small class="text-muted">Layanan Umum</small>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-muted">
                                {{ $item->created_at->translatedFormat('d M Y') }}
                                <div class="small" style="font-size: 11px;">{{ $item->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                @php
                                    $statusClass = [
                                        'pending' => 'bg-secondary-subtle text-secondary border-secondary',
                                        'proses' => 'bg-warning-subtle text-warning-emphasis border-warning',
                                        'selesai' => 'bg-success-subtle text-success border-success'
                                    ][$item->status] ?? 'bg-dark-subtle text-dark';
                                    
                                    $statusLabel = [
                                        'pending' => 'Menunggu',
                                        'proses' => 'Penyelesaian',
                                        'selesai' => 'Selesai'
                                    ][$item->status] ?? $item->status;
                                @endphp
                                <span class="badge border px-3 py-2 rounded-pill {{ $statusClass }}" style="font-weight: 600; font-size: 11px;">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i> {{ strtoupper($statusLabel) }}
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ isset($item->jenis_pelaporan) ? route('admin.riwayat.showPelaporan', $item->id) : route('admin.riwayat.showPengaduan', $item->id) }}" 
                                   class="btn btn-light btn-sm rounded-pill px-3 fw-bold border">
                                    Detail <i class="bi bi-arrow-right ms-1"></i>
                                </a>
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