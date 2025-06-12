<?php

namespace App\Http\Controllers;

use App\Exports\SubscribersExport;
use Maatwebsite\Excel\Facades\Excel;

class SubscriberExportController extends Controller
{
    public function export()
    {
        return Excel::download(new SubscribersExport, 'subscribers.xlsx');
    }
}
