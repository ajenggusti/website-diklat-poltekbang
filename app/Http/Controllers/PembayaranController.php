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
            'jenis_pembayaran' => 'required', // Jenis pembayaran harus dipilih
        ], [
            'jenis_pembayaran.required' => 'Jenis pembayaran harus dipilih.',
        ]);
        $pembayaran = new Pembayaran();
        $pembayaran->id_pendaftaran= $request->id_pendaftaran;
        $pembayaran->jenis_pembayaran = $request->jenis_pembayaran;
        $pembayaran->total_harga = $request->total_harga;
        $pembayaran->created_at = now(); 
        $idGenerate ='ORD_' . rand(100000, 999999);
        dd($idGenerate);
        $pembayaran->id = $idGenerate;
        $pembayaran->save();
        $dataBaru = $pembayaran->fresh();
       
        // dd($pembayaran->id);
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
                'order_id' => $dataBaru->id,
                'gross_amount' => $pembayaran->total_harga,
            ),
            'customer_details' => array(
                'first_name' => $pembayaran->pendaftaran->nama_depan,
                'last_name' => $pembayaran->pendaftaran->nama_belakang,
                'email' => $pembayaran->pendaftaran->email,
                'phone' => $pembayaran->pendaftaran->no_hp,
            ),
        );
        dd($params);

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

    public function callback(Request $request){
        $serverKey=config('midtrans.server_key');
        $hashed=hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            $pembayaran = Pembayaran::find($request->order_id);
            if ($pembayaran->jenis_pembayaran == "diklat") {
                $pendaftaran= Pendaftaran::find($pembayaran->id_pendaftaran);
                // $pendaftaran = $pembayaran->pendaftaran;
                $pendaftaran->update(['status_pembayaran_diklat' => "Paid"]);
            }elseif ($pembayaran->jenis_pembayaran == "pendaftaran") {
                $pendaftaran= Pendaftaran::find($pembayaran->id_pendaftaran);
                // $pendaftaran = $pembayaran->pendaftaran;
                $pendaftaran->update(['status_pembayaran_daftar' => "Paid"]);
            }else{
                $pendaftaran= Pendaftaran::find($pembayaran->id_pendaftaran);
                // return response()->json(['data' => $pendaftaran, 'pembayaran' => $pembayaran]);
        }}
    }
}




