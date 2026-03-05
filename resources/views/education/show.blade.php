@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('education.index') }}">Edukasi</a></li>
                    <li class="breadcrumb-item active text-truncate" style="max-width: 250px;">{{ $education->title }}</li>
                </ol>
            </nav>

            <h1 class="fw-bold mb-3 text-dark">{{ $education->title }}</h1>
            <div class="text-muted small mb-4 d-flex align-items-center gap-3">
                <span><i class="bi bi-calendar3 me-1"></i> {{ $education->created_at->format('d M Y') }}</span>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3">{{ ucfirst($education->category) }}</span>
            </div>

            <div class="content-viewer mb-5">
                @if($education->category == 'video')
                    <div class="ratio ratio-16x9 shadow-sm" style="border-radius: 20px; overflow: hidden;">
                        <iframe src="{{ $embedUrl }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>

                @elseif($education->category == 'pdf')
                    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                        <div class="card-body p-0" style="height: 600px;">
                            <iframe src="{{ $education->file_path }}" width="100%" height="100%" style="border-radius: 20px;" allow="autoplay"></iframe>
                        </div>
                        <div class="card-footer bg-white border-0 text-center py-3">
                            <a href="{{ $education->file_path }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill">
                                <i class="bi bi-box-arrow-up-right me-1"></i> Buka di Tab Baru
                            </a>
                        </div>
                    </div>

                @else
                    @if($education->thumbnail)
                        <img src="{{ asset('storage/'.$education->thumbnail) }}" class="img-fluid w-100 mb-4 shadow-sm" style="border-radius: 20px; max-height: 400px; object-fit: cover;">
                    @endif
                    <div class="article-text lh-lg p-3" style="font-size: 1.15rem; color: #333;">
                        {!! nl2br(e($education->content)) !!}
                    </div>
                @endif
            </div>

            @if(($education->category == 'video' || $education->category == 'pdf') && $education->content)
                <div class="card border-0 bg-light rounded-4 mb-5">
                    <div class="card-body p-4">
                        <h6 class="fw-bold">Tentang Materi Ini:</h6>
                        <p class="text-muted mb-0">{{ $education->content }}</p>
                    </div>
                </div>
            @endif

            <hr class="opacity-25">
            <a href="{{ route('education.index') }}" class="btn btn-light rounded-pill px-4">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Katalog
            </a>
        </div>
    </div>
</div>
@endsection