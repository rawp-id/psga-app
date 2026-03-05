@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0"><i class="bi bi-book-half me-2 text-primary"></i>Perpustakaan Edukasi</h5>
                <button class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="bi bi-plus-lg"></i> Tambah Konten
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Konten</th>
                                <th>Kategori</th>
                                <th>Tanggal Dibuat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($educations as $edu)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $edu->thumbnail ? asset('storage/' . $edu->thumbnail) : 'https://via.placeholder.com/50' }}"
                                                class="rounded me-3" width="50" height="40"
                                                style="object-fit: cover;">
                                            <div>
                                                <div class="fw-bold">{{ $edu->title }}</div>
                                                <small
                                                    class="text-muted">{{ Str::limit(strip_tags($edu->content), 40) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $icon = [
                                                'artikel' => 'bi-file-text',
                                                'video' => 'bi-play-circle',
                                                'pdf' => 'bi-file-pdf',
                                            ][$edu->category];
                                            $color = ['artikel' => 'info', 'video' => 'danger', 'pdf' => 'warning'][
                                                $edu->category
                                            ];
                                        @endphp
                                        <span
                                            class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} border border-{{ $color }} px-3">
                                            <i class="bi {{ $icon }} me-1"></i> {{ ucfirst($edu->category) }}
                                        </span>
                                    </td>
                                    <td class="text-muted small">{{ $edu->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.education.destroy', $edu->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-link text-danger p-0"
                                                onclick="return confirm('Hapus konten ini?')">
                                                <i class="bi bi-trash fs-5"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('admin.education.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="fw-bold">Tambah Konten Edukasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold small">Judul Konten</label>
                            <input type="text" name="title" class="form-control"
                                placeholder="Contoh: Cara Menghadapi Pelecehan Verbal" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Kategori</label>
                            <select name="category" id="categorySelect" class="form-select">
                                <option value="artikel">Artikel (Teks)</option>
                                <option value="video">Video (YouTube Link)</option>
                                <option value="pdf">E-Book (PDF)</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small">Thumbnail (Gambar Sampul)</label>
                            <input type="file" name="thumbnail" class="form-control">
                        </div>

                        <div class="col-12" id="contentField">
                            <label class="form-label fw-bold small">Isi Artikel</label>
                            <textarea name="content" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="col-12 d-none" id="videoField">
                            <label class="form-label fw-bold small">Link URL Video</label>
                            <input type="url" name="video_url" class="form-control"
                                placeholder="https://youtube.com/watch?v=...">
                        </div>
                        <div class="col-12 d-none" id="pdfField">
                            <label class="form-label fw-bold small">Link Buku Digital (Google Drive/Lainnya)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                                <input type="url" name="pdf_url" class="form-control"
                                    placeholder="https://drive.google.com/file/d/...">
                            </div>
                            <small class="text-muted">Pastikan akses link sudah diset ke "Public/Anyone with link".</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary px-4">Terbitkan Konten</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('categorySelect').addEventListener('change', function() {
            const val = this.value;
            document.getElementById('contentField').classList.toggle('d-none', val !== 'artikel');
            document.getElementById('videoField').classList.toggle('d-none', val !== 'video');
            document.getElementById('pdfField').classList.toggle('d-none', val !== 'pdf');
        });
    </script>
@endsection
