<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $datas = Pendaftaran::where('id_user', $userId)->get();
        $dataDiklat = Pendaftaran::getDiklat();
        return view('utama.riwayat', [
            'datas' => $datas,
            'dataDiklat' => $dataDiklat,
        ]);
    }
    public function detailRiwayat($id)
    {
        $data = Pendaftaran::find($id);
        $countData = $data ? 1 : 0;
        return view('utama.detailRiwayat', ['data' => $data]);
    }

    public function buktiPembayaran(Request $request)
    {
        // dd($request);
        $id = $request->id;
        $pembayarans = Pembayaran::where('id_pendaftaran', $id)->get(); 
        // dd($pembayaran);
        return view('utama.buktiPembayaran', ['pembayarans' => $pembayarans]); 
    }
}
