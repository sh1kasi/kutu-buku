<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:dns', 'max:255', 'unique:users'],
            'password' => ['required_with:password_confirmation', 'required', 'min:6'],
            'password_confirmation' => ['same:password'],
            'g-recaptcha-response' => 'required|captcha',
        ],
        [
            'g-recaptcha-response' => [
                'required' => 'Harap verifikasi bahwa ada bukan robot!',
                'captcha' => 'Captcha error! coba ulangi dengan refresh halaman!',
            ],
            'password_confirmation.same' => 'Password Yang Anda Masukkan Berbeda'
        ]);

         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'is_admin' => '0',
        ]);

        return redirect('/buku/login')->with('success', 'Registrasi berhasil, silahkan login dengan benar!');
    }
}

