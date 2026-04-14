<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // 1. Cari atau buat user berdasarkan email
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // Buat user baru jika belum ada
                $user = User::create([
                    'name'              => $googleUser->name,
                    'email'             => $googleUser->email,
                    'google_id'         => $googleUser->id,
                    'email_verified_at' => now(),
                ]);

                // 2. Berikan role default 'user' dari Spatie untuk user baru
                $user->assignRole('user');
            } else {
                // Update google_id jika user sudah ada (opsional)
                $user->update(['google_id' => $googleUser->id]);
            }

            // 3. Login user
            Auth::login($user);

            // 4. Logika Redirection berdasarkan Role
            if ($user->hasRole('admin')) {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/');
        } catch (\Exception $e) {
            // Log error jika diperlukan: \Log::error($e->getMessage());
            return redirect('/login')->with('error', 'Gagal login menggunakan Google.');
        }
    }
}
