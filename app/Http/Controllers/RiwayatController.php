<?php

namespace App\Http\Controllers;

use App\Models\Pelaporan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $pelaporans = Pelaporan::with('user', 'konsultasi')->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $pengaduans = Pengaduan::with('user', 'konsultasi')->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('riwayat.index', compact('pelaporans', 'pengaduans'));
    }

    public function showPelaporan($id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        return view('riwayat.show-pelaporan', compact('pelaporan'));
    }

    public function showPengaduan($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('riwayat.show-pengaduan', compact('pengaduan'));
    }
}
