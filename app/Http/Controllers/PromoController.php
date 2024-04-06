<?php

namespace App\Http\Controllers;
use App\Models\Diklat;
use App\Models\Promos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Promos::with('diklat')->get();
        return view('kelola.kelolaPromo.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = Diklat::all();
        return view('kelola.kelolaPromo.formPromo', ['datas' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'potongan.required' => 'Potongan wajib diisi.',
            'kode.required' => 'Kode Promo wajib diisi.',
            'kode.unique' => 'Kode Promo sudah ada.',
            'tgl_awal.required' => 'Tanggal Mulai Promo wajib diisi.',
            'tgl_akhir.required' => 'Tanggal Promo Berakhir wajib diisi.',
            'tgl_akhir.after' => 'Tanggal Promo Berakhir harus setelah Tanggal Mulai Promo.',
            'diklat.required' => 'Pilih diklat untuk promo.',
            'img.required' => 'Gambar wajib diunggah.',
            'img.image' => 'File harus berupa gambar.',
            'img.max' => 'Ukuran file tidak boleh melebihi 1 MB.',
        ];
    
        $request->validate([
            'potongan' => 'required',
            'kode' => 'required|unique:promos,kode',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required|after:tgl_awal',
            'diklat' => 'required',
            'img' => 'required|image|max:1024', // Ubah ukuran maksimum sesuai kebutuhan Anda
        ], $messages);

        if ($request->hasFile('img')) {
            // Mendapatkan nama file dan menyimpan gambar di dalam direktori LanPage
            $image = $request->file('img')->store('LanPage');
            // Hapus semua karakter selain angka
            $potongan = preg_replace("/[^0-9]/", "", $request->potongan);    
            // Simpan data ke dalam database
            Promos::create([
                'potongan' => $potongan,
                'kode' => $request->kode,
                'tgl_awal' => Carbon::createFromFormat('d-m-Y', $request->tgl_awal)->format('Y-m-d'),
                'tgl_akhir' => Carbon::createFromFormat('d-m-Y', $request->tgl_akhir)->format('Y-m-d'),
                'id_diklat' => $request->diklat === 'null' ? null : $request->diklat,
                'gambar' => $image,
            ]);
    
            return redirect('/kelPromo')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return back()->withErrors(['msg' => 'Tidak ada file yang diunggah.'])->withInput();
        }
    }
    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promos $kelPromo)
    {
        $datas = Diklat::all();
        $data = ['kelPromo' => $kelPromo, 'datas' => $datas];
        return view('kelola.kelolaPromo.editFormPromo', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promos $kelPromo)
    {
        $messages = [
            'potongan.required' => 'Potongan wajib diisi.',
            'kode.required' => 'Kode Promo wajib diisi.',
            'kode.unique' => 'Kode Promo sudah ada.',
            'tgl_awal.required' => 'Tanggal Mulai Promo wajib diisi.',
            'tgl_akhir.required' => 'Tanggal Promo Berakhir wajib diisi.',
            'tgl_akhir.after' => 'Tanggal Promo Berakhir harus setelah Tanggal Mulai Promo.',
            'img.required' => 'Gambar wajib diunggah.',
            'img.image' => 'File harus berupa gambar.',
            'img.max' => 'Ukuran file tidak boleh melebihi 1 MB.',
            'diklat.required' => 'Pilih diklat untuk promo.'
        ];
    
        $validatedData = $request->validate([
            'potongan' => 'required',
            'kode' => 'required|unique:promos,kode,' . $kelPromo->id,
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required|after:tgl_awal',
            'img' => 'nullable|image|max:1024', 
            'diklat' => 'nullable'
        ], $messages);
            // Menghapus gambar lama jika ada pembaruan gambar baru
        if ($request->hasFile('img')) {
            Storage::delete($kelPromo->gambar);
        }

        // Mengunggah gambar baru jika ada
        if ($request->hasFile('img')) {
            $image = $request->file('img')->store('LanPage');
        } else {
            $image = $kelPromo->gambar;
        }
        $potongan = preg_replace("/[^0-9]/", "", $request->potongan);
        // Format tanggal awal dengan Carbon
        $tgl_awal = Carbon::createFromFormat('d-m-Y', $validatedData['tgl_awal'])->format('Y-m-d');

        // Format tanggal akhir dengan Carbon
        $tgl_akhir = Carbon::createFromFormat('d-m-Y', $validatedData['tgl_akhir'])->format('Y-m-d');
        // Update data Promo
        $kelPromo->update([
            'gambar' => $image,
            'potongan' => $potongan,
            'kode' => $validatedData['kode'],
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'id_diklat' => $validatedData['diklat'] !== 'null' ? $validatedData['diklat'] : null
        ]);

        return redirect('/kelPromo')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promos $kelPromo)
    {
         // Menghapus gambar dari penyimpanan
        Storage::delete($kelPromo->gambar);
                
        // Menghapus entri Diklat dari database
        $kelPromo->delete();

        return redirect('/kelPromo')->with('success', 'Data berhasil dihapus!');
    }
}
