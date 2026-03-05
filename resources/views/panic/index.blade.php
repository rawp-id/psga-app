@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 70vh;">

        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-lightbulb-fill me-2"></i>
            <strong>Fitur Baru:</strong> Mode Darurat kini dilengkapi dengan deteksi lokasi real-time dan notifikasi instan ke Tim Keamanan PSGA.
            {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
        </div>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            <strong>Perhatian:</strong> Fitur ini masih dalam tahap uji coba. Mohon laporkan jika ada kesalahan.
            {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
        </div>
        
        <div class="text-center mb-5">
            <h2 class="fw-bold text-danger"><i class="bi bi-shield-fill-exclamation me-2"></i>Mode Darurat</h2>
            <p class="text-muted">Tahan tombol di bawah selama 3 detik jika Anda dalam bahaya.<br>Lokasi Anda akan dikirim ke
                Tim Keamanan PSGA.</p>
        </div>

        <div class="radar-container position-relative d-flex justify-content-center align-items-center"
            style="width: 250px; height: 250px;">
            <div class="radar-pulse"></div>

            <button id="panic-btn"
                class="btn btn-danger rounded-circle shadow-lg position-relative d-flex flex-column justify-content-center align-items-center"
                style="width: 180px; height: 180px; border: 8px solid #ffccd5; z-index: 10;">
                <i class="bi bi-exclamation-triangle-fill text-white mb-1" style="font-size: 3rem;"></i>
                <span class="fw-bold text-white fs-5 tracking-wide">TEKAN TAHAN</span>
            </button>
        </div>

        <div id="panic-status" class="mt-5 text-center d-none">
            <div class="spinner-border text-danger mb-3" role="status"></div>
            <h5 class="fw-bold text-danger blink-text">Mencari Lokasi & Mengirim Sinyal...</h5>
        </div>

        <div id="panic-success" class="mt-5 text-center d-none">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
            <h4 class="fw-bold mt-3">Sinyal Terkirim!</h4>
            <p class="text-muted">Tim keamanan telah menerima lokasi Anda.<br>Mohon cari tempat yang aman.</p>
        </div>
    </div>

    <style>
        /* Animasi Gelombang Radar */
        .radar-pulse {
            position: absolute;
            width: 180px;
            height: 180px;
            background: rgba(220, 53, 69, 0.5);
            border-radius: 50%;
            animation: pulse 2s infinite ease-out;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(2.5);
                opacity: 0;
            }
        }

        /* Efek tombol saat ditekan */
        .panic-active {
            transform: scale(0.95);
            background-color: #bb2d3b !important;
            border-color: #b02a37 !important;
            transition: all 0.2s;
        }

        .blink-text {
            animation: blink 1s infinite;
        }

        @keyframes blink {
            50% {
                opacity: 0.5;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const panicBtn = document.getElementById('panic-btn');
            const statusDiv = document.getElementById('panic-status');
            const successDiv = document.getElementById('panic-success');
            let pressTimer;
            let isTriggered = false;

            // Fungsi Mulai Menahan Tombol
            function startPress(e) {
                if (isTriggered) return;
                e.preventDefault();
                panicBtn.classList.add('panic-active');

                // Set timer 3 detik
                pressTimer = window.setTimeout(function() {
                    triggerEmergency();
                }, 3000);
            }

            // Fungsi Lepas Tombol
            function cancelPress(e) {
                if (isTriggered) return;
                clearTimeout(pressTimer);
                panicBtn.classList.remove('panic-active');
            }

            // Event Listener untuk Mouse (Desktop) & Touch (Mobile)
            panicBtn.addEventListener('mousedown', startPress);
            panicBtn.addEventListener('mouseup', cancelPress);
            panicBtn.addEventListener('mouseleave', cancelPress);
            panicBtn.addEventListener('touchstart', startPress, {
                passive: false
            });
            panicBtn.addEventListener('touchend', cancelPress);

            // Fungsi Eksekusi Sinyal
            function triggerEmergency() {
                isTriggered = true;
                panicBtn.classList.remove('panic-active');
                panicBtn.disabled = true;
                statusDiv.classList.remove('d-none');

                // Minta Akses GPS
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(sendDataToServer, showError, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    });
                } else {
                    alert("Browser Anda tidak mendukung deteksi lokasi.");
                    statusDiv.classList.add('d-none');
                    isTriggered = false;
                    panicBtn.disabled = false;
                }
            }

            function sendDataToServer(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                // Gunakan Fetch API untuk kirim ke Controller
                fetch("{{ url('/panic/trigger') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json", // TAMBAHKAN INI
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            latitude: lat,
                            longitude: lng
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            statusDiv.classList.add('d-none');
                            successDiv.classList.remove('d-none');
                            document.querySelector('.radar-pulse').style.animation =
                                'pulse 0.5s infinite ease-out'; // Makin cepat
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Koneksi gagal! Segera hubungi nomor darurat secara manual.");
                    });
            }

            function showError(error) {
                alert("Gagal mendapatkan lokasi. Pastikan GPS aktif dan Anda mengizinkan akses lokasi.");
                statusDiv.classList.add('d-none');
                isTriggered = false;
                panicBtn.disabled = false;
            }
        });
    </script>
@endsection
