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
            'dataDiklat'=>$dataDiklat,
        ]);
    }
    public function detailRiwayat($id){
        $data = Pendaftaran::find($id);
        return view('utama.detailRiwayat', ['data' => $data]);
    }

    public function buktiPembayaran($id){
        $pembayarans = Pembayaran::where('id_pendaftaran', $id)->get(); // Mendapatkan semua record yang sesuai dengan $id
        // dd($pembayaran);
        return view('utama.buktiPembayaran', ['pembayarans' => $pembayarans]); // Mengirimkan data pembayaran ke view
    }
}
