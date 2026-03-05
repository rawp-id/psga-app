@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark">Riwayat Panggilan Darurat</h3>
            <p class="text-muted small">Daftar mahasiswa yang menekan Panic Button</p>
        </div>
        <span class="badge bg-danger p-2 px-3 rounded-pill pulse-red">Radar Aktif</span>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive p-3">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0">Waktu</th>
                        <th class="border-0">Mahasiswa</th>
                        <th class="border-0">Koordinat</th>
                        <th class="border-0">Status</th>
                        <th class="border-0 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($histories as $panic)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $panic->created_at->format('H:i:s') }}</div>
                            <small class="text-muted">{{ $panic->created_at->format('d M Y') }}</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                    {{ substr($panic->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-medium">{{ $panic->user->name }}</div>
                                    <small class="text-muted">{{ $panic->user->nim ?? 'NIM tidak ada' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <code class="text-primary small">{{ $panic->latitude }}, {{ $panic->longitude }}</code>
                        </td>
                        <td>
                            @if($panic->status == 'pending')
                                <span class="badge bg-light-danger text-danger border border-danger">Butuh Penanganan</span>
                            @else
                                <span class="badge bg-light-success text-success border border-success">Selesai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="https://www.google.com/maps?q={{ $panic->latitude }},{{ $panic->longitude }}" 
                                   target="_blank" class="btn btn-sm btn-outline-primary" title="Lihat Lokasi">
                                    <i class="bi bi-geo-alt"></i>
                                </a>
                                @if($panic->status == 'pending')
                                <a href="{{ route('admin.panic.resolve', $panic->id) }}" 
                                   class="btn btn-sm btn-success" title="Tandai Selesai">
                                    <i class="bi bi-check-lg"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada riwayat darurat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $histories->links() }}
        </div>
    </div>
</div>

<style>
    .bg-light-danger { background-color: #f8d7da; }
    .bg-light-success { background-color: #d1e7dd; }
    .pulse-red {
        animation: pulse-animation 2s infinite;
    }
    @keyframes pulse-animation {
        0% { box-shadow: 0 0 0 0px rgba(220, 53, 69, 0.4); }
        100% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
    }
</style>
@endsection