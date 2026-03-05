@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-1">Manajemen Pengguna</h2>
                <p class="text-muted small mb-0">Kelola hak akses admin dan konsultan di sini.</p>
            </div>
            <div class="d-flex gap-2">
                <div class="bg-white px-3 py-2 rounded-3 shadow-sm border">
                    <small class="text-muted d-block">Total User</small>
                    <span class="fw-bold">{{ $users->count() }}</span>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary">
                            <tr>
                                <th class="ps-4 py-3 border-0">Profil User</th>
                                <th class="py-3 border-0">Kontak</th>
                                <th class="py-3 border-0 text-center">Status Konsultan</th>
                                <th class="py-3 border-0 text-center">Akses Admin</th>
                                <th class="py-3 border-0">Role</th>
                                <th class="pe-4 py-3 border-0 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->image ? $user->image : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}"
                                                class="rounded-circle me-3" width="40" height="40"
                                                style="object-fit: cover;">
                                            <div>
                                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                                                <small class="text-muted">ID: #{{ $user->id }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="small"><i class="bi bi-envelope me-1"></i> {{ $user->email }}</div>
                                        <div class="small text-muted"><i class="bi bi-whatsapp me-1"></i>
                                            {{ $user->number_phone ?? '-' }}</div>
                                    </td>

                                    <td class="text-center">
                                        <form action="{{ route('admin.users.updateKonsultan', $user->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm rounded-pill px-3 {{ $user->is_konsultan ? 'btn-primary' : 'btn-outline-secondary opacity-50' }}"
                                                onclick="return confirm('Ubah status konsultan?')">
                                                <i
                                                    class="bi {{ $user->is_konsultan ? 'bi-person-check-fill' : 'bi-person' }} me-1"></i>
                                                {{ $user->is_konsultan ? 'Konsultan' : 'Jadikan' }}
                                            </button>
                                        </form>
                                    </td>

                                    <td class="text-center">
                                        <form action="{{ route('admin.users.updateAdmin', $user->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm rounded-pill px-3 {{ $user->is_admin ? 'btn-dark' : 'btn-outline-secondary opacity-50' }}"
                                                onclick="return confirm('Ubah akses admin?')">
                                                <i
                                                    class="bi {{ $user->is_admin ? 'bi-shield-lock-fill' : 'bi-shield' }} me-1"></i>
                                                {{ $user->is_admin ? 'Admin' : 'Jadikan' }}
                                            </button>
                                        </form>
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark border fw-medium">
                                            {{ $user->role->name ?? 'User' }}
                                        </span>
                                    </td>

                                    <td class="pe-4 text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow border-0"
                                                style="border-radius: 12px;">
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>
                                                        Detail</a></li>
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-pencil me-2"></i> Edit</a></li>
                                                {{-- <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                        method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger"
                                                            onclick="return confirm('Hapus user?')">
                                                            <i class="bi bi-trash me-2"></i> Hapus
                                                        </button>
                                                    </form>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table thead th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
        }

        .table tbody tr:hover {
            background-color: #fcfdfe;
        }

        .btn-sm {
            font-size: 0.8rem;
        }
    </style>
@endsection
