<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PSGA MALIKI</title>
    <link rel="icon" href="{{ asset('/images/psga-logo.jpg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
        integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    {{-- @vite([]) --}}
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            background-color: #f6f8fc;
            font-family: 'Poppins';
            height: 100vh;
            /* overflow: hidden; */
        }

        @media (max-width: 575.98px) {

            body,
            html {
                overflow: auto;
            }
        }

        .root {
            display: flex;
            justify-content: center;
            align-items: center;
            /*height: 100vh;*/
            /*overflow: hidden;*/
        }

        #map {
            height: 100vh;
            width: 100%;
        }

        .card-layout {
            height: 82vh;
        }

        @media (max-width: 575.98px) {
            .card-layout {
                height: auto;
                /* min-height: 60vh; */
            }
        }

        .borderless {
            border: none;
        }

        .nav-link {
            color: #9f9f9f;
            border-radius: 10px;
            text-decoration: none;
        }

        .nav-link:hover {
            background-color: #296dff78;
            color: #fff;
            border-radius: 10px;
        }

        .nav-link.active {
            background-color: #296eff;
            border-radius: 10px;
            color: #fff;
        }

        .nav-link:focus {
            color: #9f9f9f;
        }

        .nav-link.active:focus {
            color: #fff;
        }

        .nav-link:focus:hover {
            color: #fff;
        }

        .nav-link.active:hover {
            background-color: #296dffcf;
            border-radius: 10px;
        }

        .scroll-vertical {
            overflow-y: auto;
        }

        .step {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: #666;
        }

        .step.active {
            background-color: #0d6efd;
            color: white;
        }

        .line {
            flex: 1;
            height: 2px;
            background-color: #ccc;
            position: relative;
            top: 25px;
            margin-left: 10px;
            margin-right: 10px;
        }

        .line.active {
            background-color: #0d6efd;
        }

        .line.success {
            background-color: green;
        }

        .step-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step-label {
            align-items: center;
            font-size: 12px;
            margin-left: 10px;
            margin-top: 16px;
        }

        .responsive-width {
            max-width: 25vw;
            /* Default untuk perangkat mobile */
        }

        @media (min-width: 576px) {

            /* Tablet (Small devices - 576px ke atas) */
            .responsive-width {
                max-width: 14vw;
            }
        }

        @media (min-width: 992px) {

            /* Desktop (Large devices - 992px ke atas) */
            .responsive-width {
                max-width: 7vw;
            }
        }

        @media (max-width: 991.98px) {
            .desktop {
                display: none !important;
            }

            /* .scroll-vertical {
            overflow-y: visible !important;
            } */
        }

        @media (min-width: 576px) {
            .mobile {
                display: none !important;
            }

            /* .scroll-vertical {
                    overflow-y: auto !important;
                } */
        }
    </style>
</head>

