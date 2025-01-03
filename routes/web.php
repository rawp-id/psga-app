<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('test.home');
});

Route::get('/login', function () {
    return view('auth.login');
});

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

Route::get('/layanan', function () {
    return view('layanan.index');
});

Route::get('/layanan/pelaporan', function () {
    return view('layanan.pelaporan');
});

Route::get('/layanan/pengaduan', function () {
    return view('layanan.pengaduan');
});

Route::get('/riwayat', function () {
    return view('riwayat.index');
});

Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

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