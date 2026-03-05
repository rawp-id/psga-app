@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Pusat Edukasi & Literasi</h2>
            <p class="text-muted">Temukan berbagai materi, video, dan buku digital untuk mendukung kesadaran bersama.</p>

            <div class="d-flex justify-content-center gap-2 mt-4">
                <a href="{{ route('education.index', ['category' => 'all']) }}"
                    class="btn {{ request('category') == 'all' || !request('category') ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 shadow-sm">Semua</a>
                <a href="{{ route('education.index', ['category' => 'artikel']) }}"
                    class="btn {{ request('category') == 'artikel' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 shadow-sm">Artikel</a>
                <a href="{{ route('education.index', ['category' => 'video']) }}"
                    class="btn {{ request('category') == 'video' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 shadow-sm">Video</a>
                <a href="{{ route('education.index', ['category' => 'pdf']) }}"
                    class="btn {{ request('category') == 'pdf' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 shadow-sm">Buku
                    Digital</a>
            </div>
        </div>

        <div class="row g-4">
            @forelse($educations as $edu)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-up"
                        style="border-radius: 20px; transition: all 0.3s ease;">
                        <div class="position-relative">
                            @if ($edu->thumbnail)
                                <img src="{{ asset('storage/' . $edu->thumbnail) }}" class="card-img-top"
                                    style="border-radius: 20px 20px 0 0; height: 200px; object-fit: cover;">
                            @else
                                {{-- Icon Placeholder jika thumbnail kosong --}}
                                <div class="d-flex align-items-center justify-content-center bg-light border-bottom"
                                    style="border-radius: 20px 20px 0 0; height: 200px;">
                                    @php
                                        $icon =
                                            [
                                                'artikel' => 'bi-file-earmark-richtext text-info',
                                                'video' => 'bi-play-circle-fill text-danger',
                                                'pdf' => 'bi-book-half text-warning',
                                            ][$edu->category] ?? 'bi-journal-bookmark text-primary';
                                    @endphp
                                    <i class="bi {{ $icon }}" style="font-size: 4.5rem; opacity: 0.6;"></i>
                                </div>
                            @endif

                            <span
                                class="position-absolute top-0 end-0 m-3 badge {{ $edu->category == 'video' ? 'bg-danger' : ($edu->category == 'pdf' ? 'bg-warning text-dark' : 'bg-info') }} px-3 py-2 shadow-sm">
                                <i
                                    class="bi {{ $edu->category == 'video' ? 'bi-play-fill' : ($edu->category == 'pdf' ? 'bi-file-earmark-pdf' : 'bi-card-text') }} me-1"></i>
                                {{ strtoupper($edu->category) }}
                            </span>
                        </div>

                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="fw-bold mb-2 text-dark">{{ Str::limit($edu->title, 50) }}</h5>
                            <p class="text-muted small mb-4 flex-grow-1">
                                {{ Str::limit(strip_tags($edu->content), 90) }}
                            </p>

                            {{-- Semua diarahkan ke route SHOW --}}
                            <a href="{{ route('education.show', $edu->slug) }}"
                                class="btn btn-dark w-100 rounded-pill py-2 shadow-sm">
                                Lihat Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-light d-inline-block p-4 rounded-circle mb-3">
                        <i class="bi bi-journal-x fs-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted">Belum ada konten di kategori ini.</h5>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $educations->links() }}
        </div>
    </div>

    <style>
        .hover-up:hover {
            transform: translateY(-10px);
            shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .card {
            overflow: hidden;
        }

        .btn-dark {
            background-color: #2b2d42;
            border: none;
        }

        .btn-dark:hover {
            background-color: #1a1c2c;
        }
    </style>
@endsection
