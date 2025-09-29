<?php

namespace App\Http\Controllers;

use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelaporanController extends Controller
{
    public function create()
    {
        return view('layanan.pelaporan');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate and store the pelaporan data
        $validatedData = $request->validate([
            'report_type' => 'required|string|max:255',
            'other_report_type' => 'nullable|string|max:255',
            'perpetrator_name' => 'nullable|string|max:255',
            'perpetrator_position' => 'nullable|string|max:255',
            'incident_location' => 'required|string|max:255',
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
            'incident_description' => 'required|string',
            'additional_data' => 'nullable|string',
            'formFile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'follow_up_contact' => 'nullable|array',
            'follow_up_contact.*' => 'string|max:255',
            'follow_up_contact_other' => 'nullable|string|max:255',
        ]);

        // Tentukan jenis pelaporan akhir
        $jenis_pelaporan = $validatedData['report_type'] === 'Other'
            ? ($validatedData['other_report_type'] ?? 'Lainnya')
            : $validatedData['report_type'];

        // Handle file upload jika ada
        $filePath = null;
        if ($request->hasFile('formFile')) {
            $filePath = $request->file('formFile')->store('pelaporan_files', 'public');
        }

        // Simpan kontak tindak lanjut sebagai JSON
        $followUpContact = $validatedData['follow_up_contact'];
        $followUpContactOther = $validatedData['follow_up_contact_other'] ?? null;

        // Create a new pelaporan record
        $pelaporan = Pelaporan::create([
            'user_id' => Auth::id(),
            'jenis_pelaporan' => $jenis_pelaporan,
            'nama_pelaku' => $validatedData['perpetrator_name'] ?? null,
            'jabatan_pelaku' => $validatedData['perpetrator_position'] ?? null,
            'lokasi' => $validatedData['incident_location'],
            'latitude' => $validatedData['latitude'] ?? null,
            'longitude' => $validatedData['longitude'] ?? null,
            'deskripsi' => $validatedData['incident_description'],
            'data_pelaporan' => $validatedData['additional_data'] ?? null,
            'file_laporan' => $filePath,
            'status' => 'pending',
            'follow_up_contact' => json_encode($followUpContact),
            'follow_up_contact_other' => $followUpContactOther,
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Pelaporan berhasil dibuat.');
    }
}
