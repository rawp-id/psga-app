<?php

use App\Http\Controllers\Admin\DashboardController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\PanicController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Role;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('test.home');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/logout', function () {
    return view('logout');
});

Route::get('/forgot-password', function () {
    return view('forgot-password');
});

Route::get('/reset-password', function () {
    return view('reset-password');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/edit-profile', function () {
    return view('edit-profile');
});

Route::get('/change-password', function () {
    return view('change-password');
});

Route::get('/chat', function () {
    return view('chat.index');
});

Route::get('/edukasi', [EducationController::class, 'index'])->name('education.index');
Route::get('/edukasi/{slug}', [EducationController::class, 'show'])->name('education.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/layanan', function () {
        return view('layanan.index');
    })->name('layanan.index');

    Route::get('/layanan/pelaporan', [PelaporanController::class, 'create'])->name('pelaporans.create');
    Route::post('/layanan/pelaporan', [PelaporanController::class, 'store'])->name('pelaporans.store');

    Route::get('/layanan/pengaduan', [PengaduanController::class, 'create'])->name('pengaduans.create');
    Route::post('/layanan/pengaduan', [PengaduanController::class, 'store'])->name('pengaduans.store');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/pelaporan/{id}', [RiwayatController::class, 'showPelaporan'])->name('riwayat.showPelaporan');
    Route::get('/riwayat/pengaduan/{id}', [RiwayatController::class, 'showPengaduan'])->name('riwayat.showPengaduan');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/panic-button', function () {
        return view('panic.index');
    })->name('panic-button');

    Route::post('/panic/trigger', [PanicController::class, 'trigger'])->name('panic.trigger');

});

Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/send-message', [ChatController::class, 'sendMessage']);
Route::get('/messages', function () {
    return view('chat');
});

Route::get('/otp', function () {
    return view('otp.index');
});

Route::get('/otp/verify', function () {
    return view('otp.verify');
});

Route::post('/send-otp', [AuthController::class, 'register_number_phone']);

Route::post('/resend-otp', [AuthController::class, 'resend_otp']);

Route::post('/confirm-otp', [AuthController::class, 'confirm_otp']);

Route::prefix('admin')->name('admin.')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class)->except(['show']);

    Route::get('/riwayat', [App\Http\Controllers\Admin\RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/pelaporan/{id}', [App\Http\Controllers\Admin\RiwayatController::class, 'showPelaporan'])->name('riwayat.showPelaporan');
    Route::get('/riwayat/pengaduan/{id}', [App\Http\Controllers\Admin\RiwayatController::class, 'showPengaduan'])->name('riwayat.showPengaduan');
    Route::patch('/riwayat/pelaporan/{id}/update-status', [App\Http\Controllers\Admin\RiwayatController::class, 'updatePelaporanStatus'])->name('riwayat.updatePelaporanStatus');
    Route::patch('/riwayat/pengaduan/{id}/update-status', [App\Http\Controllers\Admin\RiwayatController::class, 'updatePengaduanStatus'])->name('riwayat.updatePengaduanStatus');

    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/update-admin', [App\Http\Controllers\Admin\UserController::class, 'updateAdmin'])->name('users.updateAdmin');
    Route::patch('/users/{user}/update-konsultan', [App\Http\Controllers\Admin\UserController::class, 'updateKonsultan'])->name('users.updateKonsultan');

    Route::resource('konsultasi-pelaporans', App\Http\Controllers\KonsultasiPelaporanController::class);
    Route::resource('konsultasi-pengaduans', App\Http\Controllers\KonsultasiPengaduanController::class);

    Route::resource('education', App\Http\Controllers\Admin\EducationController::class);

    Route::get('/panic/resolve/{id}', [PanicController::class, 'resolveAlert'])->name('panic.resolve');
    Route::get('/panic-history', [PanicController::class, 'show'])->name('panic.index');

});
