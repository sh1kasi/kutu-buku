<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login()
    {

        return view('Admin.auth.login');
    }

    public function store(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            return redirect()->route('category.index');
        }

        return redirect('/buku');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/buku');
    }
}   

