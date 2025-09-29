@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Detail Pelaporan</h2>
        <div class="card" style="height: 70dvh; overflow-y: auto;">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Jenis Pelaporan</dt>
                    <dd class="col-sm-8">{{ $pelaporan->jenis_pelaporan }}</dd>

                    <dt class="col-sm-4">Nama Pelaku</dt>
                    <dd class="col-sm-8">{{ $pelaporan->nama_pelaku ?? '-' }}</dd>

                    <dt class="col-sm-4">Jabatan Pelaku</dt>
                    <dd class="col-sm-8">{{ $pelaporan->jabatan_pelaku ?? '-' }}</dd>

                    <dt class="col-sm-4">Lokasi</dt>
                    <dd class="col-sm-8">{{ $pelaporan->lokasi }}</dd>

                    <dt class="col-sm-4">Latitude</dt>
                    <dd class="col-sm-8">{{ $pelaporan->latitude ?? '-' }}</dd>

                    <dt class="col-sm-4">Longitude</dt>
                    <dd class="col-sm-8">{{ $pelaporan->longitude ?? '-' }}</dd>

                    <dt class="col-sm-4">Deskripsi</dt>
                    <dd class="col-sm-8">{{ $pelaporan->deskripsi }}</dd>

                    <dt class="col-sm-4">Data Pelaporan</dt>
                    <dd class="col-sm-8">{{ $pelaporan->data_pelaporan ?? '-' }}</dd>

                    <dt class="col-sm-4">File Laporan</dt>
                    <dd class="col-sm-8">
                        @if ($pelaporan->file_laporan)
                            <a href="{{ asset('storage/' . $pelaporan->file_laporan) }}" target="_blank">Download</a>
                        @else
                            -
                        @endif
                    </dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">{{ ucfirst($pelaporan->status) }}</dd>

                    <dt class="col-sm-4">Follow Up Contact</dt>
                    <dd class="col-sm-8">
                        @if ($pelaporan->follow_up_contact)
                            @foreach (json_decode($pelaporan->follow_up_contact) as $contact)
                                <span class="badge bg-info">{{ $contact }}</span>
                            @endforeach
                        @else
                            -
                        @endif
                    </dd>

                    <dt class="col-sm-4">Follow Up Contact Other</dt>
                    <dd class="col-sm-8">{{ $pelaporan->follow_up_contact_other ?? '-' }}</dd>

                    <dt class="col-sm-4">Dibuat Pada</dt>
                    <dd class="col-sm-8">{{ $pelaporan->created_at->format('d-m-Y H:i') }}</dd>
                </dl>
                <hr> 
                <strong>Penjadwalan Konsultasi</strong>
                @if ($pelaporan->konsultasi && $pelaporan->konsultasi->jadwal_konsultasi)
                    <dl class="row mb-0 mt-2">
                        <dt class="col-sm-4">Tanggal Konsultasi</dt>
                        <dd class="col-sm-8">
                            {{ \Carbon\Carbon::parse($pelaporan->konsultasi->jadwal_konsultasi)->format('d-m-Y H:i') }}
                        </dd>
                        <dt class="col-sm-4">Tipe Konsultasi</dt>
                        <dd class="col-sm-8">{{ ucfirst($pelaporan->konsultasi->type_konsultasi) }}</dd>
                        <dt class="col-sm-4">Link Konsultasi</dt>
                        <dd class="col-sm-8">
                            @if($pelaporan->konsultasi->link_konsultasi)
                                <a href="{{ $pelaporan->konsultasi->link_konsultasi }}" target="_blank">Join Link</a>
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
