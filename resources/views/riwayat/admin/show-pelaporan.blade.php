@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Detail Pelaporan</h2>
        <div class="card mb-5" style="height: 70dvh; overflow-y: auto;">
            <div class="card-body scroll-vertical">
                <div class="container">
                    <dl class="row">
                        <dt class="col-sm-4">Jenis Pelaporan</dt>
                        <dd class="col-sm-8">{{ $pelaporan->jenis_pelaporan }}</dd>

                        <dt class="col-sm-4">Nama Pelaku</dt>
                        <dd class="col-sm-8">{{ $pelaporan->nama_pelaku ?? '-' }}</dd>

                        <dt class="col-sm-4">Jabatan Pelaku</dt>
                        <dd class="col-sm-8">{{ $pelaporan->jabatan_pelaku ?? '-' }}</dd>

                        <dt class="col-sm-4">Lokasi</dt>
                        <dd class="col-sm-8">{{ $pelaporan->lokasi }}</dd>

                        <dt class="col-sm-4">Detail Lokasi</dt>
                        <dd class="col-sm-8">
                            <div>
                                <strong>Latitude:</strong> {{ $pelaporan->latitude ?? '-' }}<br>
                                <strong>Longitude:</strong> {{ $pelaporan->longitude ?? '-' }}
                            </div>
                            <div id="map" class="border mt-2" style="height: 250px;"></div>
                        </dd>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // Default coordinates if not available
                                const lat = {{ $pelaporan->latitude ?? '0' }};
                                const lng = {{ $pelaporan->longitude ?? '0' }};
                                const map = L.map('map').setView([lat, lng], 18);

                                L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                    maxZoom: 20,
                                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                                }).addTo(map);

                                if (lat && lng && (lat !== 0 || lng !== 0)) {
                                    L.marker([lat, lng]).addTo(map)
                                        .bindPopup('Lokasi Pelaporan').openPopup();
                                }
                            });
                        </script>

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

                        <dt class="col-sm-4">Update Status</dt>
                        <dd class="col-sm-8">
                            <form action="{{ route('admin.riwayat.updatePelaporanStatus', $pelaporan->id) }}"
                                method="POST" class="d-flex align-items-center">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select me-2" style="max-width: 200px;">
                                    <option value="pending" {{ $pelaporan->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="proses" {{ $pelaporan->status == 'proses' ? 'selected' : '' }}>Proses
                                    </option>
                                    <option value="selesai" {{ $pelaporan->status == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </dd>
                    </dl>

                </div>
            </div>
        </div>
    </div>
@endsection