<body>
    <div class="container-fluid root">
        <div class="card shadow borderless mt-3 mb-3" style="height: 10vh; width: 97vw; border-radius: 15px;">
            <div class="container-fluid" style="margin-top: 12px;">
                <div class="row">
                    <div class="col d-flex justify-content-start align-items-center gap-1">
                        <button class="btn mobile" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample" style="border-radius: 100%">
                            <i class="bi bi-list"></i>
                        </button>
                        <a href="/" class="text-decoration-none text-dark d-flex align-items-center gap-2">
                            <img src="{{ asset('/images/psga-logo.jpg') }}" alt="logo" class="border" width="50"
                                style="border-radius: 50px;">
                            <div class="desktop">
                                <div class="d-flex flex-column">
                                    <span class="fs-4 fw-semibold" style="letter-spacing: 2px;">PSGA MALIKI APP</span>
                                    <span class="fw-light" style="font-size: 10px; letter-spacing: 1px;">No more
                                        silence, stop the violence</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center me-2">
                        <div class="desktop">
                            @guest
                                <a href="/login" class="btn btn-outline-secondary me-2" style="border-radius: 12px">
                                    <i class="fa-solid fa-right-to-bracket"></i> Login
                                </a>
                            @endguest
                            @auth
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary" style="border-radius: 12px">
                                        <i class="fa-solid fa-right-to-bracket"></i> Logout
                                    </button>
                                </form>
                            @endauth
                        </div>
                        <div class="mobile">
                            <h3>PSGA APP</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">PSGA MALIKI APPS</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <p>Welcome to PSGA MALIKI APPS</p>
            </div>
            <nav>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="/" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-title="Beranda">
                            <i class="fa-solid fa-house"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/layanan" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-title="Pengaduan">
                            <i class="fa-solid fa-pen"></i> Pengaduan
                        </a>
                    </li>
                    {{-- <li class="nav-item mb-2">
                        <a href="/chat" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-title="Pesan">
                            <i class="fa-solid fa-comment-dots"></i> Pesan
                        </a>
                    </li> --}}
                    <li class="nav-item mb-2">
                        <a href="/riwayat" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-title="Riwayat Pengaduan">
                            <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Pengaduan
                        </a>
                    </li>
                    @if (Auth::check() && Auth::user()->is_admin == 1)
                        {{-- <li class="nav-item mb-2">
                            <a href="/admin" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="right"
                                data-bs-title="Admin Dashboard">
                                <i class="fa-solid fa-user-shield"></i> Admin Dashboard
                            </a>
                        </li> --}}

                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.users.index') }}" class="nav-link" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-title="Kelola Pengguna">
                                <i class="fa-solid fa-users"></i> Kelola Pengguna
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-title="Kelola Role">
                                <i class="fa-solid fa-user-tag"></i> Kelola Role
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.riwayat.index') }}" class="nav-link" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-title="Riwayat Admin">
                                <i class="fa-solid fa-clock"></i> Riwayat Admin
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    <div class="container-fluid root">

        <div class="row w-100">

            <div class="col-12 col-sm-2 col-md-1 responsive-width desktop">
                <div class="card card-layout borderless shadow" style="border-radius: 15px;">
                    <div class="container-fluid text-center">
                        <!-- <a href="#">
                            <img src="./psga-logo.jpg" alt="logo" class="mt-2 border" width="50vh"
                                style="border-radius: 50px;">
                        </a> -->
                        <nav class="mt-3">
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2">
                                    <a href="/" class="nav-link" data-bs-toggle="tooltip"
                                        data-bs-placement="right" data-bs-title="Beranda">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="nav-item mb-2">
                                    <a href="/layanan" class="nav-link" data-bs-toggle="tooltip"
                                        data-bs-placement="right" data-bs-title="Pengaduan">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </li>
                                {{-- <li class="nav-item mb-2">
                                    <a href="/chat" class="nav-link" data-bs-toggle="tooltip"
                                        data-bs-placement="right" data-bs-title="Pesan">
                                        <i class="fa-solid fa-comment-dots"></i>
                                    </a>
                                </li> --}}
                                <li class="nav-item mb-2">
                                    <a href="/riwayat" class="nav-link" data-bs-toggle="tooltip"
                                        data-bs-placement="right" data-bs-title="Riwayat Pengaduan">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                    </a>
                                </li>
                                @if (Auth::check() && Auth::user()->is_admin == 1)
                                    {{-- <li class="nav-item mb-2">
                                        <a href="/admin" class="nav-link" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Admin Dashboard">
                                            <i class="fa-solid fa-user-shield"></i>
                                        </a>
                                    </li> --}}
                                    <li class="nav-item mb-2">
                                        <a href="{{ route('admin.users.index') }}" class="nav-link"
                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                            title="Kelola Pengguna">
                                            <i class="fa-solid fa-users"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item mb-2">
                                        <a href="{{ route('admin.roles.index') }}" class="nav-link"
                                            data-bs-toggle="tooltip" data-bs-placement="right" title="Kelola Role">
                                            <i class="fa-solid fa-user-tag"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item mb-2">
                                        <a href="{{ route('admin.riwayat.index') }}" class="nav-link"
                                            data-bs-toggle="tooltip" data-bs-placement="right" title="Riwayat Admin">
                                            <i class="fa-solid fa-clock"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item mb-2">
                                        <a href="{{ route('admin.konsultasi-pelaporans.index') }}" class="nav-link"
                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                            title="Konsultasi Pelaporan">
                                            <i class="fa-solid fa-comments"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item mb-2">
                                        <a href="{{ route('admin.konsultasi-pengaduans.index') }}" class="nav-link"
                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                            title="Konsultasi Pengaduan">
                                            <i class="fa-solid fa-comment-medical"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <div class="card-body"></div>
                    <div class="card-footer borderless text-center mb-2" style="background-color: transparent;">
                        <a href="#" class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-title="Profile">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col">
                @yield('content')
            </div>

        </div>
    </div>

    <!-- <div class="container-fluid root">
        <div class="card shadow borderless mt-3" style="height: 30px; width: 97vw; border-radius: 15px;">
            <div class="container-fluid text-end">
                <span style="font-size: 13px;">Powered By <a href="https://psga.uin-malang.ac.id/" class="text-dark"
                        style="text-decoration: none;">PSGA</a></span>
            </div>
        </div>
    </div> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen navbar dengan class 'nav-link'
            const navLinks = document.querySelectorAll('.nav-link');

            // Dapatkan URL path saat ini
            const currentPath = window.location.pathname;

            navLinks.forEach(link => {
                // Ambil href dari setiap link
                const linkPath = link.getAttribute('href');

                // Bandingkan path link dengan path saat ini
                if (linkPath === currentPath) {
                    // Tambahkan class 'active' jika cocok
                    link.classList.add('active');
                } else {
                    // Hapus class 'active' jika tidak cocok
                    link.classList.remove('active');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
