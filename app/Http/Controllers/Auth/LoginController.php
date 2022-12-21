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
        // dd($request);

        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password'=> 'required|min:6|'
        ]);



        if(Auth::attempt($credentials)){
            // return redirect('/buku');
            $request->session()->regenerate();
            return redirect()->intended('/buku')->with('success', 'Selamat datang kembali ' . auth()->user()->name . '!');
        }

        // dd('gagal');

        return back()->with('error', 'Login gagal! masukkan email dan password dengan benar!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/buku');
    }
}   

