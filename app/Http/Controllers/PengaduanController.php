<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function create()
    {
        return view('layanan.pengaduan');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'perpetrator_name' => 'nullable|string|max:255',
            'perpetrator_position' => 'nullable|string|max:255',
            'incident_location' => 'required|string|max:255',
            'incident_description' => 'required|string',
            'additional_data' => 'nullable|string',
            'formFile' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($request->hasFile('formFile')) {
            $validated['formFile'] = $request->file('formFile')->store('pengaduan_files', 'public');
        }

        // Simpan data ke database jika ada model, misal Pengaduan::create($validated);
        Pengaduan::create([
            'user_id' => Auth::id(),
            'nama_pelaku' => $validated['perpetrator_name'] ?? null,
            'jabatan_pelaku' => $validated['perpetrator_position'] ?? null,
            'lokasi' => $validated['incident_location'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'deskripsi' => $validated['incident_description'],
            'data_pengaduan' => $validated['additional_data'] ?? null,
            'file_pengaduan' => $validated['formFile'] ?? null,
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Pengaduan berhasil dikirim.');
    }
}
