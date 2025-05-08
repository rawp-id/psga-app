@extends('layanan.app')
@section('layanan')
    <div class="card card-layout borderless shadow" style="border-radius: 15px;">
        <div class="card-header" style="background-color: transparent;">
            <div class="row">
                <div class="col d-flex justify-content-start align-items-center ms-2" style="margin-left: -10px;">
                    <div class="d-flex flex-column">
                        <span class="fw-semibold fs-5">Formulir Pelaporan</span>
                        <span class="fw-lighe" style="font-size: 12px;">Layanan Pengaduan</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body scroll-vertical">
            <form action="#" method="post">
                <div class="container">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header text-center">
                                <h6 class="mb-0">Jenis Pelaporan <span class="text-danger">*</span></h6>
                            </div>
                            <div class="card-body">
                                {{-- <label for="report_type" class="form-label">Jenis Pelaporan <span
                                        class="text-danger">*</span></label> --}}
                                <select class="form-select" id="report_type" name="report_type" required>
                                    <option value="">Pilih jenis pelaporan</option>
                                    <option value="Intoleran">Intoleran</option>
                                    <option value="Pelecehan/Kekerasan Seksual">Pelecehan/Kekerasan Seksual</option>
                                    <option value="Perundungan">Perundungan</option>
                                    <option value="Other">Yang lain...</option>
                                </select>
                            </div>

                            <div class="d-none m-3 mt-1" id="other-report-type-container">
                                {{-- <label for="other_report_type" class="form-label">Jenis Pelaporan <span
                                        class="text-danger">*</span></label> --}}
                                <input type="text" class="form-control" id="other_report_type" name="other_report_type"
                                    placeholder="Ketik Jenis pelaporan lainnya" required>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('report_type').addEventListener('change', function() {
                            const otherReportTypeContainer = document.getElementById('other-report-type-container');
                            if (this.value === 'Other') {
                                otherReportTypeContainer.classList.remove('d-none');
                            } else {
                                otherReportTypeContainer.classList.add('d-none');
                            }
                        });
                    </script>
                    {{-- <h5 class="mb-4 mt-5 text-center">Identitas Pelaku (Jika Diketahui)</h5> --}}

                    <div class="card mb-3">
                        <div class="card-header text-center">
                            <h6 class="mb-0">Identitas Pelaku (Jika Diketahui)</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="perpetrator_name" class="form-label">Nama Pelaku (jika diketahui)</label>
                                <input type="text" class="form-control" id="perpetrator_name" name="perpetrator_name"
                                    required>
                            </div>
                            <div class="mb-1">
                                <label for="perpetrator_position" class="form-label">Jabatan posisi pelaku di kampus/non
                                    kampus (jika diketahui)</label>
                                <input type="text" class="form-control" id="perpetrator_position"
                                    name="perpetrator_position" required>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header text-center">
                            <h6 class="mb-0">Detail Pelaporan</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="incident_location" class="form-label">Lokasi atau tempat kejadian kekerasan
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="incident_location" name="incident_location"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="incident_location" class="form-label">Detail Lokasi</label>

                                <div class="card">
                                    <div class="card-body">
                                        <div id="search-container" class="dropdown">
                                            <input type="text" class="form-control" id="search-input"
                                                placeholder="Cari lokasi..." data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            <ul id="suggestions" class="dropdown-menu w-100"></ul>
                                        </div>
                                        <div id="map" class="border mt-3" style="height: 250px;"></div>

                                        <input type="text" class="form-control" id="latitude" hidden>
                                        <input type="text" class="form-control" id="longitude" hidden>

                                        <a id="update-location" class="btn btn-primary mt-3">Update Lokasi Saya</a>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // Initialize the map
                                const map = L.map('map').setView([0, 0], 18); // Default center
                                let userMarker;
                                let selectedMarker; // Marker for selected location

                                // Add OpenStreetMap tiles
                                L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                    maxZoom: 20,
                                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                                }).addTo(map);

                                // Function to update the user's current location
                                function updateCurrentLocation() {
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(
                                            (position) => {
                                                const userLat = position.coords.latitude;
                                                const userLng = position.coords.longitude;

                                                // Set map view to the current location
                                                map.setView([userLat, userLng], 18);

                                                // Add or update marker for user's location
                                                if (userMarker) {
                                                    userMarker.setLatLng([userLat, userLng]);
                                                } else {
                                                    userMarker = L.marker([userLat, userLng]).addTo(map);
                                                }

                                                userMarker.bindPopup("<b>Lokasi Anda Saat Ini</b>").openPopup();

                                                // Update latitude and longitude inputs
                                                document.getElementById('latitude').value = userLat;
                                                document.getElementById('longitude').value = userLng;
                                            },
                                            (error) => {
                                                console.error("Error getting location:", error.message);
                                                alert("Tidak dapat mengambil lokasi Anda.");
                                            }
                                        );
                                    } else {
                                        alert("Geolocation tidak didukung oleh browser Anda.");
                                    }
                                }

                                // Update location on page load
                                updateCurrentLocation();

                                // Add event listener for "Update Location" button
                                document.getElementById('update-location').addEventListener('click', updateCurrentLocation);

                                // Search functionality with suggestions
                                const searchInput = document.getElementById('search-input');
                                const suggestions = document.getElementById('suggestions');

                                searchInput.addEventListener('input', () => {
                                    const query = searchInput.value;

                                    if (query.length < 3) {
                                        suggestions.innerHTML = '';
                                        return;
                                    }

                                    // Fetch suggestions from Nominatim API
                                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
                                        .then((response) => response.json())
                                        .then((data) => {
                                            // Clear previous suggestions
                                            suggestions.innerHTML = '';

                                            if (data.length === 0) {
                                                const noResultItem = document.createElement('li');
                                                noResultItem.textContent = 'Hasil tidak ditemukan';
                                                noResultItem.className = 'dropdown-item text-muted';
                                                suggestions.appendChild(noResultItem);
                                                return;
                                            }

                                            // Populate suggestions
                                            data.forEach((place) => {
                                                const suggestion = document.createElement('li');
                                                suggestion.className = 'dropdown-item';
                                                suggestion.textContent = place.display_name;
                                                suggestion.dataset.lat = place.lat;
                                                suggestion.dataset.lon = place.lon;

                                                // Click event to select a suggestion
                                                suggestion.addEventListener('click', () => {
                                                    const {
                                                        lat,
                                                        lon
                                                    } = suggestion.dataset;

                                                    // Set map view to the selected location
                                                    map.setView([lat, lon], 18);

                                                    // Add a marker for the selected location
                                                    if (selectedMarker) {
                                                        selectedMarker.setLatLng([lat, lon]);
                                                    } else {
                                                        selectedMarker = L.marker([lat, lon]).addTo(map);
                                                    }
                                                    selectedMarker.bindPopup(`<b>${place.display_name}</b>`)
                                                        .openPopup();

                                                    // Update latitude and longitude inputs
                                                    document.getElementById('latitude').value = lat;
                                                    document.getElementById('longitude').value = lon;

                                                    // Clear suggestions and update input
                                                    suggestions.innerHTML = '';
                                                    searchInput.value = place.display_name;
                                                });

                                                suggestions.appendChild(suggestion);
                                            });
                                        })
                                        .catch((error) => {
                                            console.error("Error fetching suggestions:", error);
                                            const errorItem = document.createElement('li');
                                            errorItem.textContent = 'Gagal mengambil data';
                                            errorItem.className = 'dropdown-item text-danger';
                                            suggestions.appendChild(errorItem);
                                        });
                                });

                                // Close dropdown if clicked outside
                                document.addEventListener('click', (event) => {
                                    if (!document.getElementById('search-container').contains(event.target)) {
                                        suggestions.innerHTML = '';
                                    }
                                });

                                // Allow users to select a point on the map
                                map.on('click', (event) => {
                                    const lat = event.latlng.lat;
                                    const lon = event.latlng.lng;

                                    // Update or add a marker on map click
                                    if (selectedMarker) {
                                        selectedMarker.setLatLng([lat, lon]);
                                    } else {
                                        selectedMarker = L.marker([lat, lon]).addTo(map);
                                    }

                                    selectedMarker.bindPopup(`<b>Lokasi yang Dipilih</b>`)
                                        .openPopup();

                                    // Update latitude and longitude inputs
                                    document.getElementById('latitude').value = lat;
                                    document.getElementById('longitude').value = lon;
                                });
                            </script>

                            <div class="mb-3">
                                <label for="incident_description" class="form-label">Deskripsikan secara singkat kronologi
                                    kejadian <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="incident_description" name="incident_description" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="additional_data" class="form-label">Data Lain yang Diperlukan</label>
                                <textarea class="form-control" id="additional_data" name="additional_data"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Bukti File yang Diperlukan</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                        </div>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="follow_up_contact" class="form-label">Kontak untuk Tindak Lanjut (Jika Anda
                            Ingin Mendapatkan Tindak Lanjut) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="follow_up_contact" name="follow_up_contact" required>
                    </div> --}}

                    {{-- <script>
                        // Initialize the map
                        const map = L.map('map').setView([0, 0], 18); // Default center
                        let userMarker;

                        // Add OpenStreetMap tiles
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '© OpenStreetMap contributors'
                        }).addTo(map);

                        // Function to update the user's current location
                        function updateCurrentLocation() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(
                                    (position) => {
                                        const userLat = position.coords.latitude;
                                        const userLng = position.coords.longitude;

                                        // Set map view to the current location
                                        map.setView([userLat, userLng], 18);

                                        // Add or update marker for user's location
                                        if (userMarker) {
                                            userMarker.setLatLng([userLat, userLng]);
                                        } else {
                                            userMarker = L.marker([userLat, userLng]).addTo(map);
                                        }

                                        userMarker.bindPopup("<b>Your Current Location</b>").openPopup();
                                    },
                                    (error) => {
                                        console.error("Error getting location:", error.message);
                                        alert("Unable to retrieve your location.");
                                    }
                                );
                            } else {
                                alert("Geolocation is not supported by your browser.");
                            }
                        }

                        // Update location on page load
                        updateCurrentLocation();

                        // Add event listener for "Update Location" button
                        document.getElementById('update-location').addEventListener('click', updateCurrentLocation);

                        // Search functionality with suggestions
                        const searchInput = document.getElementById('search-input');
                        const suggestions = document.getElementById('suggestions');

                        searchInput.addEventListener('input', () => {
                            const query = searchInput.value;

                            if (query.length < 3) {
                                suggestions.innerHTML = '';
                                return;
                            }

                            // Fetch suggestions from Nominatim API
                            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
                                .then((response) => response.json())
                                .then((data) => {
                                    // Clear previous suggestions
                                    suggestions.innerHTML = '';

                                    if (data.length === 0) {
                                        suggestions.innerHTML = '<div>No results found</div>';
                                        return;
                                    }

                                    // Populate suggestions
                                    data.forEach((place) => {
                                        const suggestion = document.createElement('div');
                                        suggestion.textContent = place.display_name;
                                        suggestion.dataset.lat = place.lat;
                                        suggestion.dataset.lon = place.lon;

                                        // Click event to select a suggestion
                                        suggestion.addEventListener('click', () => {
                                            const {
                                                lat,
                                                lon
                                            } = suggestion.dataset;

                                            // Set map view to the selected location
                                            map.setView([lat, lon], 13);

                                            // Add a marker for the selected location
                                            const searchMarker = L.marker([lat, lon]).addTo(map);
                                            searchMarker.bindPopup(`<b>${place.display_name}</b>`).openPopup();

                                            // Clear suggestions
                                            suggestions.innerHTML = '';
                                            searchInput.value = place.display_name;
                                        });

                                        suggestions.appendChild(suggestion);
                                    });
                                })
                                .catch((error) => {
                                    console.error("Error fetching suggestions:", error);
                                    suggestions.innerHTML = '<div>Error fetching results</div>';
                                });
                        });

                        // Hide suggestions on outside click
                        document.addEventListener('click', (event) => {
                            if (!document.getElementById('search-container').contains(event.target)) {
                                suggestions.innerHTML = '';
                            }
                        });
                    </script> --}}
            </form>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-outline-secondary w-100 mt-3 mb-3">Submit</button>
    </div>
    </div>
@endsection
