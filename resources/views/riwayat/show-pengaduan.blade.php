@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Pengaduan</h2>
        <div class="card" style="height: 70dvh; overflow-y: auto;">
            <div class="card-body">
                <h5 class="card-title">Lokasi: {{ $pengaduan->lokasi }}</h5>
                <p><strong>Nama Pelaku:</strong> {{ $pengaduan->nama_pelaku ?? '-' }}</p>
                <p><strong>Jabatan Pelaku:</strong> {{ $pengaduan->jabatan_pelaku ?? '-' }}</p>
                <p><strong>Latitude:</strong> {{ $pengaduan->latitude ?? '-' }}</p>
                <p><strong>Longitude:</strong> {{ $pengaduan->longitude ?? '-' }}</p>
                <p><strong>Deskripsi:</strong> {{ $pengaduan->deskripsi }}</p>
                <p><strong>Data Pengaduan:</strong> {{ $pengaduan->data_pengaduan ?? '-' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($pengaduan->status) }}</p>
                @if ($pengaduan->file_pengaduan)
                    <p><strong>File Pengaduan:</strong>
                        <a href="{{ asset('storage/' . $pengaduan->file_pengaduan) }}" target="_blank">Lihat File</a>
                    </p>
                @endif
                <p><strong>Dibuat pada:</strong> {{ $pengaduan->created_at->format('d M Y H:i') }}</p>
                <hr>
                <strong>Penjadwalan Konsultasi</strong>
                @if ($pengaduan->konsultasi && $pengaduan->konsultasi->jadwal_konsultasi)
                    <dl class="row mb-0 mt-2">
                        <dt class="col-sm-4">Tanggal Konsultasi</dt>
                        <dd class="col-sm-8">
                            {{ \Carbon\Carbon::parse($pengaduan->konsultasi->jadwal_konsultasi)->format('d-m-Y H:i') }}
                        </dd>
                        <dt class="col-sm-4">Tipe Konsultasi</dt>
                        <dd class="col-sm-8">{{ ucfirst($pengaduan->konsultasi->type_konsultasi) }}</dd>
                        <dt class="col-sm-4">Link Konsultasi</dt>
                        <dd class="col-sm-8">
                            @if($pengaduan->konsultasi->link_konsultasi)
                                <a href="{{ $pengaduan->konsultasi->link_konsultasi }}" target="_blank">Join Link</a>
                            @else
                                -
                            @endif
                        </dd>
                    </dl>
                @else
                    <p class="mb-0 mt-2">Belum ada jadwal konsultasi yang ditetapkan.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
