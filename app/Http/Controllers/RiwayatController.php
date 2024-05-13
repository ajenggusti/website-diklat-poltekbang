<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;

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
    public function viewPdf($id)
    {
        $data = Pendaftaran::findOrFail($id);
        
        // Pastikan data ditemukan
        if(!$data) {
            abort(404);
        }
        $pdf = PDF::loadView('utama.detailRiwayat', ['data' => $data]);
        
        // Unduh PDF
        return $pdf->download('invoice.pdf');
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
