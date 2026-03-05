<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        $query = Education::query();

        // Fitur Filter per Kategori
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        $educations = $query->latest()->paginate(9);
        return view('education.index', compact('educations'));
    }

    public function show($slug)
    {
        $education = Education::where('slug', $slug)->firstOrFail();

        $embedUrl = null;
        if ($education->category == 'video') {
            // Logika konversi link youtube biasa ke format embed
            $url = $education->file_path;
            if (preg_match('/(video:|v=|\/v\/|youtu\.be\/|\/embed\/)/', $url)) {
                preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                $id = $matches[1] ?? null;
                if (!$id) {
                    $id = last(explode('/', $url));
                }
                $embedUrl = "https://www.youtube.com/embed/" . $id;
            }
        }

        return view('education.show', compact('education', 'embedUrl'));
    }
}
