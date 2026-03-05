@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold">
                <i class="bi bi-chat-dots-fill me-2"></i>Manajemen Konsultasi Pelaporan
            </h5>
            <button class="btn btn-primary shadow-sm btn-sm px-3" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Konsultasi
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Info Pelapor</th>
                            <th>Jadwal & Tipe</th>
                            <th>Link / Lokasi</th>
                            <th>Status</th>
                            <th>Konsultan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($konsultasis as $k)
                            <tr>
                                <td class="ps-3 fw-bold text-muted">#{{ $k->id }}</td>
                                <td>
                                    <div class="fw-bold">{{ $k->pelaporan->user->name ?? 'N/A' }}</div>
                                    <small class="text-muted text-xs">ID Pelaporan: #{{ $k->pelaporan_id }}</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar3 me-2 text-primary"></i>
                                        <span>{{ \Carbon\Carbon::parse($k->jadwal_konsultasi)->format('d M Y, H:i') }}</span>
                                    </div>
                                    <span class="badge rounded-pill bg-light text-dark border mt-1">
                                        {{ ucfirst($k->type_konsultasi) }}
                                    </span>
                                </td>
                                <td>
                                    @if($k->link_konsultasi)
                                        <a href="{{ $k->link_konsultasi }}" target="_blank" class="text-decoration-none text-truncate d-inline-block" style="max-width: 150px;">
                                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka Link
                                        </a>
                                    @else
                                        <span class="text-muted small italic">-</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'pending' => 'bg-warning text-dark',
                                            'completed' => 'bg-success',
                                            'canceled' => 'bg-danger'
                                        ][$k->status_konsultasi] ?? 'bg-secondary';
                                    @endphp
                                    <span class="badge {{ $statusClass }} px-3 py-2">
                                        {{ strtoupper($k->status_konsultasi) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($k->konsultan)
                                        <div class="fw-bold small">{{ $k->konsultan->name }}</div>
                                        <div class="text-muted" style="font-size: 0.75rem;">{{ $k->konsultan->role->name ?? 'Staff' }}</div>
                                    @else
                                        <span class="badge bg-light text-muted border">Belum Ditugaskan</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <button class="btn btn-white btn-sm border" data-bs-toggle="modal" data-bs-target="#editModal{{ $k->id }}" title="Edit">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                        </button>
                                        <form action="{{ route('admin.konsultasi-pelaporans.destroy', $k->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-white btn-sm border" onclick="return confirm('Yakin hapus?')" title="Hapus">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $k->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <form action="{{ route('admin.konsultasi-pelaporans.update', $k->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold">Update Konsultasi #{{ $k->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body row g-3">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Pelaporan</label>
                                                    <select name="pelaporan_id" class="form-select" required>
                                                        @foreach ($pelaporans as $p)
                                                            <option value="{{ $p->id }}" {{ $k->pelaporan_id == $p->id ? 'selected' : '' }}>
                                                                #{{ $p->id }} - {{ $p->user->name ?? '-' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold text-sm">Jadwal</label>
                                                    <input type="datetime-local" name="jadwal_konsultasi" value="{{ $k->jadwal_konsultasi ? \Carbon\Carbon::parse($k->jadwal_konsultasi)->format('Y-m-d\TH:i') : '' }}" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold text-sm">Tipe</label>
                                                    <select name="type_konsultasi" class="form-select">
                                                        <option value="online" {{ $k->type_konsultasi == 'online' ? 'selected' : '' }}>Online</option>
                                                        <option value="offline" {{ $k->type_konsultasi == 'offline' ? 'selected' : '' }}>Offline</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-sm">Link / Lokasi</label>
                                                    <input type="text" name="link_konsultasi" value="{{ $k->link_konsultasi }}" class="form-control" placeholder="Zoom Link atau Ruangan">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold text-sm text-primary">Status</label>
                                                    <select name="status_konsultasi" class="form-select border-primary">
                                                        <option value="pending" {{ $k->status_konsultasi == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="completed" {{ $k->status_konsultasi == 'completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="canceled" {{ $k->status_konsultasi == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold text-sm">Konsultan</label>
                                                    <select name="konsultan_id" class="form-select">
                                                        <option value="">- Pilih Konsultan -</option>
                                                        @foreach ($konsultans as $u)
                                                            <option value="{{ $u->id }}" {{ $k->konsultan_id == $u->id ? 'selected' : '' }}>
                                                                {{ $u->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light p-2">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success btn-sm px-4 shadow-sm">Update Data</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted small">Tidak ada data konsultasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('admin.konsultasi-pelaporans.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Konsultasi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">Pilih Pelaporan</label>
                        <select name="pelaporan_id" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @foreach ($pelaporans as $p)
                                <option value="{{ $p->id }}">#{{ $p->id }} - {{ $p->user->name ?? '-' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jadwal</label>
                        <input type="datetime-local" name="jadwal_konsultasi" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tipe</label>
                        <select name="type_konsultasi" class="form-select">
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Link / Lokasi</label>
                        <input type="text" name="link_konsultasi" class="form-control" placeholder="Zoom Link atau Ruangan">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status Awal</label>
                        <select name="status_konsultasi" class="form-select">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Pilih Konsultan</label>
                        <select name="konsultan_id" class="form-control">
                            <option value="">-</option>
                            @foreach ($konsultans as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light p-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm px-4">Simpan Konsultasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .text-xs { font-size: 0.75rem; }
    .table thead th { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .btn-group .btn { border-radius: 4px !important; margin: 0 2px; }
    .card-header { border-bottom: 1px solid #f0f0f0; }
</style>
@endsection