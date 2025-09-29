@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pengaduan</h2>
    <div class="card" style="height: 70dvh; overflow-y: auto;">
        <div class="card-body">
            <h5 class="card-title">Lokasi: {{ $pengaduan->lokasi }}</h5>
            <p><strong>Nama Pelaku:</strong> {{ $pengaduan->nama_pelaku ?? '-' }}</p>
            <p><strong>Jabatan Pelaku:</strong> {{ $pengaduan->jabatan_pelaku ?? '-' }}</p>
            <dt class="col-sm-4">Detail Lokasi</dt>
            <dd class="col-sm-8">
                <div>
                    <strong>Latitude:</strong> {{ $pengaduan->latitude ?? '-' }}<br>
                    <strong>Longitude:</strong> {{ $pengaduan->longitude ?? '-' }}
                </div>
                <div id="map" class="border mt-2" style="height: 250px;"></div>
            </dd>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Default coordinates if not available
                    const lat = {{ $pengaduan->latitude ?? '0' }};
                    const lng = {{ $pengaduan->longitude ?? '0' }};
                    const map = L.map('map').setView([lat, lng], 18);

                    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    }).addTo(map);

                    if (lat && lng && (lat !== 0 || lng !== 0)) {
                        L.marker([lat, lng]).addTo(map)
                            .bindPopup('Lokasi Pengaduan').openPopup();
                    }
                });
            </script>
            <p><strong>Deskripsi:</strong> {{ $pengaduan->deskripsi }}</p>
            <p><strong>Data Pengaduan:</strong> {{ $pengaduan->data_pengaduan ?? '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($pengaduan->status) }}</p>
            @if($pengaduan->file_pengaduan)
                <p><strong>File Pengaduan:</strong> 
                    <a href="{{ asset('storage/' . $pengaduan->file_pengaduan) }}" target="_blank">Lihat File</a>
                </p>
            @endif
            <p><strong>Dibuat pada:</strong> {{ $pengaduan->created_at->format('d M Y H:i') }}</p>
            <form action="{{ route('admin.riwayat.updatePengaduanStatus', $pengaduan->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="status">Update Status:</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection