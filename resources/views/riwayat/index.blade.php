@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body m-4">
            <h5 class="fw-bold"><i class="bi bi-clock-history me-2"></i>Riwayat Pengajuan</h5>
            <hr>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" width="5%">No</th>
                            <th scope="col">Layanan & Jenis</th>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp

                        {{-- Combined Collection or Individual Loops --}}
                        @forelse($pelaporans->concat($pengaduans)->sortByDesc('created_at') as $item)
                            @php
                                // Detect if it's Pelaporan or Pengaduan
                                $isPelaporan = isset($item->jenis_pelaporan);
                                $statusClasses = [
                                    'pending' => 'text-bg-secondary',
                                    'proses'  => 'text-bg-warning',
                                    'selesai' => 'text-bg-success'
                                ];
                                $statusLabels = [
                                    'pending' => 'Menunggu Konfirmasi',
                                    'proses'  => 'Penyelesaian Masalah',
                                    'selesai' => 'Selesai'
                                ];
                                $statusIcons = [
                                    'pending' => 'bi-info-circle-fill',
                                    'proses'  => 'bi-hourglass-split',
                                    'selesai' => 'bi-check-circle-fill'
                                ];
                            @endphp

                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <div class="fw-semibold">
                                        <i class="bi {{ $isPelaporan ? 'bi- megaphone' : 'bi-shield-exclamation' }} me-2 text-primary"></i>
                                        {{ $isPelaporan ? 'Pelaporan' : 'Pengaduan' }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $isPelaporan ? $item->jenis_pelaporan : 'Aduan Umum' }}
                                    </small>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                </td>
                                <td>
                                    <span class="badge rounded-pill {{ $statusClasses[$item->status] ?? 'text-bg-dark' }}">
                                        <i class="bi {{ $statusIcons[$item->status] ?? 'bi-question-circle' }} me-1"></i>
                                        {{ $statusLabels[$item->status] ?? 'Tidak Diketahui' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ $isPelaporan ? route('riwayat.showPelaporan', $item->id) : route('riwayat.showPengaduan', $item->id) }}" 
                                       class="btn btn-sm btn-outline-primary px-3">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder2-open d-block mb-2" style="font-size: 2rem;"></i>
                                    Belum ada riwayat aktivitas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection