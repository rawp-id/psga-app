@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manajemen Konsultasi Pelaporan</h1>

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
            Tambah Konsultasi
        </button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelaporan</th>
                    <th>Jadwal</th>
                    <th>Tipe</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Konsultan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($konsultasis as $k)
                    <tr>
                        <td>{{ $k->id }}</td>
                        <td>{{ $k->pelaporan->user->name ?? '-' }}</td>
                        <td>{{ $k->jadwal_konsultasi }}</td>
                        <td>{{ $k->type_konsultasi }}</td>
                        <td>{{ $k->link_konsultasi }}</td>
                        <td>{{ $k->status_konsultasi }}</td>
                        <td>
                            @if ($k->konsultan && $k->konsultan->name)
                                {{ $k->konsultan->name }} - {{ $k->konsultan->role->name ?? 'User' }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $k->id }}">Edit</button>
                            <form action="{{ route('admin.konsultasi-pelaporans.destroy', $k->id) }}" method="POST"
                                style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $k->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.konsultasi-pelaporans.update', $k->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header">
                                        <h5>Edit Konsultasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Pelaporan</label>
                                            <select name="pelaporan_id" class="form-control" required>
                                                @foreach ($pelaporans as $p)
                                                    <option value="{{ $p->id }}"
                                                        {{ $k->pelaporan_id == $p->id ? 'selected' : '' }}>
                                                        #{{ $p->id }} - {{ $p->user->name ?? '-' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Jadwal Konsultasi</label>
                                            <input type="datetime-local" name="jadwal_konsultasi"
                                                value="{{ $k->jadwal_konsultasi ? \Carbon\Carbon::parse($k->jadwal_konsultasi)->format('Y-m-d\TH:i') : '' }}"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Tipe Konsultasi</label>
                                            <select name="type_konsultasi" class="form-control">
                                                <option value="online"
                                                    {{ $k->type_konsultasi == 'online' ? 'selected' : '' }}>Online</option>
                                                <option value="offline"
                                                    {{ $k->type_konsultasi == 'offline' ? 'selected' : '' }}>Offline
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Link</label>
                                            <input type="text" name="link_konsultasi" value="{{ $k->link_konsultasi }}"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Status</label>
                                            <select name="status_konsultasi" class="form-control">
                                                <option value="pending"
                                                    {{ $k->status_konsultasi == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="completed"
                                                    {{ $k->status_konsultasi == 'completed' ? 'selected' : '' }}>Completed
                                                </option>
                                                <option value="canceled"
                                                    {{ $k->status_konsultasi == 'canceled' ? 'selected' : '' }}>Canceled
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Konsultan</label>
                                            <select name="konsultan_id" class="form-control">
                                                <option value="">-</option>
                                                @foreach ($konsultans as $u)
                                                    <option value="{{ $u->id }}"
                                                        {{ $k->konsultan_id == $u->id ? 'selected' : '' }}>
                                                        {{ $u->name }} - {{ $u->role->name ?? 'User' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.konsultasi-pelaporans.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5>Tambah Konsultasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Pelaporan</label>
                            <select name="pelaporan_id" class="form-control" required>
                                @foreach ($pelaporans as $p)
                                    <option value="{{ $p->id }}">#{{ $p->id }} - {{ $p->user->name ?? '-' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Jadwal Konsultasi</label>
                            <input type="datetime-local" name="jadwal_konsultasi" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Tipe Konsultasi</label>
                            <select name="type_konsultasi" class="form-control">
                                <option value="online">Online</option>
                                <option value="offline">Offline</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Link</label>
                            <input type="text" name="link_konsultasi" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status_konsultasi" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Konsultan</label>
                            <select name="konsultan_id" class="form-control">
                                <option value="">-</option>
                                @foreach ($konsultans as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }} - {{ $u->role->name ?? 'User' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
