<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {

        return view('main.index');
    }

    public function bukuPilihan()
    {
        
        return view('main.bukuPilihan');
    }

    public function login()
    {
        
        return view('main.account.daftar');
    }
}
