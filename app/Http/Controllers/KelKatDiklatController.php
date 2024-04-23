<?php

namespace App\Http\Controllers;

use App\Models\KatDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelKatDiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = KatDiklat::get();
        $datas2 = KatDiklat::get();
        return view('kelola.kelolaKatDiklat.index', [
            'datas' => $datas,
            'datas2'=>$datas2
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelola.kelolaKatDiklat.formKatDiklat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'img.image' => 'File harus berupa gambar.',
            'img.file' => 'File harus berupa berkas.',
            'img.max' => 'Ukuran file tidak boleh melebihi 1 MB.',
            'katDiklat.required' => 'Kategori Diklat wajib diisi.',
            'katDiklat.unique' => 'Kategori Diklat sudah ada.'
        ];
        $request->validate([
            'img' => 'nullable|image|file|max:1024',
            'katDiklat' => 'required|unique:kategori_diklat,kategori_diklat',
        ], $messages);
        if ($request->hasFile('img')) {
            $image = $request->file('img')->store('LanPage');
        } else {
            $image = null;
        }

        if ($request->default == 'ya') {
            KatDiklat::where('default', 'ya')->update(['default' => 'tidak']);
        }
        KatDiklat::create([
            'gambar' => $image,
            'kategori_diklat' => $request->katDiklat,
            'default' => $request->default
        ]);
        return redirect('/kelKatDiklat')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KatDiklat $katDiklat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KatDiklat $kelKatDiklat)
    {
        // dd($kelKatDiklat);
        $data = ['data' => $kelKatDiklat];
        return view('kelola.kelolaKatDiklat.editFormKatDiklat', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KatDiklat  $kelKatDiklat)
    {
        $messages = [
            'img.image' => 'File harus berupa gambar.',
            'img.file' => 'File harus berupa berkas.',
            'img.max' => 'Ukuran file tidak boleh melebihi 1 MB.',
            'katDiklat.required' => 'Kategori Diklat wajib diisi.',
            'katDiklat.unique' => 'Kategori Diklat sudah ada.'
        ];

        $request->validate([
            'img' => 'nullable|image|file|max:1024',
            'katDiklat' => 'required|unique:kategori_diklat,kategori_diklat,' . $kelKatDiklat->id,
        ], $messages);

        if ($request->hasFile('img')) {
            // Hapus gambar sebelumnya jika ada
            if ($kelKatDiklat->gambar) {
                Storage::delete($kelKatDiklat->gambar);
            }
            // Simpan gambar yang baru diunggah
            $image = $request->file('img')->store('LanPage');
        } else {
            // Jika tidak ada gambar yang diunggah, gunakan gambar yang sudah ada
            if ($kelKatDiklat->gambar) {
                $image = $kelKatDiklat->gambar;
            } else {
                // Jika nilai sebelumnya null, maka gunakan null kembali
                $image = null;
            }
        }        
        if ($request->default == 'ya') {
            KatDiklat::where('default', 'ya')
            ->where('id', '!=', $kelKatDiklat->id) // tambahkan kondisi untuk tidak mengubah entri yang sedang diedit
            ->update(['default' => 'tidak']);
        }
        $kelKatDiklat->update([
            'kategori_diklat' => $request->katDiklat,
            'gambar' => $image,
            'default'=>$request->default
        ]);

        return redirect('/kelKatDiklat')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KatDiklat $kelKatDiklat)
    {
        Storage::delete($kelKatDiklat->gambar);
        KatDiklat::destroy($kelKatDiklat->id);
        return redirect('/kelKatDiklat')->with('success', 'Data berhasil dihapus!');
    }
}
