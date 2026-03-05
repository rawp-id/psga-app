<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::latest()->get();
        return view('admin.education.index', compact('educations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Tetap simpan thumbnail di storage lokal karena ukurannya kecil & penting untuk UI
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('education/thumbs', 'public');
        }

        // Untuk Video dan PDF, kita ambil dari input URL yang sama atau berbeda
        if ($request->category == 'video') {
            $data['file_path'] = $request->video_url;
        } elseif ($request->category == 'pdf') {
            $data['file_path'] = $request->pdf_url; // Sekarang mengambil link, bukan file
        }

        Education::create($data);
        return redirect()->back()->with('success', 'Konten edukasi berhasil ditambahkan!');
    }

    public function destroy(Education $education)
    {
        if ($education->thumbnail) Storage::disk('public')->delete($education->thumbnail);
        if ($education->category == 'pdf') Storage::disk('public')->delete($education->file_path);
        $education->delete();
        return redirect()->back()->with('success', 'Konten berhasil dihapus');
    }
}
