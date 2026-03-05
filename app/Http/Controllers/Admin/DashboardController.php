<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi; // Sesuaikan nama model Anda
use App\Models\Pelaporan;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik untuk Card
        $countPengaduanBaru = Pengaduan::where('status', 'pending')->count();
        $countPelaporanBaru = Pelaporan::where('status', 'pending')->count();
        // $countKonsultasiHariIni = Konsultasi::whereDate('jadwal_konsultasi', Carbon::today())->count();
        $totalUser = User::count();

        // Ambil data terbaru dari kedua tabel
        $pengaduans = Pengaduan::with('user')->latest()->take(5)->get();
        $pelaporans = Pelaporan::with('user')->latest()->take(5)->get();

        // Gabungkan dan urutkan ulang berdasarkan tanggal terbaru secara keseluruhan
        $laporanTerbaru = $pengaduans->concat($pelaporans)
            ->sortByDesc('created_at')
            ->take(5); // Ambil 5 teratas setelah digabung

            // dd($laporanTerbaru);

        return view('admin.dashboard', compact(
            'countPengaduanBaru',
            'countPelaporanBaru',
            'totalUser',
            'laporanTerbaru'
        ));
    }
}
