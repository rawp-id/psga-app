<?php

namespace App\Http\Controllers;

use App\Models\PanicAlert;
use App\Events\PanicAlertTriggered; // Import Event
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanicController extends Controller
{
    public function trigger(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // 1. Simpan ke database
        $alert = PanicAlert::create([
            'user_id' => Auth::id(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'darurat'
        ]);

        // 2. Teriakkan ke Pusher (Real-time Broadcast)
        event(new PanicAlertTriggered($alert));

        return response()->json(['success' => true, 'message' => 'Sinyal darurat terkirim!']);
    }

    // Tambahkan ini di dalam class PanicController
    public function resolveAlert($id)
    {
        $alert = PanicAlert::findOrFail($id);
        $alert->update(['status' => 'ditangani']); // Ubah status agar tidak muncul terus

        // Redirect kembali ke dashboard admin dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Sinyal darurat dari ' . $alert->user->name . ' sedang ditangani.');
    }

    public function show() {
    // Mengambil riwayat panic terbaru
    $histories = PanicAlert::with('user')->orderBy('created_at', 'desc')->paginate(10);
    return view('admin.panic.index', compact('histories'));
}
}
