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
        try {
            $request->validate([
                'email' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i',
                    'unique:subscribers,email',
                ],
            ], [
                'email.email' => 'Format email tidak valid.',
                'email.regex' => 'Hanya alamat @gmail.com yang diperbolehkan.',
                'email.unique' => 'Email sudah terdaftar.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('landing')->with('error', $e->validator->errors()->first('email'));
        }

        if (session()->has('subscribed_email')) {
            return redirect()->route('landing')->with('error', 'Anda sudah berlangganan dengan email: ' . session('subscribed_email') . '. Silakan unsubscribe terlebih dahulu.');
        }

        $key = 'subscribe:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 1)) {
            return redirect()->route('landing')->with('error', 'Tunggu sebentar sebelum mencoba lagi.');
        }

        RateLimiter::hit($key, 15);

        if (Subscriber::where('email', $request->email)->exists()) {
            return redirect()->route('landing')->with('error', 'Email ini sudah terdaftar untuk newsletter.');
        }

        Subscriber::create(['email' => $request->email]);

        CacheHelper::clearSubscriberCache();
        session()->put('subscribed_email', $request->email);

        return redirect()->route('landing')->with('success', 'Terima kasih telah berlangganan.');
    }

    public function unsubscribe(Request $request)
    {
        $email = session('subscribed_email');

        if (!$email) {
            return redirect()->route('landing')->with('error', 'Tidak ada langganan aktif untuk dibatalkan.');
        }

        Subscriber::where('email', $email)->delete();
        CacheHelper::clearSubscriberCache();
        session()->forget('subscribed_email');

        return redirect()->route('landing')->with('success', 'Berhasil berhenti berlangganan.');
    }
}
