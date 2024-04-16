<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\GambarDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambarDiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = GambarDiklat::get();
        // dd($datas);
        return view('kelola.kelolaGambarDiklat.index',[
            'datas'=>$datas,
            
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $diklats=Diklat::get();
        return view('kelola.kelolaGambarDiklat.form',[
            'diklats'=>$diklats
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'diklat' => 'required',
            'img' => 'required|image|max:2048', // Maksimal 2MB
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'image' => 'Kolom :attribute harus berupa gambar.',
            'max' => 'Ukuran :attribute tidak boleh melebihi :max kilobytes.',
        ]);
    
        // Simpan data
        $gambar = new GambarDiklat();
        $gambar->id_diklat = $request->diklat === 'null' ? null : $request->diklat;
        
        // Upload gambar
        if ($request->file('img')) {
            $imagePath = $request->file('img')->store('LanPage');
            $gambar->gambar_navbar = $imagePath;
        }
    
        $gambar->save();
    
        // Redirect dengan pesan sukses
        return redirect('/kelGambarDiklat')->with('success', 'Data berhasil ditambahkan.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(GambarDiklat $kelGambarDiklat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GambarDiklat $kelGambarDiklat)
    {
        // dd($kelGambarDiklat);
        $diklats=Diklat::get();
        return view('kelola.kelolaGambarDiklat.editForm',[
            'kelGambarDiklat'=>$kelGambarDiklat,
            'diklats'=>$diklats
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GambarDiklat $kelGambarDiklat)
    {
        // Validasi input
        $request->validate([
            'img' => 'sometimes|image|max:2048', // Maksimal 2MB
        ], [
            'image' => 'Kolom :attribute harus berupa gambar.',
            'max' => 'Ukuran :attribute tidak boleh melebihi :max kilobytes.',
        ]);
    
        // Update data
        $kelGambarDiklat->id_diklat = $request->diklat === 'null' ? null : $request->diklat;
    
        // Jika ada gambar yang diupload, update gambar
        if ($request->hasFile('img')) {
            // Hapus gambar sebelumnya
            Storage::delete($kelGambarDiklat->gambar_navbar);
            
            // Upload gambar baru
            $imagePath = $request->file('img')->store('LanPage');
            $kelGambarDiklat->gambar_navbar = $imagePath;
        }
    
        $kelGambarDiklat->save();
    
        // Redirect dengan pesan sukses
        return redirect('/kelGambarDiklat')->with('success', 'Data berhasil diperbarui.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GambarDiklat $kelGambarDiklat)
    {
        Storage::delete($kelGambarDiklat->gambar_navbar);
        $kelGambarDiklat->delete();
        return redirect('/kelGambarDiklat')->with('success', 'Data berhasil dihapus!');
    }
}
