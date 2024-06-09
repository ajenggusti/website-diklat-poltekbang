<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Dompdf\Dompdf;
use Dompdf\Options;
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
        $userId = Auth::user();
        // dd($userId->id);
        $datas = Pendaftaran::where('id_user', $userId->id)->get();
        // dd($datas);
        return view('utama.riwayat', [
            'datas' => $datas,
 
        ]);
    }
    public function invoiceDetail($id)
    {
        $data = Pendaftaran::find($id);
        $countData = $data ? 1 : 0;
        return view('utama.invoice', ['data' => $data]);
    }
    public function detailRiwayat($id)
    {
        $data = Pendaftaran::find($id);
        $this->authorize('view', $data);
        $user = Auth::user();
        // if ($user->id != $data->id_user) {
        //     abort(403, 'Unauthorized action.');
        // }
        $countData = $data ? 1 : 0;
        return view('utama.detailRiwayat', ['data' => $data]);
    }

    public function viewPdf($id)
    {
        $data = Pendaftaran::findOrFail($id);
        $user = Auth::user();
        // $tabelPembayaran = Pembayaran::get($id);
        $tabelPembayaran = Pembayaran::where('id_pendaftaran', $id)->get();
        // dd($tabelPembayaran);

        $idPembayaranDaftar = null; //yang dikirim ini buat pendaftaran lunas
        $latestUpdatedAtDaftar = null;
        foreach ($tabelPembayaran as $tb) {
            if ($tb->status == "Lunas" && $tb->jenis_pembayaran == "pendaftaran") {
                $idPembayaranDaftar = $tb->id;
                break;
            } elseif ($tb->jenis_pembayaran == "pendaftaran") {
                if ($latestUpdatedAtDaftar === null || $tb->updated_at > $latestUpdatedAtDaftar) {
                    $latestUpdatedAtDaftar = $tb->updated_at;
                    $idPembayaranDaftar = $tb->id;
                }
            }
        }
        // dd($idPembayaranDaftar);
        $idPembayaranDiklat = null;
        $latestUpdatedAtDiklat = null;
        foreach ($tabelPembayaran as $tb) {
            if ($tb->status == "Lunas" && $tb->jenis_pembayaran == "diklat") {
                $idPembayaranDiklat = $tb->id;
                break;
            } elseif ($tb->jenis_pembayaran == "diklat") {
                if ($latestUpdatedAtDiklat === null || $tb->updated_at > $latestUpdatedAtDiklat) {
                    $latestUpdatedAtDiklat = $tb->updated_at;
                    $idPembayaranDiklat = $tb->id;
                }
            }
        }
        // dd($idPembayaranDiklat);
        if ($idPembayaranDiklat != null) {
            $dataDiklat = Pembayaran::findOrFail($idPembayaranDiklat);
        } else {
            $dataDiklat = Pendaftaran::findOrFail($id);
        }
        if ($idPembayaranDaftar != null) {
            $dataPendaftaran = Pembayaran::findOrFail($idPembayaranDaftar);
        } else {
            $dataPendaftaran = Pendaftaran::findOrFail($id);
        }
        // dd($dataDiklat);

        // dd($idPembayaranDaftar);
        // dd($dataPendaftaran);

        if ($user->id != $data->id_user) {
            abort(403, 'Unauthorized action.');
        }
        if (!$data) {
            abort(404);
        }
        // dd($data);

        // $halaman1 = view('invoice.hal1', ['data' => $data])->render();
        $halaman2 = view('invoice.hal2', [
            'dataPendaftaran' => $dataPendaftaran,
            'idPembayaranDaftar' => $idPembayaranDaftar

        ])->render();
        $halaman3 = view('invoice.hal3', [
            'dataDiklat' => $dataDiklat,
            'idPembayaranDiklat' => $idPembayaranDiklat
        ])->render();

        $pdf = PDF::loadHTML($halaman2 . $halaman3);
        // $pdf = PDF::loadHTML( $halaman2);

        // Mengirim PDF ke browser
        return $pdf->stream('invoice.pdf');
    }




    public function buktiPembayaran(Request $request)
    {
        // dd($request);
        $id = $request->id;
        $pembayarans = Pembayaran::where('id_pendaftaran', $id)->get();
        // dd($pembayarans);
        return view('utama.buktiPembayaran', ['pembayarans' => $pembayarans]);
    }
}