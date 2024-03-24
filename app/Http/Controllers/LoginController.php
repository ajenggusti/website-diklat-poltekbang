<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }
    public function login(Request $request){
        $messages =[
            'email.required' => 'Harap isi email terlebih dahulu!',
            'password.required' => 'Password tidak boleh kosong.'
        ];
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], $messages);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }
        return back()->with('error','Login gagal, tidak ada kecocokan antara email dan password.');
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
