<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Pendaftaran::class);
        $datas = Pendaftaran::get();
        return view('kelola.kelolaPendaftaranKeuangan.index', [
            'datas'=>$datas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $kelPendaftaranKeuangan)
    {
        // dd($kelPendaftaranKeuangan);
        $pendaftaran = Pendaftaran::findOrFail($kelPendaftaranKeuangan->id);
        $this->authorize('view', $kelPendaftaranKeuangan);
        return view('kelola.kelolaPendaftaranKeuangan.show', [
            'pendaftaran'=>$pendaftaran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $kelPendaftaranKeuangan)
    {
        // dd($kelPendaftaranKeuangan);
        $kelPendaftaran=Pendaftaran::findOrFail($kelPendaftaranKeuangan->id);
        $dtDiklats = Diklat::all();
        return view('kelola.kelolaPendaftaranKeuangan.editAsAdmin', [
            'kelPendaftaran' => $kelPendaftaran,
            'dtDiklats' => $dtDiklats
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $kelPendaftaranKeuangan)
    {
        // dd($id);
        // dd($request);

        $id=$kelPendaftaranKeuangan->id;
        // dd($id);
        $oldData = Pendaftaran::find($id);
        // update pembayaran dari admin ============================================================================
        $oldPotongan = $oldData->potongan_admin ? (int)preg_replace("/[^0-9]/", "", $oldData->potongan_admin) : 0;
        $newPotongan = $request->potongan ? (int)preg_replace("/[^0-9]/", "", $request->potongan) : 0;
        $totalPotongan = $oldPotongan + $newPotongan;
        $pembayaran_update = Pembayaran::where('id_pendaftaran', $id)
            ->where('jenis_pembayaran', 'diklat')
            ->where('metode_pembayaran', 'offline')
            ->first();
        // dd($pembayaran_update);
        // dd($totalPotongan);
        if ($pembayaran_update !== null) {
            if ($request->status_pembayaran_diklat !== $pembayaran_update->status) {
                $pembayaran_update->update([
                    'updated_at' => now(),
                    'status' => $request->status_pembayaran_diklat
                ]);
                $oldData->update([
                    'status_pembayaran_diklat' => $request->status_pembayaran_diklat
                ]);
            }
        } else {
            $oldData->update([
                'potongan_admin' => $totalPotongan ?: null,
                'harga_diklat' => preg_replace("/[^0-9]/", "", $request->total_harga),
                'status_pembayaran_diklat' => $request->status_pembayaran_diklat
            ]);
        }
        return redirect('/kelPendaftaranKeuangan')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        //
    }
}
