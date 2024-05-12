<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use App\Models\Diklat;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
                $type = $request->acquirer;
            } elseif ($paymentType == "bank_transfer") {
                $bank = $request->va_numbers[0]['bank'];
                $type = $request->payment_type . " " . $bank;
            } else {
                $type = $request->payment_type . " " . $request->bank;
            }
            // dd($type);
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

        // Simpan data
        $pendaftaran = Pendaftaran::find($id);
        $pembayaran = new Pembayaran();

        $pembayaran_update = Pembayaran::where('id_pendaftaran', $id)
            ->where('jenis_pembayaran', 'diklat')
            ->where('metode_pembayaran', 'offline')
            ->first();
        // dd($pembayaran_update);

        if ($pendaftaran->bukti_pembayaran) {
            if ($request->hasFile('bukti_pembayaran')) {
                $image = $request->file('bukti_pembayaran')->store('LanPage');
                Storage::delete($pendaftaran->bukti_pembayaran);
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
                $image = $request->file('bukti_pembayaran')->store('LanPage');
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
}
