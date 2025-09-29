@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar User</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Admin</th>
                    <th>Konsultan</th>
                    <th>Role</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->number_phone }}</td>
                        <td>
                            <form action="{{ route('admin.users.updateKonsultan', $user->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Yakin ingin mengubah status konsultan user ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="btn btn-sm {{ $user->is_konsultan ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $user->is_konsultan ? 'Konsultan' : 'Jadikan Konsultan' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.users.updateAdmin', $user->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Yakin ingin mengubah status admin user ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="btn btn-sm {{ $user->is_admin ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $user->is_admin ? 'Admin' : 'Jadikan Admin' }}
                                </button>
                            </form>
                        </td>
                        <td>{{ $user->role->name ?? 'User' }}</td>
                        {{-- <td>
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                    </form>
                </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
