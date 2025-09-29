<?php

namespace App\Http\Controllers;

use App\Models\KonsultasiPelaporan;
use App\Models\Pelaporan;
use App\Models\User;
use Illuminate\Http\Request;

class KonsultasiPelaporanController extends Controller
{
    public function index()
    {
        $konsultasis = KonsultasiPelaporan::with(['pelaporan', 'konsultan'])->latest()->get();
        $pelaporans  = Pelaporan::all();
        $konsultans  = User::all();
        return view('admin.konsultasi_pelaporans.index', compact('konsultasis', 'pelaporans', 'konsultans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelaporan_id'       => 'required|exists:pelaporans,id',
            'jadwal_konsultasi'  => 'nullable|date',
            'type_konsultasi'    => 'required|in:online,offline',
            'link_konsultasi'    => 'nullable|string',
            'status_konsultasi'  => 'required|in:pending,completed,canceled',
            'konsultan_id'       => 'nullable|exists:users,id',
        ]);

        KonsultasiPelaporan::create($request->all());
        return redirect()->back()->with('success', 'Konsultasi pelaporan berhasil ditambahkan.');
    }

    public function update(Request $request, KonsultasiPelaporan $konsultasiPelaporan)
    {
        $request->validate([
            'pelaporan_id'       => 'required|exists:pelaporans,id',
            'jadwal_konsultasi'  => 'nullable|date',
            'type_konsultasi'    => 'required|in:online,offline',
            'link_konsultasi'    => 'nullable|string',
            'status_konsultasi'  => 'required|in:pending,completed,canceled',
            'konsultan_id'       => 'nullable|exists:users,id',
        ]);

        $konsultasiPelaporan->update($request->all());
        return redirect()->back()->with('success', 'Konsultasi pelaporan berhasil diperbarui.');
    }

    public function destroy(KonsultasiPelaporan $konsultasiPelaporan)
    {
        $konsultasiPelaporan->delete();
        return redirect()->back()->with('success', 'Konsultasi pelaporan berhasil dihapus.');
    }
}
