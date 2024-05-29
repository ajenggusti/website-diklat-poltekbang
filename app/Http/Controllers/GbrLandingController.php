<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gambar_navbar;
use Illuminate\Support\Facades\Storage;

class GbrLandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Gambar_navbar::all();
        // dd($datas[6]->gambar_navbar);
        return view('kelola.kelolaGbrLandingPage.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelola.kelolaGbrLandingPage.formGbrLanding');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'img.required' => 'Data tidak boleh kosong.',
            'img.image' => 'File harus berupa gambar.',
            'img.file' => 'File harus berupa berkas.',
            'img.max' => 'Ukuran file tidak boleh melebihi 1 MB.',
            'status.required' => 'Status tampilan harus dipilih.'
        ];

        $request->validate([
            'img' => 'required|image|file|max:1024',
            'status' => 'required|in:tampilkan,sembunyikan'
        ], $messages);

        if ($request->hasFile('img')) {

            $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move('storage/LanPage', $image);
            // $image = $request->file('img')->store('public/LanPage');
            Gambar_navbar::create([
                'gambar_navbar' => $image,
                'status' => $request->status
            ]);

            return redirect('/gbrLandingPage')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return back()->withErrors(['msg' => 'Tidak ada file yang diunggah.'])->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Gambar_navbar $gbrLandingPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gambar_navbar $gbrLandingPage)
    {
        $data = ['data' => $gbrLandingPage];
        return view('kelola.kelolaGbrLandingPage.editFormGbrLanding', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gambar_navbar $gbrLandingPage)
    {
        $messages = [
            'img.image' => 'File harus berupa gambar.',
            'img.file' => 'File harus berupa berkas.',
            'img.max' => 'Ukuran file tidak boleh melebihi 1 MB.',
            'status.required' => 'Status tampilan harus dipilih.'
        ];

        $request->validate([
            'img' => 'nullable|image|file|max:1024',
            'status' => 'required|in:tampilkan,sembunyikan'
        ], $messages);

        if ($request->hasFile('img')) {
            
            $filePath = public_path('storage/' . $gbrLandingPage->gambar_navbar);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move('storage/LanPage', $image);

            $gbrLandingPage->update([
                'gambar_navbar' => $image,
                'status' => $request->status
            ]);
        } else {
            $gbrLandingPage->update([
                'status' => $request->status
            ]);
        }

        return redirect('/gbrLandingPage')->with('success', 'Data berhasil diperbarui!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gambar_navbar $gbrLandingPage)
    {
        // Storage::delete($gbrLandingPage->gambar_navbar);
        // $gbrLandingPage->delete();
        $filePath = public_path('storage/' . $gbrLandingPage->gambar_navbar);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $gbrLandingPage->delete();

        return redirect('/gbrLandingPage')->with('success', 'Data berhasil dihapus!');
    }
}
