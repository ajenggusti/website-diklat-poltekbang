<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $id_pendaftaran = $request->query('id_pendaftaran');
        $jenis_pembayaran = $request->query('jenis_pembayaran');
        $total_harga = $request->query('total_harga');
        $pendaftaran = Pendaftaran::findOrFail($id_pendaftaran);
        //  dd($pendaftaran);
        return view('kelola.kelolaPembayaran.form', [
            'pendaftaran' => $pendaftaran,
            'id_pendaftaran' => $id_pendaftaran,
            'jenis_pembayaran' => $jenis_pembayaran,
            'total_harga' => $total_harga
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pembayaran = new Pembayaran();
        $pembayaran->id_pendaftaran = $request->id_pendaftaran;
        $pembayaran->jenis_pembayaran = $request->jenis_pembayaran;
        $pembayaran->total_harga = $request->total_harga;
        $pembayaran->created_at = now();
        $pembayaran->id = 'ORD_' . time() . '_' . rand(1000, 9999);
        dd($request);
        $pembayaran->save();

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $pembayaran->id,
                'gross_amount' => $pembayaran->total_harga,
            ),
            'customer_details' => array(
                'first_name' => $pembayaran->pendaftaran->nama_depan,
                'last_name' => $pembayaran->pendaftaran->nama_belakang,
                'email' => $pembayaran->pendaftaran->email,
                'phone' => $pembayaran->pendaftaran->no_hp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        session(['snapToken' => $snapToken]);
        // Redirect ke halaman pembayaran dengan menyertakan snapToken dan data pembayaran
        return view('nama_view')->with([
            'snapToken' => $snapToken,
            // sisa data yang ingin Anda lewatkan ke view
        ]);
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
        return view('kelola.kelolaPembayaran.editAsAdmin', [
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