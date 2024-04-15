<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayarans = Pembayaran::with('pendaftaran')->get();
        return view('kelola.kelolaPembayaran.index', ['pembayarans' => $pembayarans]);
    }

    /**
     * Show the form for creating a new resource.
     */


    public function create(Request $request)
    {
        $id = $request->query('id');
        $pendaftaran = Pendaftaran::findOrFail($id);
        // dd($pendaftaran);
        return view('kelola.kelolaPembayaran.form', ['pendaftaran' => $pendaftaran]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pembayaran = new Pembayaran();
        $pembayaran->id_pendaftaran = $request->id_pendaftaran;
        $pembayaran->jenis_pembayaran = $request->jenis_pembayaran;
        $pembayaran->created_at = now(); // Menambahkan waktu saat ini ke kolom created_at

        $pembayaran->save();

        if ($request->jenis_pembayaran == 'diklat') {
            $pendaftaran = Pendaftaran::find($request->id_pendaftaran);
            $pendaftaran->status_pembayaran_diklat = 'Dicek';
            $pendaftaran->save();
        } elseif ($request->jenis_pembayaran == 'pendaftaran') {
            $pendaftaran = Pendaftaran::find($request->id_pendaftaran);
            $pendaftaran->status_pembayaran_daftar = 'Dicek';
            $pendaftaran->save();
        }

        return redirect('/riwayat')->with('success', 'Pembayaran berhasil disimpan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $kelPembayaran)
    {
        // dd($kelPembayaran);
        return view('kelola.kelolaPembayaran.detailPembayaran', [
            'kelPembayaran' => $kelPembayaran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $kelPembayaran)
    {
        $dtDiklats = Diklat::all();
        return view('kelola.kelolaPembayaran.editAsAdmin',[
            'kelPembayaran' => $kelPembayaran,
            'dtDiklats' => $dtDiklats
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $kelPembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $kelPembayaran)
    {
        Storage::delete($kelPembayaran->bukti_pembayaran);
        $kelPembayaran->delete();
        return redirect('/kelPembayaran')->with('success', 'Data berhasil dihapus!');
    }
}
