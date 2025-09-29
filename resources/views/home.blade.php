@extends('layouts.app')
@section('content')
    <div class="card card-layout borderless shadow" style="border-radius: 15px;">
        <div class="card-body">
            <div class="desktop" id="iframe-container" style="position: relative; width: 100%; height: 100%;">
                <!-- Placeholder loading -->
                <div id="loading"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #ffffff; z-index: 10;">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <!-- Iframe -->
                <iframe src="https://psga.uin-malang.ac.id/" frameborder="0" width="100%" height="100%"
                    onload="document.getElementById('loading').style.display='none';">
                </iframe>
            </div>
            <div class="mobile">
                <div class="text-center p-4">
                    <h5>Selamat datang di aplikasi PSGA!</h5>
                    <p>Silakan klik tombol di bawah untuk melakukan pelaporan.</p>
                    <a href="{{ route('layanan.index') }}" class="btn btn-primary mt-2">Menuju Halaman Pelaporan</a>
                </div>
            </div>
        </div>
    </div>
@endsection
