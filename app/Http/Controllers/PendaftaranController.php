<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Promos;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Pendaftaran::all();
        return view('kelola.kelolaPendaftaran.index', [
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
   
        $userId = Auth::id();
    
        $id = $request->query('id');

        $diklat = Diklat::findOrFail($id);
        $dtDiklats = Diklat::all();
        return view('kelola.kelolaPendaftaran.form', [
            'userId' => $userId, 
            'diklat' => $diklat,
            'dtDiklats' => $dtDiklats
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_awal' => 'required|date_format:d-m-Y',
            'alamat' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|string|max:255|in:SD,SMP,SMA/SMK,Diploma,Sarjana,Magister,Doktor',
            'no_hp' => 'required|string|max:20',
        ], [
            'nama_depan.required' => 'Kolom nama depan wajib diisi.',
            'nama_belakang.required' => 'Kolom nama belakang wajib diisi.',
            'tempat_lahir.required' => 'Kolom tempat lahir wajib diisi.',
            'tgl_awal.required' => 'Kolom tanggal lahir wajib diisi.',
            'tgl_awal.date_format' => 'Format tanggal lahir harus dd-mm-yyyy.',
            'alamat.required' => 'Kolom alamat wajib diisi.',
            'pendidikan_terakhir.required' => 'Kamu belum memilih pendidikan terakhir.',
            'pendidikan_terakhir.in' => 'Pilih salah satu opsi dari daftar pendidikan terakhir yang tersedia.',
            'no_hp.required' => 'Kolom nomor HP wajib diisi.',
        ]);
    
        // Ambil data diklat berdasarkan ID
        $diklat = Diklat::findOrFail($request->input('diklat'));
        $harga = $diklat->harga;
    
        // Lanjutkan dengan proses validasi kode promo
        $idPromo = null;
        if ($request->has('kode')) {
            $kodePromo = $request->input('kode');
    
            $promo = Promos::where(function($query) use ($kodePromo, $diklat) {
                $query->where('kode', $kodePromo)
                    ->where('id_diklat', $diklat->id);
            })
            ->orWhere(function($query) use ($kodePromo) {
                $query->where('kode', $kodePromo)
                    ->whereNull('id_diklat');
            })
            ->first();
            if ($promo) {
                if (now() > $promo->tgl_akhir) {
                    return redirect()->back()->with('error', 'Promo sudah hangus karena melewati batas waktu.');
                }
                elseif (now() < $promo->tgl_akhir && $promo->pakai_kuota == "iya" && $promo->kuota <= 1) {
                    return redirect()->back()->with('error', 'Maaf kuota promo sudah habis!');
                }
                $harga -= $promo->potongan;
                $idPromo = $promo->id;
            } else {
                // Validasi kode promo
                $request->validate([
                    'kode' => 'nullable|exists:promos,kode,id_diklat,' . $diklat->id
                ], [
                    'kode.exists' => 'Kode promo yang dimasukkan salah atau tidak tersedia untuk diklat ini.'
                ]);
            }
        }
    
        // Proses penyimpanan data pendaftaran
        $pendaftaran = new Pendaftaran();
        $pendaftaran->id_diklat = $request->input('diklat');
        $pendaftaran->id_user = Auth::id();
        $pendaftaran->id_promo = $idPromo; 
        $pendaftaran->harga_diklat = $harga;
        $pendaftaran->save();
    
        // Update jumlah pendaftar pada diklat
        $diklat->jumlah_pendaftar += 1;
        $diklat->save();
        $diklat->updateStatus();
        
        // Redirect dengan pesan sukses jika berhasil
        return redirect('/riwayat')->with('success', 'Pendaftaran berhasil disimpan!');
    }
    



    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $kelPendaftaran)
    {

        return view('kelola.kelolaPendaftaran.show', [
            'pendaftaran' => $kelPendaftaran,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $kelPendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $kelPendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $kelPendaftaran)
    {
        $diklat = $kelPendaftaran->diklat;
        $diklat->jumlah_pendaftar -= 1;
        $diklat->save();
        $kelPendaftaran->delete();
        $diklat->updateStatus();
        return redirect('/riwayat')->with('success', 'Data berhasil dihapus!');
    }
   
}
