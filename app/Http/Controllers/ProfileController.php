<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'number_phone' => 'nullable|numeric|digits_between:10,15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }
            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = $path;
        }

        $user->name = $request->name;
        $user->number_phone = $request->number_phone;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}