<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $key = 'subscribe:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 1)) {
            return redirect()->back()->with('error', 'Tunggu sebentar sebelum mencoba lagi.');
        }

        RateLimiter::hit($key, 15);

        if (Subscriber::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', 'Email ini sudah terdaftar untuk newsletter.');
        }

        Subscriber::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Terima kasih telah berlangganan!');
    }
}
