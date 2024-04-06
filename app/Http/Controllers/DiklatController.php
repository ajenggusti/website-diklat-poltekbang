<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\KatDiklat;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Diklat::getKategori();
        return view('kelola.kelolaDiklat.index', ['datas'=>$datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getKategori = KatDiklat::selectAll();
        return view('kelola.kelolaDiklat.form', ['getKategori' => $getKategori]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $messages = [
            'img.required' => 'Data tidak boleh kosong.',
            'img.image' => 'File harus berupa gambar.',
            'img.file' => 'File harus berupa berkas.',
            'img.max' => 'Ukuran file tidak boleh melebihi 1 MB.',
            'status.required' => 'Status tampilan harus dipilih.',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong.', // Pesan untuk deskripsi
            'nama_diklat.required' => 'Nama Diklat tidak boleh kosong.',
            'harga.required' => 'Harga tidak boleh kosong.',
            'kuota.required' => 'Kuota Minimal tidak boleh kosong.',
            'kuota.numeric' => 'Kuota Minimal harus berupa angka.',
            'kategoriDiklat.required' => 'kategori diklat tidak bolek kosong'
        ];
        $request->validate([
            'img' => 'required|image|file|max:1024',
            'kategoriDiklat' => 'required',
            'kategoriDiklat' => 'required',
            'deskripsi' => 'required',
            'nama_diklat' => 'required',
            'harga' => 'required',
            'kuota' => 'required|numeric'
        ], $messages);

        if ($request->hasFile('img')) {
            $image = $request->file('img')->store('LanPage');
            $harga = preg_replace("/[^0-9]/", "", $request->input('harga'));
            Diklat::create([
                'gambar' => $image,
                'id_kategori_diklat' => $request->kategoriDiklat,
                'status' => 'belum full',
                'deskripsi' => $request->deskripsi,
                'nama_diklat' => $request->nama_diklat,
                'harga' => $harga,
                'kuota_minimal' => $request->kuota,
            ]);
            return redirect('/kelDiklat')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return back()->withErrors(['msg' => 'Tidak ada file yang diunggah.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Diklat $kelDiklat)
    {
        // dd($kelDiklat);
        $diklatData = Diklat::getDiklatWithKategori($kelDiklat->id);
        // Kembalikan view dengan data diklat dan kategorinya
        return view('kelola.kelolaDiklat.show', ['diklatData' => $diklatData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diklat $kelDiklat)
    {
        $getKategori = KatDiklat::selectAll();
        return view('kelola.kelolaDiklat.editForm',  [
            'kelDiklat' => $kelDiklat,
            'getKategori' => $getKategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diklat $kelDiklat)
    {
        $messages = [
            'img.required' => 'Data tidak boleh kosong.',
            'img.image' => 'File harus berupa gambar.',
            'img.file' => 'File harus berupa berkas.',
            'img.max' => 'Ukuran file tidak boleh melebihi 1 MB.',
            'status.required' => 'Status tampilan harus dipilih.',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong.', // Pesan untuk deskripsi
            'nama_diklat.required' => 'Nama Diklat tidak boleh kosong.',
            'harga.required' => 'Harga tidak boleh kosong.',
            'kuota.required' => 'Kuota Minimal tidak boleh kosong.',
            'kuota.numeric' => 'Kuota Minimal harus berupa angka.',
            'kategoriDiklat.required' => 'Kategori Diklat tidak boleh kosong'
        ];
        $request->validate([
            'img' => 'nullable|image|file|max:1024',
            'kategoriDiklat' => 'required',
            'deskripsi' => 'required', // Aturan validasi untuk deskripsi
            'nama_diklat' => 'required',
            'harga' => 'required',
            'kuota' => 'required|numeric'
        ], $messages);
        // Menghapus gambar lama jika ada pembaruan gambar baru
        if ($request->hasFile('img')) {
            Storage::delete($kelDiklat->gambar);
        }
        // Mengunggah gambar baru jika ada
        if ($request->hasFile('img')) {
            $image = $request->file('img')->store('LanPage');
        } else {
            $image = $kelDiklat->gambar;
        }
        // Update data Diklat
        $harga = preg_replace("/[^0-9]/", "", $request->input('harga'));
        $kelDiklat->update([
            'gambar' => $image,
            'id_kategori_diklat' => $request->kategoriDiklat,
            'deskripsi' => $request->deskripsi,
            'nama_diklat' => $request->nama_diklat,
            'harga' => $harga,
            'kuota_minimal' => $request->kuota,
        ]);
        return redirect('/kelDiklat')->with('success', 'Data berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Diklat $kelDiklat)
    {
        // Menghapus gambar dari penyimpanan
        Storage::delete($kelDiklat->gambar);

        // Menghapus entri Diklat dari database
        $kelDiklat->delete();
        return redirect('/kelDiklat')->with('success', 'Data berhasil dihapus!');
    }
}
