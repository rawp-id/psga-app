@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (empty($user->number_phone))
                    <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center p-4 mb-4" role="alert"
                        style="border-radius: 15px;">
                        <i class="bi bi-exclamation-triangle-fill fs-2 me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Nomor WhatsApp Belum Terhubung!</h6>
                            <p class="mb-0 small">Segera lengkapi nomor telepon Anda untuk menerima notifikasi pengaduan dan
                                jadwal konsultasi secara real-time.</p>
                        </div>
                    </div>
                @endif

                <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0">Pengaturan Profil</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4 text-center mb-4">
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ $user->image ? $user->image : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}"
                                            class="rounded-circle img-thumbnail shadow-sm"
                                            style="width: 150px; height: 150px; object-fit: cover;" id="profilePreview">
                                        <label for="image"
                                            class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow"
                                            style="cursor: pointer;">
                                            <i class="bi bi-camera-fill"></i>
                                            <input type="file" name="image" id="image" class="d-none"
                                                onchange="previewImg()">
                                        </label>
                                    </div>
                                    <div class="mt-2 small text-muted">Klik ikon kamera untuk ganti foto</div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Alamat Email</label>
                                        <input type="email" class="form-control bg-light" value="{{ $user->email }}"
                                            readonly>
                                        <small class="text-muted">Email tidak dapat diubah.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold d-flex justify-content-between">
                                            Nomor WhatsApp
                                            @if ($user->number_phone_verified_at)
                                                <span class="badge bg-success-subtle text-success border border-success">
                                                    <i class="bi bi-patch-check-fill"></i> Terverifikasi
                                                </span>
                                            @else
                                                <a href="{{ url('/otp') }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-shield-check"></i> Verifikasi
                                                </a>
                                            @endif
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-whatsapp text-success"></i>
                                            </span>
                                            <input type="text" name="number_phone"
                                                class="form-control border-start-0 @error('number_phone') is-invalid @enderror"
                                                placeholder="Contoh: 08123456789"
                                                value="{{ old('number_phone', $user->number_phone) }}">
                                        </div>
                                        @error('number_phone')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- <hr class="my-4">
                                    <p class="text-muted small">Kosongkan kolom di bawah jika tidak ingin mengganti
                                        password.</p>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Password Baru</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div> --}}

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan
                                            Perubahan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImg() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('#profilePreview');
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
