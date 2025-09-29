<?php

namespace App\Http\Controllers;

use App\Models\KonsultasiPengaduan;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;

class KonsultasiPengaduanController extends Controller
{
    public function index()
    {
        $konsultasis = KonsultasiPengaduan::with(['pengaduan', 'konsultan'])->latest()->get();
        $pengaduans  = Pengaduan::all();
        $konsultans  = User::all();
        return view('admin.konsultasi_pengaduans.index', compact('konsultasis', 'pengaduans', 'konsultans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id'       => 'required|exists:pengaduans,id',
            'jadwal_konsultasi'  => 'nullable|date',
            'type_konsultasi'    => 'required|in:online,offline',
            'link_konsultasi'    => 'nullable|string',
            'status_konsultasi'  => 'required|in:pending,completed,canceled',
            'konsultan_id'       => 'nullable|exists:users,id',
        ]);

        KonsultasiPengaduan::create($request->all());
        return redirect()->back()->with('success', 'Konsultasi pengaduan berhasil ditambahkan.');
    }

    public function update(Request $request, KonsultasiPengaduan $konsultasiPengaduan)
    {
        $request->validate([
            'pengaduan_id'       => 'required|exists:pengaduans,id',
            'jadwal_konsultasi'  => 'nullable|date',
            'type_konsultasi'    => 'required|in:online,offline',
            'link_konsultasi'    => 'nullable|string',
            'status_konsultasi'  => 'required|in:pending,completed,canceled',
            'konsultan_id'       => 'nullable|exists:users,id',
        ]);

        $konsultasiPengaduan->update($request->all());
        return redirect()->back()->with('success', 'Konsultasi pengaduan berhasil diperbarui.');
    }

    public function destroy(KonsultasiPengaduan $konsultasiPengaduan)
    {
        $konsultasiPengaduan->delete();
        return redirect()->back()->with('success', 'Konsultasi pengaduan berhasil dihapus.');
    }
}
