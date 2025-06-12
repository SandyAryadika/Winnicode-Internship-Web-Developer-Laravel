<?php

namespace App\Exports;

use App\Models\Subscriber;
use Spatie\SimpleExcel\SimpleExcelWriter;

class SpatieSubscribersExport
{
    public static function export()
    {
        $subscribers = Subscriber::all(['email', 'created_at']);

        $path = storage_path('app/public/subscribers.csv');

        SimpleExcelWriter::create($path)
            ->addHeader(['Email', 'Waktu Berlangganan'])
            ->addRows(
                $subscribers->map(fn($s) => [
                    'Email' => $s->email,
                    'Waktu Berlangganan' => $s->created_at->format('Y-m-d H:i'),
                ])
            );

        return response()->download($path)->deleteFileAfterSend();
    }
}
