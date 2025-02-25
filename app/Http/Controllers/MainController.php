<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    //
    public function home(Request $request): View
    {
        $newestUrls = DB::select('SELECT * FROM urls ORDER BY created_at ASC LIMIT 20');

        return view('homepage', [
            'newestUrls' => $newestUrls,
        ]);
    }

}
