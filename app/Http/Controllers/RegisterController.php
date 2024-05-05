<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\User;
use App\Models\Level;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            'namaPengguna.required' => 'Nama pengguna tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.unique' => 'Password sudah digunakan.'
        ];

        $request->validate([
            'namaPengguna' => 'required',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|unique:users,password',
        ], $message);

        User::create([
            'id_level' => 1,
            'name' => $request->namaPengguna,
            'email' => $request->email,
            'password' => $request->password
        ]);


        return redirect('/login')->with('success', 'Registrasi berhasil silahkan login!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $register)
    {
        $getLevel = Level::All();
        // Mengembalikan tampilan edit dengan data level pengguna
        return view('kelola.kelolaUser.editUser', [
            'data' => $register,
            'getLevel' => $getLevel
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $register)
    {

        $register->update([
            'id_level' => $request->id_level,
        ]);
        return redirect('/indexKelolaUser')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $register)
    {
        User::destroy($register->id);
        return redirect('/indexKelolaUser')->with('success', 'Data berhasil dihapus!');
    }
    public function tampil()
    {
        $datas = User::get();
        // $kelurahan=Kelurahan::get();
        // dd($datas);
        // dd($datas[0]);
        return view('kelola.kelolaUser.index', [
            'datas' => $datas,
            // 'kelurahan'=>$kelurahan
        ]);
    }
    public function editProfil()
    {
        $user = Auth::user();
        $kelurahans=Kelurahan::get();
        $kabupatens=Kabupaten::get();
        $provinsis=Provinsi::get();
        $kecamatans=Kecamatan::get();

        // dd($user);
        return view('utama.editProfil', [
            'user'=>$user,
            'kelurahans'=>$kelurahans,
            'kabupatens'=>$kabupatens,
            'kecamatans'=>$kecamatans,
            'provinsis'=>$provinsis,

        ]);
    }
    // public function updateProfil(){

    // }
}
