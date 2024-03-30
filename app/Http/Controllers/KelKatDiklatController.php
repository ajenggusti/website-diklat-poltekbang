<?php

namespace App\Http\Controllers;

use App\Models\KatDiklat;
use Illuminate\Http\Request;

class KelKatDiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = KatDiklat::selectAll();
        return view('kelola.kelolaKatDiklat.index', ['datas' => $datas]);
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
            'katDiklat.required' => 'Kategori Diklat wajib diisi.',
            'katDiklat.unique' => 'Kategori Diklat sudah ada.'
        ];
        $request->validate([
            'katDiklat' => 'required|unique:kategori_diklat,kategori_diklat',
        ], $messages);
        KatDiklat::create(['kategori_diklat' => $request->katDiklat]);
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
            'katDiklat.required' => 'Kategori Diklat wajib diisi.',
            'katDiklat.unique' => 'Kategori Diklat sudah ada.'
        ];

        $request->validate([
            'katDiklat' => 'required|unique:kategori_diklat,kategori_diklat,' . $kelKatDiklat->id,
        ], $messages);

        $kelKatDiklat->update([
            'kategori_diklat' => $request->katDiklat,
        ]);

        return redirect('/kelKatDiklat')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KatDiklat $kelKatDiklat)
    {
        KatDiklat::destroy($kelKatDiklat->id);
        return redirect('/kelKatDiklat')->with('success', 'Data berhasil dihapus!');
    }
}
