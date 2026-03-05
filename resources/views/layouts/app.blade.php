<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PSGA MALIKI | Aman & Terjaga</title>
    <link rel="icon" href="{{ asset('/images/psga-logo.jpg') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        :root {
            --psga-blue: #296eff;
            --psga-gradient: linear-gradient(135deg, #296eff 0%, #1e40af 100%);
            --body-bg: #f8fafc;
        }

        body,
        html {
            height: 100vh;
            overflow: hidden;
            /* Lock root scroll on Desktop */
            background-color: var(--body-bg);
            font-family: 'Poppins', sans-serif;
        }

        @media (max-width: 991.98px) {

            body,
            html {
                overflow: auto;
            }
        }

        /* Top Nav Styling */
        .top-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 0.8rem 1.5rem;
            border-radius: 20px;
            margin: 15px auto;
            width: 96vw;
            border: 1px solid rgba(41, 110, 255, 0.1);
        }

        .logo-text {
            background: var(--psga-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Sidebar Styling */
        .sidebar-card {
            background: white;
            border-radius: 24px;
            padding: 1.5rem 0.8rem;
            height: calc(100vh - 140px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Nav Link Tone Fix */
        .nav-link {
            color: #64748b;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 15px;
            transition: 0.3s;
            text-align: center;
        }

        .nav-link:hover {
            background: #eff6ff;
            color: var(--psga-blue);
        }

        .nav-link.active {
            background: var(--psga-gradient);
            color: white !important;
            box-shadow: 0 8px 15px rgba(41, 110, 255, 0.25);
        }

        /* Main Content Card */
        .main-content-card {
            background: white;
            border-radius: 24px;
            height: calc(100vh - 140px);
            overflow-y: auto;
            scrollbar-width: thin;
        }

        .main-content-card::-webkit-scrollbar {
            width: 5px;
        }

        .main-content-card::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        /* Offcanvas Menu */
        .offcanvas-nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 20px;
            border-radius: 12px;
            color: #475569;
            text-decoration: none;
            transition: 0.3s;
        }

        .offcanvas-nav-link.active {
            background: var(--psga-gradient);
            color: white;
        }

        /* Mencegah menu terpotong oleh responsive table */
        .table-responsive {
            overflow: visible !important;
        }

        /* Mempercantik tampilan dropdown saat hover */
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: var(--psga-blue);
        }

        .dropdown-item:active {
            background-color: var(--psga-blue);
        }
    </style>
</head>

<body>
    <header class="top-nav shadow-sm d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn d-lg-none border-0 p-0 me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasMenu">
                <i class="bi bi-list fs-2 text-primary"></i>
            </button>

            <a href="/" class="text-decoration-none d-flex align-items-center gap-3">
                <img src="{{ asset('/images/psga-logo.jpg') }}" width="45" height="45"
                    class="rounded-circle shadow-sm">
                <div class="d-none d-lg-block">
                    <h5 class="fw-bold mb-0 logo-text">PSGA MALIKI</h5>
                    <small class="text-muted" style="font-size: 10px;">Safe Space & Reporting Center</small>
                </div>
            </a>
        </div>

        <div>
            @auth
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                <button class="btn btn-light text-danger fw-medium border-0 px-3" style="border-radius: 10px;"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="d-none d-md-inline me-2">Keluar</span><i class="fa-solid fa-power-off"></i>
                </button>
            @endauth
        </div>
    </header>

    <div class="container-fluid px-4">
        <div class="row g-4">
            <div class="col-lg-1 d-none d-lg-block">
                <div class="sidebar-card shadow-sm">
                    <nav class="nav flex-column">
                        <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                            data-bs-toggle="tooltip" title="Beranda">
                            <i class="fa-solid fa-house"></i>
                        </a>

                        <a href="/layanan" class="nav-link {{ request()->is('layanan*') ? 'active' : '' }}"
                            data-bs-toggle="tooltip" title="Buat Laporan">
                            <i class="fa-solid fa-pen-nib"></i>
                        </a>

                        <a href="/riwayat" class="nav-link {{ request()->is('riwayat*') ? 'active' : '' }}"
                            data-bs-toggle="tooltip" title="Riwayat">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </a>

                        @if (Auth::check() && Auth::user()->is_admin == 1)
                            <hr class="my-2 opacity-25">

                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                data-bs-toggle="tooltip" title="Dashboard">
                                <i class="fa-solid fa-chart-line"></i>
                            </a>

                            <a href="{{ route('admin.users.index') }}"
                                class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                                data-bs-toggle="tooltip" title="Manajemen User">
                                <i class="fa-solid fa-user-shield"></i>
                            </a>

                            <a href="{{ route('admin.riwayat.index') }}"
                                class="nav-link {{ request()->is('admin/riwayat*') ? 'active' : '' }}"
                                data-bs-toggle="tooltip" title="Arsip Laporan">
                                <i class="fa-solid fa-box-archive"></i>
                            </a>

                            <a href="{{ route('admin.konsultasi-pelaporans.index') }}"
                                class="nav-link {{ request()->is('admin/konsultasi-pelaporans*') ? 'active' : '' }}"
                                data-bs-toggle="tooltip" title="Konsultasi Pelaporan">
                                <i class="fa-solid fa-hospital-user"></i>
                            </a>

                            <a href="{{ route('admin.konsultasi-pengaduans.index') }}"
                                class="nav-link {{ request()->is('admin/konsultasi-pengaduans*') ? 'active' : '' }}"
                                data-bs-toggle="tooltip" title="Konsultasi Pengaduan">
                                <i class="fa-solid fa-headset"></i> </a>
                        @endif
                    </nav>

                    <a href="{{ route('profile.index') }}"
                        class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" data-bs-toggle="tooltip"
                        title="Profil">
                        <i class="fa-solid fa-user"></i>
                    </a>

                </div>
            </div>

            <div class="col-12 col-lg-11">
                <div class="main-content-card shadow-sm p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu">
        <div class="offcanvas-header pt-4">
            <h5 class="fw-bold logo-text mb-0">MENU NAVIGASI</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column gap-2">
                <a href="/" class="offcanvas-nav-link {{ request()->is('/') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i> Beranda
                </a>
                <a href="/layanan" class="offcanvas-nav-link {{ request()->is('layanan*') ? 'active' : '' }}">
                    <i class="fa-solid fa-pen-nib"></i> Buat Laporan
                </a>
                <a href="/riwayat" class="offcanvas-nav-link {{ request()->is('riwayat*') ? 'active' : '' }}">
                    <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Laporan
                </a>

                @if (Auth::check() && Auth::user()->is_admin == 1)
                    <hr>
                    <a href="{{ route('admin.dashboard') }}" class="offcanvas-nav-link"
                        class="offcanvas-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge"></i> Dashboard Admin
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                        class="offcanvas-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-users-gear"></i> Manajemen User
                    </a>

                    <a href="{{ route('admin.riwayat.index') }}"
                        class="offcanvas-nav-link {{ request()->is('admin/riwayat*') ? 'active' : '' }}">
                        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Laporan
                    </a>

                    <a href="{{ route('admin.konsultasi-pelaporans.index') }}"
                        class="offcanvas-nav-link {{ request()->is('admin/konsultasi*') ? 'active' : '' }}">
                        <i class="fa-solid fa-comment-dots"></i> Data Konsultasi
                    </a>

                    <a href="{{ route('admin.konsultasi-pengaduans.index') }}"
                        class="offcanvas-nav-link {{ request()->is('admin/konsultasi*') ? 'active' : '' }}">
                        <i class="fa-solid fa-comment-dots"></i> Data Konsultasi
                    </a>
                @endif

                <hr>

                <a href="{{ route('profile.index') }}"
                    class="offcanvas-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user"></i> Profil
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        // Tooltips & Active States
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function(el) {
                return new bootstrap.Tooltip(el)
            });

            // const currentPath = window.location.pathname;
            // document.querySelectorAll('.nav-link, .offcanvas-nav-link').forEach(link => {
            //     if (link.getAttribute('href') === currentPath) {
            //         link.classList.add('active');
            //     } else {
            //         link.classList.remove('active');
            //     }
            // });
        });
    </script>
</body>

</html>
