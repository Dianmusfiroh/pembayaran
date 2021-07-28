<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Front extends Controller
{
    public function index()
    {
        return view('front');
    }

    public function alur()
    {
        return view('alur');
    }

    public function help()
    {
        return view('help');
    }
}
