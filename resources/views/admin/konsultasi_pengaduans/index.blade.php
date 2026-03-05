@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center" style="border-radius: 15px 15px 0 0;">
            <h5 class="fw-bold text-dark mb-0">
                <i class="bi bi-chat-left-quote-fill me-2"></i>Manajemen Konsultasi Pengaduan
            </h5>
            <button class="btn btn-primary shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Konsultasi
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Pelapor (Pengaduan)</th>
                            <th>Jadwal & Tipe</th>
                            <th>Link / Lokasi</th>
                            <th>Konsultan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($konsultasis as $k)
                        <tr>
                            <td class="ps-4 fw-bold">#{{ $k->id }}</td>
                            <td>
                                <div class="fw-bold">{{ $k->pengaduan->user->name ?? '-' }}</div>
                                <small class="text-muted">ID Pengaduan: #{{ $k->pengaduan_id }}</small>
                            </td>
                            <td>
                                <div><i class="bi bi-calendar-event me-1 text-primary"></i> {{ \Carbon\Carbon::parse($k->jadwal_konsultasi)->format('d M Y, H:i') }}</div>
                                <span class="badge rounded-pill bg-light text-dark border mt-1" style="font-size: 10px;">
                                    {{ strtoupper($k->type_konsultasi) }}
                                </span>
                            </td>
                            <td>
                                @if($k->link_konsultasi)
                                    <a href="{{ $k->link_konsultasi }}" target="_blank" class="text-truncate d-inline-block text-decoration-none shadow-sm badge bg-info bg-opacity-10 text-info border border-info" style="max-width: 150px;">
                                        <i class="bi bi-link-45deg"></i> Buka Link
                                    </a>
                                @else
                                    <span class="text-muted small italic">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($k->konsultan)
                                    <div class="fw-bold small">{{ $k->konsultan->name }}</div>
                                    <div class="text-muted" style="font-size: 11px;">{{ $k->konsultan->role->name ?? 'Staff' }}</div>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @php
                                    $statusColor = [
                                        'pending' => 'bg-warning text-dark',
                                        'completed' => 'bg-success',
                                        'canceled' => 'bg-danger'
                                    ][$k->status_konsultasi] ?? 'bg-secondary';
                                @endphp
                                <span class="badge {{ $statusColor }} px-3 py-2">
                                    {{ strtoupper($k->status_konsultasi) }}
                                </span>
                            </td>
                            <td class="text-center pe-4">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-warning border-0 shadow-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $k->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="{{ route('admin.konsultasi-pengaduans.destroy', $k->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger border-0 shadow-sm" onclick="return confirm('Hapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $k->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('admin.konsultasi-pengaduans.update', $k->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="fw-bold mb-0">Edit Konsultasi #{{ $k->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body row g-3">
                                            <div class="col-12">
                                                <label class="form-label fw-bold small">Pengaduan Terkait</label>
                                                <select name="pengaduan_id" class="form-select" required>
                                                    @foreach($pengaduans as $p)
                                                        <option value="{{ $p->id }}" {{ $k->pengaduan_id == $p->id ? 'selected' : '' }}>
                                                            #{{ $p->id }} - {{ $p->user->name ?? '-' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold small">Jadwal Konsultasi</label>
                                                <input type="datetime-local" name="jadwal_konsultasi" value="{{ $k->jadwal_konsultasi ? \Carbon\Carbon::parse($k->jadwal_konsultasi)->format('Y-m-d\TH:i') : '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold small">Tipe</label>
                                                <select name="type_konsultasi" class="form-select">
                                                    <option value="online" {{ $k->type_konsultasi == 'online' ? 'selected' : '' }}>Online</option>
                                                    <option value="offline" {{ $k->type_konsultasi == 'offline' ? 'selected' : '' }}>Offline</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-bold small">Link / Lokasi</label>
                                                <input type="text" name="link_konsultasi" value="{{ $k->link_konsultasi }}" class="form-control" placeholder="https://zoom.us/j/...">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold small">Status</label>
                                                <select name="status_konsultasi" class="form-select border-primary">
                                                    <option value="pending" {{ $k->status_konsultasi == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="completed" {{ $k->status_konsultasi == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="canceled" {{ $k->status_konsultasi == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold small">Konsultan</label>
                                                <select name="konsultan_id" class="form-select">
                                                    <option value="">- Pilih Konsultan -</option>
                                                    @foreach($konsultans as $u)
                                                        <option value="{{ $u->id }}" {{ $k->konsultan_id == $u->id ? 'selected' : '' }}>
                                                            {{ $u->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted small">Data konsultasi belum tersedia.</td>
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
            <form action="{{ route('admin.konsultasi-pengaduans.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="fw-bold mb-0 text-primary">Tambah Konsultasi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-12">
                        <label class="form-label fw-bold small">Pilih Pengaduan</label>
                        <select name="pengaduan_id" class="form-select select2" required>
                            @foreach($pengaduans as $p)
                                <option value="{{ $p->id }}">#{{ $p->id }} - {{ $p->user->name ?? '-' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Jadwal</label>
                        <input type="datetime-local" name="jadwal_konsultasi" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Tipe</label>
                        <select name="type_konsultasi" class="form-select">
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold small">Link / Lokasi</label>
                        <input type="text" name="link_konsultasi" class="form-control" placeholder="Link Meeting atau Nama Ruangan">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Status Awal</label>
                        <select name="status_konsultasi" class="form-select">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small">Konsultan</label>
                        <select name="konsultan_id" class="form-select">
                            <option value="">- Pilih -</option>
                            @foreach($konsultans as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
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