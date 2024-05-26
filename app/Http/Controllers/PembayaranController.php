<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use App\Models\Diklat;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayarans = Pembayaran::where('status', 'Lunas')->get();
        $pemasukanKeseluruhan = Pembayaran::where('status', 'Lunas')->sum('total_harga');
        $formattedPemasukan = 'Rp ' . number_format($pemasukanKeseluruhan, 0, ',', '.');

        // dd($pembayarans);
        return view('kelola.kelolaPembayaran.index', [
            'pembayarans' => $pembayarans,
            'formattedPemasukan'=>$formattedPemasukan
        ]);
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
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
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
                'first_name' => $pembayaran->pendaftaran->nama_lengkap,
                'last_name' => '',
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
        // dd($request);
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            $pembayaran = Pembayaran::where('order_id', $request->order_id)->first();
            // dd($pembayaran);
            $currentTime = Carbon::now()->format('Y-m-d H:i:s');
            $paymentType = $request->payment_type;

            if ($paymentType == "qris") {
                $type = $request->issuer;
            } elseif ($paymentType == "bank_transfer") {
                $bank = $request->va_numbers[0]['bank'];
                $type = $request->payment_type . " " . $bank;
            } else {
                $type = $request->payment_type . " " . $request->bank;
            }

            // dd($paymentType);
            $pembayaran->update([
                'status' => "Menunggu pembayaran",
                'metode_pembayaran' => $type
            ]);

            if ($request->fraud_status == "accept") {
                if ($currentTime <= $request->expiry_time) {
                    if ($pembayaran->jenis_pembayaran == "diklat" && $request->transaction_status == "settlement" || $request->transaction_status == "capture") {
                        $pendaftaran = Pendaftaran::find($pembayaran->id_pendaftaran);
                        $pendaftaran->update([
                            'status_pembayaran_diklat' => "Lunas",
                            'updated_at_pembayaran_diklat' => $currentTime,
                            'jenis_pembayaran_diklat' => $type,
                        ]);
                        $pembayaran->update([
                            'status' => "Lunas",
                            'metode_pembayaran' => $type
                        ]);
                    } elseif ($pembayaran->jenis_pembayaran == "pendaftaran" && $request->transaction_status == "settlement" || $request->transaction_status == "capture") {
                        $pendaftaran = Pendaftaran::find($pembayaran->id_pendaftaran);
                        $pendaftaran->update([
                            'status_pembayaran_daftar' => "Lunas",
                            'updated_at_pembayaran_daftar' => $currentTime,
                            'jenis_pembayaran_daftar' => $type,
                        ]);
                        $pembayaran->update([
                            'status' => "Lunas",
                            'metode_pembayaran' => $type
                        ]);
                    }
                    elseif($pembayaran->jenis_pembayaran == "diklat" && $request->transaction_status == "pending"){
                        $pendaftaran = Pendaftaran::find($pembayaran->id_pendaftaran);
                        $pendaftaran->update([
                            // 'status_pembayaran_diklat' => "Lunas",
                            'updated_at_pembayaran_diklat' => $currentTime,
                            'jenis_pembayaran_diklat' => $paymentType,
                        ]);
                        $pembayaran->update([
                            // 'status' => "Menunggu pembayaran",
                            'metode_pembayaran' => $paymentType
                        ]);
                    }elseif ($pembayaran->jenis_pembayaran == "pendaftaran" && $request->transaction_status == "pending") {
                        $pendaftaran = Pendaftaran::find($pembayaran->id_pendaftaran);
                        $pendaftaran->update([
                            // 'status_pembayaran_daftar' => "Lunas",
                            'updated_at_pembayaran_daftar' => $currentTime,
                            'jenis_pembayaran_daftar' => $paymentType,
                        ]);
                        $pembayaran->update([
                            // 'status' => "Lunas",
                            'metode_pembayaran' => $paymentType
                        ]);
                    }
                } else {
                    if ($pembayaran->jenis_pembayaran == "diklat") {
                        $pembayaran->update([
                            'status' => "kadaluarsa",
                            'metode_pembayaran' => $type
                        ]);
                    } elseif ($pembayaran->jenis_pembayaran == "pendaftaran") {
                        $pembayaran->update([
                            'status' => "kadaluarsa",
                            'metode_pembayaran' => $type
                        ]);
                    } else {
                        $pendaftaran = Pendaftaran::find($pembayaran->id_pendaftaran);
                    }
                }
            }
        }
    }

    // untuk pembayaran pendaftaran ----------------------------------------------------------------------
    public function savePendaftaran(Request $request)
    {
        // dd($request);
        $id = $request->id;
        // dd($id);
        // $pendaftaran = Pendaftaran::findOrFail($id);
        // dd($pendaftaran);
        $pembayaran = Pembayaran::create([
            'order_id' => 'ORD_' . rand(100000, 999999),
            'id_pendaftaran' => $id,
            'jenis_pembayaran' => "pendaftaran",
            'total_harga' => "150000",
            'metode_pembayaran' => "online",
            'status' => "Menunggu pembayaran",
            'created_at' => now(),
        ]);
        // dd($pembayaran);
        // $pembayaran->id = $idGenerate;
        // $dataBaru = $pembayaran->fresh();
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
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
                'first_name' => $pembayaran->pendaftaran->nama_lengkap,
                'last_name' => '',
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

    // untuk pembayaran diklat ----------------------------------------------------------------------
    public function createDiklat(Request $request)
    {
        // dd($request);
        $id = $request->id;
        // dd($id);
        $pendaftaran = Pendaftaran::findOrFail($id);
        // dd($pendaftaran);
        return view('kelola.kelolaPembayaran.formOfOn', [
            'pendaftaran' => $pendaftaran
        ]);
    }
    public function saveDiklat(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $pendaftaran = Pendaftaran::findOrFail($id);
        // dd($pendaftaran->harga_diklat);
        $pembayaran = Pembayaran::create([
            'order_id' => 'ORD_' . rand(100000, 999999),
            'id_pendaftaran' => $id,
            'jenis_pembayaran' => "diklat",
            'total_harga' => $pendaftaran->harga_diklat,
            'metode_pembayaran' => "online",
            'status' => "Menunggu pembayaran",
            'created_at' => now(),
        ]);
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
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
                'first_name' => $pembayaran->pendaftaran->nama_lengkap,
                'last_name' => '',
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
    public function storeDiklat(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|max:2048',
        ], [
            'required' => 'Kamu belum memasukkan bukti pembayaran.',
            'image' => 'Data yang dimasukkan harus berupa gambar.',
            'max' => 'Ukuran gambar tidak boleh melebihi :max kilobytes.',
        ]);
        $pendaftaran = Pendaftaran::find($id);
        $pembayaran = new Pembayaran();

        $pembayaran_update = Pembayaran::where('id_pendaftaran', $id)
            ->where('jenis_pembayaran', 'diklat')
            ->where('metode_pembayaran', 'offline')
            ->first();
        // dd($pembayaran_update);

        if ($pendaftaran->bukti_pembayaran) {
            if ($request->hasFile('bukti_pembayaran')) {
                // hapusfoto
                $filePath = public_path('storage/' . $pendaftaran->bukti_pembayaran);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                // savefoto
                $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->bukti_pembayaran->getClientOriginalExtension();
                $request->bukti_pembayaran->move('storage/LanPage', $image);

                
                $pendaftaran->update([
                    'bukti_pembayaran' => $image,
                    'status_pembayaran_diklat' => "Menunggu verifikasi"
                ]);
                $pembayaran_update->update([
                    'updated_at' => now()
                ]);
            }
        } else {
            if ($request->hasFile('bukti_pembayaran')) {
                $image = "LanPage/" . time() . '-' . uniqid() . '.' . $request->bukti_pembayaran->getClientOriginalExtension();
                $request->bukti_pembayaran->move('storage/LanPage', $image);
                $pendaftaran->update([
                    'bukti_pembayaran' => $image,
                    'status_pembayaran_diklat' => "Menunggu verifikasi"
                ]);
            }
            $pembayaran->create([
                'order_id' => 'ORD_' . rand(100000, 999999),
                'id_pendaftaran' => $id,
                'jenis_pembayaran' => "diklat",
                'total_harga' => $pendaftaran->harga_diklat,
                'metode_pembayaran' => "offline",
                'status' => "Menunggu verifikasi",
                'created_at' => now(),
            ]);
        }

        return redirect('/riwayat')->with('success', 'Terimakasih! Pembayaranmu akan segera diperiksa oleh admin:)');
    }
    // excel
    public function export(Request $request){
        $requestUri = $request->server->get('REQUEST_URI');
        $uriParts = explode('/', $requestUri);
        $dateRange = end($uriParts); 
        $dates = explode('.', $dateRange);
        $startDate = $dates[0];
        $endDate = $dates[1]; 
        // dd($startDate);
        // dd($endDate);
        $timestamp = Carbon::now()->format('H-i-s_d-m-Y');
        $filename = 'Laporan_' . $timestamp . '.xlsx';
        return Excel::download(new PembayaranExport($startDate, $endDate), $filename);
    }

}
