<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Gunakan stateless() jika kamu sering mengalami "The state encounter an error" saat refresh
            $googleUser = Socialite::driver('google')->stateless()->user();

            $email = $googleUser->getEmail();

            $isKampusEmail = str_ends_with($email, 'uin-malang.ac.id');
            $isSpecialEmail = ($email === 'psgamaliki@gmail.com');

            // 1. Validasi Akses: Jika tidak memenuhi keduanya, tendang keluar
            if (!$isKampusEmail && !$isSpecialEmail) {
                notyf()->error('Hanya email kampus yang diizinkan untuk login.');
                return redirect('/login')->withErrors(['error' => 'Hanya email kampus yang diizinkan untuk login.']);
            }

            // 2. Jika lolos validasi, cari atau buat user
            $user = User::where('email', $email)->first();

            if (!$user) {
                $user = User::create([
                    'google_id' => $googleUser->getId(),
                    'image'     => $googleUser->getAvatar(),
                    'name'      => $googleUser->getName(),
                    'email'     => $email,
                    'password'  => bcrypt('password'), // Sebaiknya Str::random(16)
                ]);
            }

            // 3. Login User
            Auth::login($user);

            // 4. Cek Kelengkapan Data (OTP)
            if (empty($user->number_phone)) {
                return redirect('/otp');
            }

            return redirect()->intended('/');
        } catch (\Exception $e) {
            // Log error untuk debug (cek di storage/logs/laravel.log)
            Log::error('Google Auth Error: ' . $e->getMessage());

            notyf()->error('Gagal autentikasi Google: ' . $e->getMessage());
            return redirect('/login')->withErrors(['error' => 'Gagal autentikasi Google']);
        }
    }

    public function register_number_phone(Request $request)
    {
        $curl = curl_init();
        $otp = rand(100000, 999999);
        $otp_expired = time();
        $number_phone = $request->number_phone;

        // $number_phone = preg_replace('/^0/', '62', $number_phone);

        $number_phone = '62' . $number_phone;

        // dd($number_phone);

        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $number_phone,
                    'message' => "Your OTP : " . $otp,
                    'countryCode' => '62',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . config('otp.key')
                ),
            ));

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
            }
            curl_close($curl);

            if (isset($error_msg)) {
                notyf()->error('Gagal mengirim OTP: ' . $error_msg);
                return redirect('/otp');
            }

            $responseObj = json_decode($response);

            if (!is_object($responseObj) || !isset($responseObj->status) || $responseObj->status != 'success') {
                $message = isset($responseObj->message) ? $responseObj->message : 'Unknown error';
                notyf()->error("Gagal mengirim OTP: {$message}");
                return redirect('/otp');
            }

            $user = User::find(Auth::user()->id);

            $update = $user->update([
                'number_phone' => $number_phone,
                'otp' => $otp,
                'otp_expired' => $otp_expired
            ]);

            if ($update) {
                notyf()->success('OTP berhasil dikirim ke nomor telepon Anda.');
                return redirect('/otp/verify')->with('number_phone', $number_phone);
            }
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'duplicate key value violates unique constraint ""') !== false) {
                notyf()->error('Nomor telepon sudah terdaftar. Silakan gunakan nomor lain.');
                return redirect('/otp');
            } else {
                notyf()->error('Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
                return redirect('/otp');
            }
        }
    }

    public function resend_otp(Request $request)
    {
        $user = User::where('number_phone', $request->number_phone)->first();

        if (!$user) {
            notyf()->error('Nomor telepon tidak ditemukan.');
            return redirect('/otp/verify');
        } else {
            $curl = curl_init();
            $otp = rand(100000, 999999);
            $otp_expired = time();
            $number_phone = $request->number_phone;
            $data = [
                'target' => $number_phone,
                'message' => "Your OTP : " . $otp
            ];

            $user->update([
                'otp' => $otp,
                'otp_expired' => $otp_expired
            ]);

            try {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'target' => $number_phone,
                        'message' => "Your OTP : " . $otp,
                        'countryCode' => '62',
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ' . config('otp.key')
                    ),
                ));

                $response = curl_exec($curl);
                if (curl_errno($curl)) {
                    $error_msg = curl_error($curl);
                }
                curl_close($curl);

                if (isset($error_msg)) {
                    notyf()->error('Gagal mengirim OTP: ' . $error_msg);
                    return redirect('/otp/verify');
                }

                $responseObj = json_decode($response);

                if (!is_object($responseObj) || !isset($responseObj->status) || $responseObj->status != 'success') {
                    $message = isset($responseObj->message) ? $responseObj->message : 'Unknown error';
                    notyf()->error("Gagal mengirim OTP: {$message}");
                    return redirect('/otp/verify');
                }

                $user = User::find(Auth::user()->id);

                $update = $user->update([
                    'otp' => $otp,
                    'otp_expired' => $otp_expired
                ]);

                if ($update) {
                    notyf()->success('OTP berhasil dikirim ulang ke nomor telepon Anda.');

                    return redirect('/otp/verify')->with('number_phone', $number_phone);
                }
            } catch (\Exception $e) {
                if (strpos($e->getMessage(), 'duplicate key value violates unique constraint ""') !== false) {
                    notyf()->error('Nomor telepon sudah terdaftar. Silakan gunakan nomor lain.');
                    return redirect('/otp/verify');
                } else {
                    notyf()->error('Terjadi kesalahan saat mengirim OTP: ' . $e->getMessage());
                    return redirect('/otp/verify');
                }
            }
        }
    }

    public function confirm_otp(Request $request)
    {
        $otpconfirm = $request->otp;
        $number_phone = $request->number_phone;
        $user = User::where('otp', $otpconfirm)->where('number_phone', $number_phone)->first();

        if ($user) {
            if (time() - $user->otp_expired < 120) {
                notyf()->success('OTP berhasil diverifikasi.');
                $user->update([
                    'number_phone_verified_at' => now(),
                ]);
                return redirect('/');
            } else {
                notyf()->error('OTP sudah kadaluarsa. Silakan coba lagi.');
                return redirect('/otp/verify');
            }
        } else {
            notyf()->error('OTP tidak valid. Silakan coba lagi.');
            return redirect('/otp/verify');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
