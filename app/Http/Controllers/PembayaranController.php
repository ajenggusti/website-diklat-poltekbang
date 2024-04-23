<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Support\Str;
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
        // dd($request);
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
        $request->validate([
            'jenis_pembayaran' => 'required', 
        ], [
            'jenis_pembayaran.required' => 'Jenis pembayaran harus dipilih.',
        ]);
        $pembayaran = Pembayaran::create([
            'order_id' => 'ORD_' . rand(100000, 999999), // Menggunakan UUID untuk nilai id
            'id_pendaftaran' => $request->input('id_pendaftaran'),
            'jenis_pembayaran' => $request->input('jenis_pembayaran'),
            'total_harga' => $request->input('total_harga'),
            'metode_pembayaran' => "online",
            'created_at' => now(),
        ]);
        // dd($pembayaran);
        // $pembayaran->id = $idGenerate;
        // $dataBaru = $pembayaran->fresh();
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $pembayaran->order_id,
                'gross_amount' => $pembayaran->total_harga,
            ),
            'customer_details' => array(
                'nama_lengkap' => $pembayaran->pendaftaran->nama_lengkap,
                'email' => $pembayaran->pendaftaran->email,
                'phone' => $pembayaran->pendaftaran->no_hp,
            ),
        );
        // dd($params);

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // return redirect('/kelPembayaran/create?id=' . $pembayaran->pendaftaran->id)
        // ->with(['snapToken' => $snapToken, 'pembayaran' => $pembayaran]);
        return view('kelola.kelolaPembayaran.form2', ['snapToken' => $snapToken, 'pembayaran' => $pembayaran]);
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

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            $pembayaran = Pembayaran::where('order_id', $request->order_id)->first();
            if ($pembayaran->jenis_pembayaran == "diklat") {
                $pendaftaran = Pendaftaran::find($pembayaran->id_pendaftaran);
                $pendaftaran->update(['status_pembayaran_diklat' => "Lunas"]);
            } elseif ($pembayaran->jenis_pembayaran == "pendaftaran") {
                $pendaftaran = Pendaftaran::find($pembayaran->id_pendaftaran);
                $pendaftaran->update(['status_pembayaran_daftar' => "Lunas"]);
            } else {
                $pendaftaran = Pendaftaran::find($pembayaran->id_pendaftaran);
            }
        }
    }
}
