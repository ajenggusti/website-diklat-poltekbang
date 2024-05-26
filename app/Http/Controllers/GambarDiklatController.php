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
        $request->validate([
            'diklat' => 'required',
            'img' => 'required|image|max:2048', // Maksimal 2MB
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'image' => 'Kolom :attribute harus berupa gambar.',
            'max' => 'Ukuran :attribute tidak boleh melebihi :max kilobytes.',
        ]);
    
        $gambar = new GambarDiklat();
        $gambar->id_diklat = $request->diklat === 'null' ? null : $request->diklat;
        
        if ($request->file('img')) {
            // $image = $request->file('img')->store('LanPage');
            $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move('storage/LanPage', $image);
            $gambar->gambar_navbar = $image;
        }
    
        $gambar->save();
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
    
        $request->validate([
            'img' => 'sometimes|image|max:2048', 
        ], [
            'image' => 'Kolom :attribute harus berupa gambar.',
            'max' => 'Ukuran :attribute tidak boleh melebihi :max kilobytes.',
        ]);
    
        // Update data
        $kelGambarDiklat->id_diklat = $request->diklat === 'null' ? null : $request->diklat;
        if ($request->hasFile('img')) {
            // Storage::delete($kelGambarDiklat->gambar_navbar);
            // $imagePath = $request->file('img')->store('LanPage');
            $filePath = public_path('storage/' . $kelGambarDiklat->gambar_navbar);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move('storage/LanPage', $image);

            $kelGambarDiklat->gambar_navbar = $image;



        }
    
        $kelGambarDiklat->save();
        return redirect('/kelGambarDiklat')->with('success', 'Data berhasil diperbarui.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GambarDiklat $kelGambarDiklat)
    {
        // Storage::delete($kelGambarDiklat->gambar_navbar);
        $filePath = public_path('storage/' . $kelGambarDiklat->gambar_navbar);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        $kelGambarDiklat->delete();
        return redirect('/kelGambarDiklat')->with('success', 'Data berhasil dihapus!');
    }


    public function getTotalData() {
        $totalData = Diklat::count(); 
        return response()->json(['totalData' => $totalData]);
    }
    
}
