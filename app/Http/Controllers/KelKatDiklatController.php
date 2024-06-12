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
        $this->authorize('viewAny', KatDiklat::class);
        $datas = KatDiklat::get();
        $datas2 = KatDiklat::get();
        return view('kelola.kelolaKatDiklat.index', [
            'datas' => $datas,
            'datas2' => $datas2
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', KatDiklat::class);
        return view('kelola.kelolaKatDiklat.formKatDiklat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', KatDiklat::class);
        $messages = [
            'img.image' => 'File harus berupa gambar.',
            'img.file' => 'File harus berupa berkas.',
            'img.max' => 'Ukuran file tidak boleh melebihi 2MB.',
            'katDiklat.required' => 'Kategori Diklat wajib diisi.',
            'katDiklat.unique' => 'Kategori Diklat sudah ada.'
        ];
        $request->validate([
            'img' => 'nullable|image|file|max:2024',
            'katDiklat' => 'required|unique:kategori_diklat,kategori_diklat',
        ], $messages);
        if ($request->hasFile('img')) {
            $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move('storage/LanPage', $image);
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
        $this->authorize('update', $kelKatDiklat);
        // dd($kelKatDiklat);
        $data = ['data' => $kelKatDiklat];
        return view('kelola.kelolaKatDiklat.editFormKatDiklat', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KatDiklat  $kelKatDiklat)
    {
        $this->authorize('update', $kelKatDiklat);
        $messages = [
            'img.image' => 'File harus berupa gambar.',
            'img.file' => 'File harus berupa berkas.',
            'img.max' => 'Ukuran file tidak boleh melebihi 2 MB.',
            'katDiklat.required' => 'Kategori Diklat wajib diisi.',
            'katDiklat.unique' => 'Kategori Diklat sudah ada.'
        ];

        $request->validate([
            'img' => 'nullable|image|file|max:2024',
            'katDiklat' => 'required|unique:kategori_diklat,kategori_diklat,' . $kelKatDiklat->id,
        ], $messages);

        if ($request->hasFile('img')) {
            // Hapus gambar sebelumnya jika ada
            if ($kelKatDiklat->gambar) {
                $filePath = public_path('storage/' . $kelKatDiklat->gambar);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move('storage/LanPage', $image);
        } else {

            if ($kelKatDiklat->gambar) {
                $image = $kelKatDiklat->gambar;
            } else {

                $image = null;
            }
        }
        if ($request->default == 'ya') {
            KatDiklat::where('default', 'ya')
                ->where('id', '!=', $kelKatDiklat->id)
                ->update(['default' => 'tidak']);
        }
        $kelKatDiklat->update([
            'kategori_diklat' => $request->katDiklat,
            'gambar' => $image,
            'default' => $request->default
        ]);

        return redirect('/kelKatDiklat')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KatDiklat $kelKatDiklat)
    {
        $this->authorize('delete', $kelKatDiklat);
        $filePath = public_path('storage/' . $kelKatDiklat->gambar);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        KatDiklat::destroy($kelKatDiklat->id);
        return redirect('/kelKatDiklat')->with('success', 'Data berhasil dihapus!');
    }
}
