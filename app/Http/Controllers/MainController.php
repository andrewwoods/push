<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function home(Request $request): View
    {

        return view('homepage', [
        ]);
