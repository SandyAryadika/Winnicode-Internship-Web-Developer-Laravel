<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Notifications\NewSubscriberNotification;
use Illuminate\Support\Facades\Notification;

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

        $subscriber = Subscriber::create([
            'email' => $request->email,
        ]);

        $adminEmail = ['arizzhi@gmail.com', 'winnicode@gmail.com'];
        Notification::route('mail', $adminEmail)->notify(new NewSubscriberNotification($subscriber));

        return redirect()->back()->with('success', 'Terima kasih telah berlangganan!');
    }
}
