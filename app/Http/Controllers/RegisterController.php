<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'password' => $request->password,
            'status' => 'Perlu dilengkapi'
        ]);


        return redirect('/login')->with('success', 'Registrasi berhasil silahkan login!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);
        $user = User::findOrFail($id);
        // dd($user->provinsi->name);
        return view('kelola.kelolaUser.show', [
            'user'=>$user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $register)
    {
        $levels = Level::All();
        $kelurahans = Kelurahan::get();
        $kabupatens = Kabupaten::get();
        $kecamatans = Kecamatan::get();
        $provinsis = Provinsi::get();
        $nationalities = Nationality::get();
        return view('kelola.kelolaUser.editUser', [
            'user' => $register,
            'levels' => $levels,
            'kelurahans' => $kelurahans,
            'kabupatens' => $kabupatens,
            'kecamatans' => $kecamatans,
            'provinsis' => $provinsis,
            'nationalities' => $nationalities

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // ini edit buat admin
    public function update(Request $request, User $register)
    {
        // dd($request);
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'in' => ':attribute harus salah satu dari :values.',
            'mimes' => ':attribute harus memiliki format file: :values.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'string' => ':attribute harus berupa teks.',
            // 'email' => ':attribute harus berupa alamat email yang valid.',
            'date_format' => ':attribute tidak sesuai format tanggal yang diharapkan (dd-mm-yyyy).',
        ];

        $rules = [
            'jenis_berkas' => 'required|in:ktp,paspor',
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:p,l',
            'tgl_lahir' => 'required|date_format:d-m-Y',
        ];
        // ini ktp
        if ($request->input('jenis_berkas') == 'ktp') {
            $rules['nik'] = 'required|string';
            $rules['id_provinsi'] = 'required';
            $rules['id_kabupaten'] = 'required';
            $rules['id_kecamatan'] = 'required';
            $rules['id_kelurahan'] = 'required';
            $request->request->remove('id_nationality');
            // $request->request->remove('tgl_exp_paspor');
            $request->request->remove('no_paspor');
            unset($rules['id_nationality']);
            // unset($rules['tgl_exp_paspor']);
            unset($rules['no_paspor']);
        } else {
            // ini paspor
            $rules['id_nationality'] = 'required';
            // $rules['tgl_exp_paspor'] = 'required';
            $rules['no_paspor'] = 'required';
            $request->request->remove('nik');
            $request->request->remove('id_provinsi');
            $request->request->remove('id_kabupaten');
            $request->request->remove('id_kecamatan');
            $request->request->remove('id_kelurahan');
            $request->request->remove('tempat_lahir');
            unset($rules['nik']);
            unset($rules['id_provinsi']);
            unset($rules['id_kabupaten']);
            unset($rules['id_kecamatan']);
            unset($rules['id_kelurahan']);
            unset($rules['tempat_lahir']);
        }
        // dd($request);
        $request->validate($rules, $messages);
        $id = $register->id;
        if ($request->input('jenis_berkas') == 'ktp') {
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            // $user->email = $request->input('email');
            $user->tempat_lahir = $request->input('tempat_lahir');
            $user->jenis_kelamin = $request->input('jenis_kelamin');
            $user->jenis_berkas = $request->input('jenis_berkas');
            $user->tgl_lahir = Carbon::createFromFormat('d-m-Y', $request->input('tgl_lahir'))->format('Y-m-d');
            $user->nik = $request->input('nik');
            $user->id_provinsi = $request->input('id_provinsi') + 1;
            $user->id_kabupaten = $request->input('id_kabupaten');
            $user->id_kecamatan = $request->input('id_kecamatan');
            $user->id_kelurahan = $request->input('id_kelurahan');
            $user->id_level=$request->id_level;
            $user->id_nationality = null;
            // $user->tgl_exp_paspor = null;
            $user->no_paspor = null;
            $user->status = $request->status;

            if ($request->status == 'Permohonan perubahan disetujui' || $request->status=='Diverifikasi') {
                $user->permohonan_ubah = null;
            }
        
            $user->save();
        } else {
            // ini paspor
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->jenis_berkas = $request->input('jenis_berkas');
            // $user->email = $request->input('email');
            $user->jenis_kelamin = $request->input('jenis_kelamin');
            $user->id_nationality = $request->input('id_nationality');
            $user->no_paspor = $request->input('no_paspor');
            $user->tgl_lahir = Carbon::createFromFormat('d-m-Y', $request->input('tgl_lahir'))->format('Y-m-d');
            // $user->tgl_exp_paspor = Carbon::createFromFormat('d-m-Y', $request->input('tgl_exp_paspor'))->format('Y-m-d');
            $user->id_level=$request->id_level;
            $user->id_provinsi = null;
            $user->id_kabupaten = null;
            $user->id_kecamatan = null;
            $user->id_kelurahan = null;
            $user->nik = null;
            $user->tempat_lahir = null;
            $user->status = $request->status;
            if ($request->status == 'Permohonan perubahan disetujui' || $request->status=='Diverifikasi') {
                $user->permohonan_ubah = null;
            }
        
            $user->save();
        }
        if ($request->hasFile('img')) {
            if ($user->berkas_pendukung) {
                $filePath = public_path('storage/' . $user->berkas_pendukung);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move('storage/LanPage', $image);
            $user->berkas_pendukung = $image;
            $user->save();
        }
        return redirect('/indexKelolaUser')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $register)
    {
        $filePath = public_path('storage/' . $register->berkas_pendukung);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $register->delete();
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
        // dd($user);
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
        // dd($request);
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'in' => ':attribute harus salah satu dari :values.',
            'image' => ':attribute harus berupa gambar.',
            'mimes' => ':attribute harus memiliki format file: :values.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'string' => ':attribute harus berupa teks.',
            // 'email' => ':attribute harus berupa alamat email yang valid.',
            'date_format' => ':attribute tidak sesuai format tanggal yang diharapkan (dd-mm-yyyy).',
        ];

        $rules = [
            'jenis_berkas' => 'required|in:ktp,paspor',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:p,l',
            'tgl_lahir' => 'required|date_format:d-m-Y',
        ];
        // ini ktp
        if ($request->input('jenis_berkas') == 'ktp') {
            $rules['nik'] = 'required|string';
            $rules['id_provinsi'] = 'required';
            $rules['id_kabupaten'] = 'required';
            $rules['id_kecamatan'] = 'required';
            $rules['id_kelurahan'] = 'required';
            $request->request->remove('id_nationality');
            // $request->request->remove('tgl_exp_paspor');
            $request->request->remove('no_paspor');
            unset($rules['id_nationality']);
            // unset($rules['tgl_exp_paspor']);
            unset($rules['no_paspor']);
        } else {
            // ini paspor
            $rules['id_nationality'] = 'required';
            // $rules['tgl_exp_paspor'] = 'required';
            $rules['no_paspor'] = 'required';
            $request->request->remove('nik');
            $request->request->remove('id_provinsi');
            $request->request->remove('id_kabupaten');
            $request->request->remove('id_kecamatan');
            $request->request->remove('id_kelurahan');
            $request->request->remove('tempat_lahir');
            unset($rules['nik']);
            unset($rules['id_provinsi']);
            unset($rules['id_kabupaten']);
            unset($rules['id_kecamatan']);
            unset($rules['id_kelurahan']);
            unset($rules['tempat_lahir']);
        }
        $request->validate($rules, $messages);
        if ($request->input('jenis_berkas') == 'ktp') {
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            // $user->email = $request->input('email');
            $user->tempat_lahir = $request->input('tempat_lahir');
            $user->jenis_kelamin = $request->input('jenis_kelamin');
            $user->jenis_berkas = $request->input('jenis_berkas');
            $user->tgl_lahir = Carbon::createFromFormat('d-m-Y', $request->input('tgl_lahir'))->format('Y-m-d');
            $user->nik = $request->input('nik');
            $user->id_provinsi = $request->input('id_provinsi') + 1;
            $user->id_kabupaten = $request->input('id_kabupaten');
            $user->id_kecamatan = $request->input('id_kecamatan');
            $user->id_kelurahan = $request->input('id_kelurahan');
            // Hapus data paspor yang tersimpan di database
            $user->id_nationality = null;
            // $user->tgl_exp_paspor = null;
            $user->no_paspor = null;
            $user->status = "Sedang diverifikasi";
            $user->save();
        } else {
            // ini paspor
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->jenis_berkas = $request->input('jenis_berkas');
            // $user->email = $request->input('email');
            $user->jenis_kelamin = $request->input('jenis_kelamin');
            $user->id_nationality = $request->input('id_nationality');
            $user->no_paspor = $request->input('no_paspor');
            $user->tgl_lahir = Carbon::createFromFormat('d-m-Y', $request->input('tgl_lahir'))->format('Y-m-d');
            // $user->tgl_exp_paspor = Carbon::createFromFormat('d-m-Y', $request->input('tgl_exp_paspor'))->format('Y-m-d');
            // Hapus data ktp yang tersimpan di database
            $user->id_provinsi = null;
            $user->id_kabupaten = null;
            $user->id_kecamatan = null;
            $user->id_kelurahan = null;
            $user->nik = null;
            $user->tempat_lahir = null;
            $user->status = "Sedang diverifikasi";
            $user->save();
        }
        if ($request->hasFile('img')) {
            if ($user->berkas_pendukung) {
                $filePath = public_path('storage/' . $user->berkas_pendukung);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move('storage/LanPage', $image);
            $user->berkas_pendukung = $image;
            $user->save();
        }
        return redirect('/editProfil')->with('success', 'Terimakasih sudah lengkapi data. Tunggu admin memverifikasi datamu!');
    }
    public function editPermohonan(Request $request, $id)
    {
        // dd($request);
        // dd($id);
        return view('utama.permohonan', [
            'id' => $id
        ]);
    }
    public function updatePermohonan(Request $request, $id)
    {
        $message = [
            'permohonan_ubah.required' => 'Kamu harus mengisi field permohonan ubah.',
        ];
        $request->validate([
            'permohonan_ubah' => 'required',
        ], $message);
        $user = User::findOrFail($id);
        $user->permohonan_ubah = $request->permohonan_ubah;
        $user->status = "Memohon perubahan";
        $user->save();
        return redirect('/editProfil')->with('success', 'Permohonan perubahan data telah terkirim, mohon tunggu konfirmasi admin!');
        // dd($request);
    }
}
