<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Notifications\NewSubscriberNotification;
use Illuminate\Support\Facades\Notification;
use App\Helpers\CacheHelper;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Cegah subscribe jika sudah ada session aktif
        if (session()->has('subscribed_email')) {
            return redirect()->route('landing')->withErrors([
                'email' => 'Anda sudah berlangganan dengan email: ' . session('subscribed_email') . '. Silakan unsubscribe terlebih dahulu.'
            ]);
        }

        // Rate limiting berdasarkan IP
        $key = 'subscribe:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 1)) {
            return redirect()->route('landing')->withErrors([
                'email' => 'Tunggu sebentar sebelum mencoba lagi.'
            ]);
        }

        RateLimiter::hit($key, 15); // Tunggu 15 detik untuk request berikutnya

        // Cek jika email sudah ada di database
        if (Subscriber::where('email', $request->email)->exists()) {
            return redirect()->route('landing')->withErrors([
                'email' => 'Email ini sudah terdaftar untuk newsletter.'
            ]);
        }

        // Simpan subscriber baru
        $subscriber = Subscriber::create([
            'email' => $request->email
        ]);

        // Bersihkan cache subscriber
        CacheHelper::clearSubscriberCache();

        // Simpan status langganan di session
        session()->put('subscribed_email', $request->email);

        // Redirect kembali ke halaman utama dengan indikator sukses
        return redirect()->route('landing')->with('success', 'Terima kasih telah berlangganan.');
    }

    public function unsubscribe(Request $request)
    {
        $email = session('subscribed_email');

        if (!$email) {
            return redirect()->route('landing')->withErrors([
                'email' => 'Tidak ada langganan aktif untuk dibatalkan.'
            ]);
        }

        // Hapus dari database (opsional, tergantung kebutuhan)
        Subscriber::where('email', $email)->delete();

        // Bersihkan cache subscriber
        CacheHelper::clearSubscriberCache();

        // Hapus session
        session()->forget('subscribed_email');

        return redirect()->route('landing')->with('success', 'Berhasil berhenti berlangganan.');
    }
}
