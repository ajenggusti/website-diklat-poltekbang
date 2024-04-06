<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

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
         // Create a new instance of the Pembayaran model and populate it with the request data
        $pembayaran = new Pembayaran();
        $pembayaran->id_pendaftaran = $request->id_pendaftaran;
        $pembayaran->jenis_pembayaran = $request->jenis_pembayaran;
        
        // Save the new instance to the database
        $pembayaran->save();

        // If jenis_pembayaran is 'diklat', update status_pembayaran_diklat in the pendaftarans table
        if ($request->jenis_pembayaran == 'diklat') {
            $pendaftaran = Pendaftaran::find($request->id_pendaftaran);
            $pendaftaran->status_pembayaran_diklat = 'Dicek';
            $pendaftaran->save();
        }
        elseif ($request->jenis_pembayaran == 'pendaftaran') {
        $pendaftaran = Pendaftaran::find($request->id_pendaftaran);
        $pendaftaran->status_pembayaran_daftar = 'Dicek';
        $pendaftaran->save();
        }
        return redirect('/riwayat')->with('success', 'Pembayaran berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $kelPendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $kelPendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $kelPendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $kelPendaftaran)
    {
        //
    }
}
