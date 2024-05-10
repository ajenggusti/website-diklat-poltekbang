<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\User;
use App\Models\Level;
use App\Models\Nationality;
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
        $kelurahans = Kelurahan::get();
        $kabupatens = Kabupaten::get();
        $kecamatans = Kecamatan::get();
        $provinsis = Provinsi::get();
        $nationalities = Nationality::get();

        // dd($user->nationality->name);

        return view('utama.editProfil', [
            'user' => $user,
            'kelurahans' => $kelurahans,
            'kabupatens' => $kabupatens,
            'kecamatans' => $kecamatans,
            'provinsis' => $provinsis,
            'nationalities' => $nationalities
        ]);

    }
    public function updateProfil(Request $request, $id)
    {
        // dd($id);
        // dd($request);
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'in' => ':attribute harus salah satu dari :values.',
            'image' => ':attribute harus berupa gambar.',
            'mimes' => ':attribute harus memiliki format file: :values.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'string' => ':attribute harus berupa teks.',
            'email' => ':attribute harus berupa alamat email yang valid.',
            'date_format' => ':attribute tidak sesuai format tanggal yang diharapkan (dd-mm-yyyy).',
            'exists' => ':attribute yang dipilih tidak valid.',
        ];
    
        $request->validate([
            'nik' => $request->input('jenis_berkas') == 'ktp' ? 'required|string' : '',
            'jenis_berkas' => 'required|in:ktp,paspor',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_paspor' => 'nullable|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:p,l',
            'tgl_lahir' => 'required|date_format:d-m-Y',
            'tgl_exp_paspor' => 'nullable|date_format:d-m-Y',
            'id_provinsi' => 'required|exists:provinsis,id',
            'id_kabupaten' => 'required|exists:kabupatens,id',
            'id_kecamatan' => 'required|exists:kecamatans,id',
            'id_kelurahan' => 'required|exists:kelurahans,id',
            'id_nationality' => 'required|exists:nationalities,id',
        ], $messages);
        dd($request);
    }
}
