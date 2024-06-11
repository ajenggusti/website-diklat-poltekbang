<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\KatDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Diklat::class);
        $datas = Diklat::getKategori();
        $diklats = Diklat::get();
        return view('kelola.kelolaDiklat.index', [
            'datas' => $datas,
            'diklats' => $diklats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Diklat::class);
        $getKategori = KatDiklat::selectAll();
        return view('kelola.kelolaDiklat.form', ['getKategori' => $getKategori]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Diklat::class);

        $messages = [
            'img.image' => 'File harus berupa gambar.',
            'img.file' => 'File harus berupa berkas.',
            'img.max' => 'Ukuran file tidak boleh melebihi 2 MB.',
            'status.required' => 'Status tampilan harus dipilih.',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong.',
            'nama_diklat.required' => 'Nama Diklat tidak boleh kosong.',
            'harga.required' => 'Harga tidak boleh kosong.',
            'kuota.required' => 'Kuota Minimal tidak boleh kosong.',
            'kuota.numeric' => 'Kuota Minimal harus berupa angka.',
            'kategoriDiklat.required' => 'kategori diklat tidak boleh kosong',
            'whatsapp.required' => 'WhatsApp tidak boleh kosong.',
            'whatsapp.url' => 'WhatsApp harus berupa tautan yang valid.',
        ];

        $request->validate([
            'img' => 'nullable|image|file|max:2024',
            'kategoriDiklat' => 'required',
            'deskripsi' => 'required',
            'nama_diklat' => 'required',
            'harga' => 'required|regex:/^Rp\s\d{1,3}(?:\.\d{3})*(?:,\d{2})?$/',
            'kuota' => 'required|numeric',
            'whatsapp' => 'required|url',
        ], $messages);

        if ($request->hasFile('img')) {
            $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move('storage/LanPage', $image);
        } else {
            $image = null;
        }

        $harga = preg_replace("/[^0-9]/", "", $request->input('harga'));

        if ($request->default == 'ya') {
            Diklat::where('default', 'ya')->update(['default' => 'tidak']);
        }

        Diklat::create([
            'gambar' => $image,
            'id_kategori_diklat' => $request->kategoriDiklat,
            'status' => 'belum full',
            'deskripsi' => $request->deskripsi,
            'nama_diklat' => $request->nama_diklat,
            'whatsapp' => $request->whatsapp,
            'harga' => $harga,
            'kuota_minimal' => $request->kuota,
            'default' => $request->default
        ]);

        return redirect('/kelDiklat')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diklat $kelDiklat)
    {
        $this->authorize('view', $kelDiklat);
        $diklatData = Diklat::getDiklatWithKategori($kelDiklat->id);
        $allDiklatData = Diklat::get();

        return view('kelola.kelolaDiklat.show', [
            'diklatData' => $diklatData,
            'allDiklatData' => $allDiklatData
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diklat $kelDiklat)
    {
        $this->authorize('update', $kelDiklat);
        $getKategori = KatDiklat::selectAll();
        return view('kelola.kelolaDiklat.editForm', [
            'kelDiklat' => $kelDiklat,
            'getKategori' => $getKategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diklat $kelDiklat)
    {
        $this->authorize('update', $kelDiklat);

        $messages = [
            'img.image' => 'File harus berupa gambar.',
            'img.file' => 'File harus berupa berkas.',
            'img.max' => 'Ukuran file tidak boleh melebihi 2 MB.',
            'status.required' => 'Status tampilan harus dipilih.',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong.',
            'nama_diklat.required' => 'Nama Diklat tidak boleh kosong.',
            'harga.required' => 'Harga tidak boleh kosong.',
            'kuota.required' => 'Kuota Minimal tidak boleh kosong.',
            'kuota.numeric' => 'Kuota Minimal harus berupa angka.',
            'kategoriDiklat.required' => 'Kategori Diklat tidak boleh kosong',
            'whatsapp.required' => 'WhatsApp tidak boleh kosong.',
            'whatsapp.url' => 'WhatsApp harus berupa tautan yang valid.'
        ];

        $request->validate([
            'img' => 'nullable|image|file|max:2024',
            'kategoriDiklat' => 'required',
            'deskripsi' => 'required',
            'nama_diklat' => 'required',
            'harga' => 'required',
            'kuota' => 'required|numeric',
            'whatsapp' => 'required|url',
        ], $messages);

        if ($request->hasFile('img')) {
            if ($kelDiklat->gambar) {
                $filePath = public_path('storage/' . $kelDiklat->gambar);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move('storage/LanPage', $image);
        } else {
            $image = $kelDiklat->gambar ?? null;
        }

        $harga = preg_replace("/[^0-9]/", "", $request->input('harga'));

        if ($request->default == 'ya') {
            Diklat::where('default', 'ya')
                ->where('id', '!=', $kelDiklat->id)
                ->update(['default' => 'tidak']);
        }

        $kelDiklat->update([
            'gambar' => $image,
            'id_kategori_diklat' => $request->kategoriDiklat,
            'deskripsi' => $request->deskripsi,
            'nama_diklat' => $request->nama_diklat,
            'harga' => $harga,
            'whatsapp' => $request->whatsapp,
            'kuota_minimal' => $request->kuota,
            'default' => $request->default
        ]);

        return redirect('/kelDiklat')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diklat $kelDiklat)
    {
        $this->authorize('delete', $kelDiklat);

        if ($kelDiklat->gambar) {
            $filePath = public_path('storage/' . $kelDiklat->gambar);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $kelDiklat->delete();

        return redirect('/kelDiklat')->with('success', 'Data berhasil dihapus!');
    }
}