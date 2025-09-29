<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pelaporan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $pelaporans = Pelaporan::all();

        $pengaduans = Pengaduan::all();

        return view('riwayat.admin.index', compact('pelaporans', 'pengaduans'));
    }

    public function showPelaporan($id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        return view('riwayat.admin.show-pelaporan', compact('pelaporan'));
    }

    public function showPengaduan($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('riwayat.admin.show-pengaduan', compact('pengaduan'));
    }

    public function updatePelaporanStatus(Request $request, $id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->update($request->only('status'));
        return redirect()->route('admin.riwayat.showPelaporan', $id)->with('success', 'Status updated successfully.');
    }

    public function updatePengaduanStatus(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update($request->only('status'));
        return redirect()->route('admin.riwayat.showPengaduan', $id)->with('success', 'Status updated successfully.');
    }
}
