<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callback(){
        $googleUser = Socialite::driver('google')->stateless()->user();
        
        $user = User::where('email', $googleUser->email)->first();
        
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'id_level' => 1,
                'password' => bcrypt(Str::random(16)) 
            ]);
            $user->sendEmailVerificationNotification();
        }
        
        Auth::login($user);
        return redirect()->route('verification.notice');
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
            activity()->causedBy(
                Auth::user())
                ->useLog('login')
                ->log(Auth::user()->level->level.'-'.Auth::user()->name
                
            );
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
