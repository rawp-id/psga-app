@extends('layanan.app')

@section('layanan')
    <form action="{{ route('pengaduans.store') }}" method="post" enctype="multipart/form-data" id="complaintForm">
        @csrf
        <div class="card shadow-sm mb-5"
            style="border-radius: 20px; border: 2px solid #e2e8f0 !important; border-top: 8px solid #296eff !important;">

            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm"
                        style="width: 50px; height: 50px; flex-shrink: 0; border: 2px solid rgba(41, 110, 255, 0.2);">
                        <i class="fa-solid fa-bullhorn fs-4"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">Formulir Pengaduan</h4>
                        <p class="text-muted mb-0" style="font-size: 13px;">Layanan Saksi / Pihak Ketiga • PSGA UIN Malang</p>
                    </div>
                </div>
            </div>

            <div class="card-body px-4">
                <div class="alert bg-light border-0 mb-4" style="border-radius: 12px;">
                    <p class="small text-muted mb-0">
                        <i class="fa-solid fa-circle-info text-primary me-2"></i>
                        Pengaduan ini disampaikan oleh pihak korban. Kami menjamin kerahasiaan identitas Anda sebagai pelapor.
                    </p>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold mb-3 text-dark">
                        <i class="fa-solid fa-user-secret me-2 text-primary"></i>Identitas Pelaku (Jika Diketahui)
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Nama Pelaku</label>
                            <input type="text" class="form-control border-2" name="perpetrator_name"
                                placeholder="Nama lengkap pelaku" style="border-radius: 10px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Jabatan / Status</label>
                            <input type="text" class="form-control border-2" name="perpetrator_position"
                                placeholder="Contoh: Mahasiswa, Staff, Dosen" style="border-radius: 10px;">
                        </div>
                    </div>
                </div>

                <hr class="my-4 opacity-50">

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">
                        <i class="fa-solid fa-location-dot me-2 text-primary"></i>Lokasi Kejadian <span class="text-danger">*</span>
                    </label>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Nama Ruangan / Gedung</label>
                        <input type="text" class="form-control border-2" name="incident_location"
                            placeholder="Contoh: Perpustakaan Lantai 2" required style="border-radius: 10px;">
                    </div>

                    <div class="p-2 border-2 rounded-4 bg-light" style="border: 2px solid #e2e8f0 !important;">
                        <div id="search-container" class="dropdown mb-2">
                            <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                                <span class="input-group-text bg-white border-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input type="text" class="form-control border-0" id="search-input"
                                    placeholder="Cari lokasi di peta..." autocomplete="off">
                            </div>
                            <ul id="suggestions" class="dropdown-menu w-100 shadow-lg border-0 mt-1"
                                style="max-height: 250px; overflow-y: auto; border-radius: 12px;"></ul>
                        </div>

                        <div id="map" class="rounded-3 shadow-sm"
                            style="height: 300px; width: 100%; z-index: 1; background: #fff;"></div>

                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">

                        <button type="button" id="update-location"
                            class="btn btn-sm btn-white mt-2 w-100 py-2 fw-bold border-2"
                            style="border-radius: 10px; border: 2px solid #dee2e6;">
                            <i class="fa-solid fa-crosshairs me-2 text-primary"></i>Gunakan Lokasi Saya Saat Ini
                        </button>
                    </div>
                </div>

                <hr class="my-4 opacity-50">

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">
                        <i class="fa-solid fa-file-lines me-2 text-primary"></i>Detail Kejadian <span class="text-danger">*</span>
                    </label>
                    <div class="mb-3">
                        <textarea class="form-control border-2" name="incident_description" rows="5"
                            placeholder="Ceritakan kronologi kejadian yang Anda ketahui secara detail..." 
                            required style="border-radius: 12px;"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Data Tambahan (Opsional)</label>
                        <textarea class="form-control border-2" name="additional_data" rows="2"
                            placeholder="Informasi tambahan lainnya..." style="border-radius: 12px;"></textarea>
                    </div>

                    <div>
                        <label class="form-label fw-semibold small text-muted">Unggah Bukti (Opsional)</label>
                        <input class="form-control border-2" type="file" id="formFile" name="formFile"
                            accept="image/*,application/pdf" style="border-radius: 10px;">

                        <div id="file-preview-container" class="mt-3 d-none text-center">
                            <div class="position-relative d-inline-block">
                                <img id="image-preview" src="#" alt="Preview" class="img-thumbnail d-none"
                                    style="max-height: 150px; border-radius: 12px;">
                                <div id="pdf-preview" class="alert alert-info d-none mb-0 small py-2"
                                    style="border-radius: 10px;">
                                    <i class="fa-solid fa-file-pdf me-2 text-danger"></i><span id="pdf-name"></span>
                                </div>
                                <button type="button" id="remove-file"
                                    class="btn btn-danger btn-sm position-absolute top-0 start-100 translate-middle rounded-circle shadow">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-transparent border-0 p-4">
                <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm py-2"
                    style="border-radius: 15px; border: none; background: linear-gradient(45deg, #296eff, #6a11cb);">
                    Kirim Pengaduan
                </button>
            </div>
        </div>
    </form>

    <style>
        #suggestions .dropdown-item { padding: 12px; border-bottom: 1px solid #f1f5f9; cursor: pointer; }
        #suggestions .dropdown-item:hover { background-color: #f8fafc; }
        @media (max-width: 576px) { .card-body, .card-header { padding: 1.25rem !important; } }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- 1. MAP INITIALIZATION ---
            const initialLat = -7.9523; // Default UIN Malang
            const initialLng = 112.6078;
            const map = L.map('map').setView([initialLat, initialLng], 17);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);

            function updateCoords(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }
            updateCoords(initialLat, initialLng);

            marker.on('dragend', (e) => updateCoords(e.target.getLatLng().lat, e.target.getLatLng().lng));
            map.on('click', (e) => {
                marker.setLatLng(e.latlng);
                updateCoords(e.latlng.lat, e.latlng.lng);
            });

            // --- 2. SEARCH LOGIC (Nominatim) ---
            const searchInput = document.getElementById('search-input');
            const suggestionsList = document.getElementById('suggestions');
            let debounceTimer;

            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                const query = this.value;
                if (query.length < 3) {
                    suggestionsList.innerHTML = '';
                    suggestionsList.classList.remove('show');
                    return;
                }

                debounceTimer = setTimeout(() => {
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5`)
                        .then(res => res.json())
                        .then(data => {
                            suggestionsList.innerHTML = '';
                            if (data.length > 0) {
                                suggestionsList.classList.add('show');
                                data.forEach(place => {
                                    const li = document.createElement('li');
                                    li.className = 'dropdown-item';
                                    li.innerHTML = `<i class="fa-solid fa-location-dot me-2 text-muted"></i>${place.display_name}`;
                                    li.onclick = () => {
                                        const lat = parseFloat(place.lat);
                                        const lon = parseFloat(place.lon);
                                        map.setView([lat, lon], 18);
                                        marker.setLatLng([lat, lon]);
                                        updateCoords(lat, lon);
                                        searchInput.value = place.display_name;
                                        suggestionsList.classList.remove('show');
                                    };
                                    suggestionsList.appendChild(li);
                                });
                            }
                        });
                }, 500);
            });

            // --- 3. GEOLOCATION ---
            document.getElementById('update-location').addEventListener('click', function() {
                if (navigator.geolocation) {
                    this.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Mencari Lokasi...';
                    navigator.geolocation.getCurrentPosition(pos => {
                        const lat = pos.coords.latitude;
                        const lon = pos.coords.longitude;
                        map.setView([lat, lon], 18);
                        marker.setLatLng([lat, lon]);
                        updateCoords(lat, lon);
                        this.innerHTML = '<i class="fa-solid fa-crosshairs me-2"></i>Gunakan Lokasi Saya Saat Ini';
                    }, () => {
                        alert("Gagal mengambil lokasi. Pastikan GPS aktif.");
                        this.innerHTML = '<i class="fa-solid fa-crosshairs me-2"></i>Gunakan Lokasi Saya Saat Ini';
                    });
                }
            });

            // --- 4. FILE PREVIEW ---
            const fileInput = document.getElementById('formFile');
            const previewContainer = document.getElementById('file-preview-container');
            
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    previewContainer.classList.remove('d-none');
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            document.getElementById('image-preview').src = e.target.result;
                            document.getElementById('image-preview').classList.remove('d-none');
                            document.getElementById('pdf-preview').classList.add('d-none');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        document.getElementById('pdf-name').textContent = file.name;
                        document.getElementById('pdf-preview').classList.remove('d-none');
                        document.getElementById('image-preview').classList.add('d-none');
                    }
                }
            });

            document.getElementById('remove-file').addEventListener('click', () => {
                fileInput.value = '';
                previewContainer.classList.add('d-none');
            });

            // Invalidate map size to fix grey tiles issue
            setTimeout(() => map.invalidateSize(), 500);
        });
    </script>
@endsection