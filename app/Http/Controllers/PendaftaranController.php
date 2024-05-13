<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Promos;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        // dd($request);
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_awal' => 'required|date_format:d-m-Y',
            'alamat' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|string|max:255|in:SD,SMP,SMA/SMK,Diploma,Sarjana,Magister,Doktor',
            'no_hp' => 'required|string|max:20',
        ], [
            'nama_lengkap.required' => 'Kolom nama depan wajib diisi.',
            'tempat_lahir.required' => 'Kolom tempat lahir wajib diisi.',
            'tgl_awal.required' => 'Kolom tanggal lahir wajib diisi.',
            'tgl_awal.date_format' => 'Format tanggal lahir harus dd-mm-yyyy.',
            'alamat.required' => 'Kolom alamat wajib diisi.',
            'pendidikan_terakhir.required' => 'Kamu belum memilih pendidikan terakhir.',
            'pendidikan_terakhir.in' => 'Pilih salah satu opsi dari daftar pendidikan terakhir yang tersedia.',
            'no_hp.required' => 'Kolom nomor HP wajib diisi.',
        ]);

        $diklat = Diklat::findOrFail($request->input('diklat'));
        $harga = $diklat->harga;
        $idPromo = null;
        if ($request->has('kode')) {
            $kodePromo = $request->input('kode');

            $promo = Promos::where(function ($query) use ($kodePromo, $diklat) {
                $query->where('kode', $kodePromo)
                    ->where('id_diklat', $diklat->id);
            })
                ->orWhere(function ($query) use ($kodePromo) {
                    $query->where('kode', $kodePromo)
                        ->whereNull('id_diklat');
                })
                ->first();
            if ($promo) {
                if (now() > $promo->tgl_akhir) {
                    return redirect()->back()->withInput()->with('error', 'Promo sudah hangus karena melewati batas waktu.');
                } elseif (now() < $promo->tgl_akhir && $promo->pakai_kuota == "iya" && $promo->kuota <= 1) {
                    return redirect()->back()->withInput()->with('error', 'Maaf kuota promo sudah habis!');
                }
                $harga -= $promo->potongan;
                $idPromo = $promo->id;
            } else {
                $request->validate([
                    'kode' => 'nullable|exists:promos,kode,id_diklat,' . $diklat->id
                ], [
                    'kode.exists' => 'Kode promo yang dimasukkan salah atau tidak tersedia untuk diklat ini.'
                ]);
            }
        }
        $tanggal_lahir_input = $request->input('tgl_awal');
        $tanggal_lahir_carbon = Carbon::createFromFormat('d-m-Y', $tanggal_lahir_input);
        $tanggal_lahir_formatted = $tanggal_lahir_carbon->format('Y-m-d');

        $pendaftaran = new Pendaftaran();
        $pendaftaran->id_diklat = $request->input('diklat');
        $pendaftaran->id_user = Auth::id();
        $pendaftaran->id_promo = $idPromo;
        $pendaftaran->harga_diklat = $harga;
        $pendaftaran->email  = $request->input('email');
        $pendaftaran->nama_lengkap  = $request->input('nama_lengkap');
        $pendaftaran->tempat_lahir  = $request->input('tempat_lahir');
        $pendaftaran->tanggal_lahir = $tanggal_lahir_formatted;
        $pendaftaran->alamat  = $request->input('alamat');
        $pendaftaran->pendidikan_terakhir  = $request->input('pendidikan_terakhir');
        $pendaftaran->no_hp  = $request->input('no_hp');
        $pendaftaran->save();
        $diklat->jumlah_pendaftar += 1;
        $diklat->save();
        $diklat->updateStatus();
        // dd($diklat->whatsapp);
        return redirect($diklat->whatsapp);
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
        // dd($kelPendaftaran);
        $dtDiklats = Diklat::all();
        return view('kelola.kelolaPendaftaran.editAsUser', [
            'kelPendaftaran' => $kelPendaftaran,
            'dtDiklats' => $dtDiklats
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $kelPendaftaran)
    {
        // dd($request);
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_awal' => 'required|date_format:d-m-Y',
            'alamat' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|string|max:255|in:SD,SMP,SMA/SMK,Diploma,Sarjana,Magister,Doktor',
            'no_hp' => 'required|string|max:20',
        ], [
            'nama_lengkap.required' => 'Kolom nama depan wajib diisi.',
            'tempat_lahir.required' => 'Kolom tempat lahir wajib diisi.',
            'tgl_awal.required' => 'Kolom tanggal lahir wajib diisi.',
            'tgl_awal.date_format' => 'Format tanggal lahir harus dd-mm-yyyy.',
            'alamat.required' => 'Kolom alamat wajib diisi.',
            'pendidikan_terakhir.required' => 'Kamu belum memilih pendidikan terakhir.',
            'pendidikan_terakhir.in' => 'Pilih salah satu opsi dari daftar pendidikan terakhir yang tersedia.',
            'no_hp.required' => 'Kolom nomor HP wajib diisi.',
        ]);

        $tanggal_lahir_input = $request->input('tgl_awal');
        $tanggal_lahir_carbon = Carbon::createFromFormat('d-m-Y', $tanggal_lahir_input);
        $tanggal_lahir_formatted = $tanggal_lahir_carbon->format('Y-m-d');

        $kelPendaftaran->email = $request->input('email');
        $kelPendaftaran->nama_lengkap = $request->input('nama_lengkap');
        $kelPendaftaran->tempat_lahir = $request->input('tempat_lahir');
        $kelPendaftaran->tanggal_lahir = $tanggal_lahir_formatted;
        $kelPendaftaran->alamat = $request->input('alamat');
        $kelPendaftaran->pendidikan_terakhir = $request->input('pendidikan_terakhir');
        $kelPendaftaran->no_hp = $request->input('no_hp');
        $kelPendaftaran->update($request->all());

        return redirect('/riwayat')->with('success', 'Pendaftaran berhasil diperbarui!');
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
    public function editAsAdmin ($id)
    {
        $kelPendaftaran=Pendaftaran::findOrFail($id);
        // dd($kelPendaftaran);
        $dtDiklats = Diklat::all();
        return view('kelola.kelolaPendaftaran.editAsAdmin', [
            'kelPendaftaran' => $kelPendaftaran,
            'dtDiklats' => $dtDiklats
        ]);
    }
    public function updateAsAdmin($id , Request $request) 
    {
        // dd($id);
        $messages = [
            's_link.url' => 'Kolom link harus berupa URL yang valid.',
            's_gambar.image' => 'Kolom gambar harus berupa file gambar.',
            's_gambar.max' => 'Kolom gambar tidak boleh lebih dari 5MB.',
            's_doc.mimes' => 'Kolom dokumen harus berupa file PDF, DOC, atau file dokumen lainnya.',
            's_doc.not_in' => 'Kolom dokumen tidak boleh berupa file gambar.',
        ];
        
        $request->validate([
            's_link' => $request->input('metode_sertif') == 'link' ? 'nullable|url' : '',
            's_gambar' => $request->input('metode_sertif') == 'gambar' ? 'nullable|image|max:5120' : '',
            's_doc' => $request->input('metode_sertif') == 'dokumen' ? 'nullable|mimes:pdf,doc,docx' : '',
        ], $messages);
        
    
        $oldData = Pendaftaran::find($id);
        if ($request->input('metode_sertif') == 'link') {
            if ($oldData->s_gambar) {
                Storage::delete($oldData->s_gambar);
                $oldData->s_gambar = null;
            }
            if ($oldData->s_doc) {
                Storage::delete($oldData->s_doc);
                $oldData->s_doc = null;
            }
        }
        elseif ($request->input('metode_sertif') == 'gambar') {
            if ($oldData->s_link) {
                $oldData->s_link = null;
            }
            if ($oldData->s_doc) {
                Storage::delete($oldData->s_doc);
                $oldData->s_doc = null;
            }
            if ($oldData->s_gambar) {
                Storage::delete($oldData->s_gambar);
                $oldData->s_gambar = null;
            }
        }
        elseif ($request->input('metode_sertif') == 'dokumen') {
            if ($oldData->s_gambar) {
                Storage::delete($oldData->s_gambar);
                $oldData->s_gambar = null;
            }
            if ($oldData->s_link) {
                $oldData->s_link = null;
            }
            if ($oldData->s_doc) {
                Storage::delete($oldData->s_doc);
                $oldData->s_doc = null;
            }
        }
    
        // Menyimpan file baru jika ada
        $gambar = null;
        $doc = null;
        if ($request->hasFile('s_gambar')) {
            if ($oldData->s_doc) {
                Storage::delete($oldData->s_doc);
                $oldData->s_doc = null;
            }
            if ($oldData->s_link) {
                $oldData->s_link = null;
            }
            $gambar = $request->file('s_gambar')->store('LanPage');
        }
        if ($request->hasFile('s_doc')) {
            if ($oldData->s_gambar) {
                Storage::delete($oldData->s_gambar);
                $oldData->s_gambar = null;
            }
            if ($oldData->s_link) {
                $oldData->s_link = null;
            }
            $doc = $request->file('s_doc')->store('LanPage');
        }
       
        
        $oldData->update([
            's_gambar' => $gambar ?: $oldData->s_gambar,
            's_link' => $request->input('metode_sertif') == 'link' ? $request->s_link : null,
            's_doc' => $doc ?: $oldData->s_doc,
            'metode_sertif' => $request->metode_sertif,
            'potongan' => $request->potongan ? preg_replace("/[^0-9]/", "", $request->potongan) : null,
            'harga_diklat' => preg_replace("/[^0-9]/", "", $request->total_harga),
            'status_pembayaran_diklat' => $request->status_pembayaran_diklat,
            'status_pelaksanaan'=>"Terlaksana"
        ]);
        // update pembayaran dari admin 
        $pembayaran_update = Pembayaran::where('id_pendaftaran', $id)
        ->where('jenis_pembayaran', 'diklat')
        ->where('metode_pembayaran', 'offline')
        ->first();
        if ($pembayaran_update !== null) {
            if ($request->status_pembayaran_diklat !== $pembayaran_update->status) {
                $pembayaran_update->update([
                    'updated_at' => now(),
                    'status' => $request->status_pembayaran_diklat
                ]);
            }
        }else{
            $oldData->update([
                's_gambar' => $gambar ?: $oldData->s_gambar,
                's_link' => $request->input('metode_sertif') == 'link' ? $request->s_link : null,
                's_doc' => $doc ?: $oldData->s_doc,
                'metode_sertif' => $request->metode_sertif,
                'potongan' => $request->potongan ? preg_replace("/[^0-9]/", "", $request->potongan) : null,
                'harga_diklat' => preg_replace("/[^0-9]/", "", $request->total_harga),
                'status_pembayaran_diklat' => $request->status_pembayaran_diklat
            ]);
        }
    
        return redirect('/kelPendaftaran')->with('success', 'Data berhasil diperbarui!');
    }
    
}
