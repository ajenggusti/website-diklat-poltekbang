<?php

namespace App\Http\Controllers;
use App\Models\Diklat;
use App\Models\Promos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Promos::with('diklat')->get();
        return view('kelola.kelolaPromo.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = Diklat::all();
        return view('kelola.kelolaPromo.formPromo', ['datas' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Aturan validasi dan pesan error disimpan dalam variabel
        $rules = [
            'potongan' => 'required',
            'kode' => 'required|unique:promos,kode',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required|after:tgl_awal',
            'diklat' => 'required',
            'deskripsi' => 'required',
            'img' => 'required|image|max:1024',
        ];

        // Pesan error yang umum
        $messages = [
            'potongan.required' => 'Potongan wajib diisi.',
            'kode.required' => 'Kode Promo wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'kode.unique' => 'Kode Promo sudah ada.',
            'tgl_awal.required' => 'Tanggal Mulai Promo wajib diisi.',
            'tgl_akhir.required' => 'Tanggal Promo Berakhir wajib diisi.',
            'tgl_akhir.after' => 'Tanggal Promo Berakhir harus setelah Tanggal Mulai Promo.',
            'diklat.required' => 'Pilih diklat untuk promo.',
            'img.required' => 'Gambar wajib diunggah.',
            'img.image' => 'File harus berupa gambar.',
            'img.max' => 'Ukuran file tidak boleh melebihi 1 MB.',
        ];

        // Validasi tambahan hanya jika kuota diceklis 'iya'
        if ($request->input('kuota') === "iya") {
            $rules['kuota_angka'] = 'required|integer|min:1';
            $messages['kuota_angka.required'] = 'Kuota wajib diisi jika ingin menggunakan kuota.';
            $messages['kuota_angka.integer'] = 'Kuota harus berupa angka.';
            $messages['kuota_angka.min'] = 'Kuota harus lebih besar daripada 0.';
        }

        // Validasi utama
        $request->validate($rules, $messages);

        // Menetapkan nilai kuota dan pakai_kuota
        $kuota = $request->input('kuota') === 'iya' ? 'iya' : 'tidak';
        $kuota_angka = $kuota === 'iya' ? $request->input('kuota_angka') : 0;

        if ($request->hasFile('img')) {
            $image = $request->file('img')->store('LanPage');
            $potongan = preg_replace("/[^0-9]/", "", $request->potongan);
            Promos::create([
                'potongan' => $potongan,
                'kode' => $request->kode,
                'tgl_awal' => Carbon::createFromFormat('d-m-Y', $request->tgl_awal)->format('Y-m-d'),
                'tgl_akhir' => Carbon::createFromFormat('d-m-Y', $request->tgl_akhir)->format('Y-m-d'),
                'id_diklat' => $request->diklat === 'null' ? null : $request->diklat,
                'gambar' => $image,
                'kuota' => $kuota_angka,
                'pakai_kuota' => $kuota,
                'tampil' => $request->tampil,
                'deskripsi' => $request->deskripsi
            ]);

            return redirect('/kelPromo')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return back()->withErrors(['msg' => 'Tidak ada file yang diunggah.'])->withInput();
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Promos $kelPromo)
    {
        return view('kelola.kelolaPromo.show', [
            'kelPromo'=>$kelPromo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promos $kelPromo)
    {
        $datas = Diklat::all();
        $data = ['kelPromo' => $kelPromo, 'datas' => $datas];
        return view('kelola.kelolaPromo.editFormPromo', $data);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Promos $kelPromo)
    {
        // dd($request);
        // dd($kelPromo);
        $messages = [
            'potongan.required' => 'Potongan wajib diisi.',
            'kode.required' => 'Kode Promo wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'kode.unique' => 'Kode Promo sudah ada.',
            'tgl_awal.required' => 'Tanggal Mulai Promo wajib diisi.',
            'tgl_akhir.required' => 'Tanggal Promo Berakhir wajib diisi.',
            'tgl_akhir.after' => 'Tanggal Promo Berakhir harus setelah Tanggal Mulai Promo.',
            'img.image' => 'File harus berupa gambar.',
            'img.max' => 'Ukuran file tidak boleh melebihi 1 MB.',
            'diklat.required' => 'Pilih diklat untuk promo.',
            'kuota.required' => 'Pilih terlebih dahulu, apakah anda ingin menggunakan kuota?',
            'kuota_angka.integer' => 'Kuota harus berupa angka.',
            'kuota_angka.required_if' => 'Kuota wajib diisi jika ingin menggunakan kuota.',
            'kuota_angka.min' => 'Kuota harus lebih besar dari 0.',
        ];
        $rules = [
            'potongan' => 'required',
            'kode' => 'required|unique:promos,kode,' . $kelPromo->id,
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required|after:tgl_awal',
            'diklat' => 'required',
            'img' => 'nullable|image|max:1024',
            'kuota' => 'required',
            'deskripsi' => 'required',
            'kuota_angka' => 'required_if:kuota,iya'
        ];

        if ($request->input('kuota') === "iya") {
            $rules['kuota_angka'] .= '|integer|min:1';
        }

        $validatedData = $request->validate($rules, $messages);

        $kuota_angka = $request->input('kuota') === 'iya' ? $validatedData['kuota_angka'] : 0;
        $kuota = $request->input('kuota') === 'iya' ? 'iya' : 'tidak'; // Ubah true menjadi iya, false menjadi tidak


        // Handle gambar jika diunggah
        if ($request->hasFile('img')) {
            // Hapus gambar lama
            Storage::delete($kelPromo->gambar);
            // Simpan gambar baru
            $image = $request->file('img')->store('LanPage');
        } else {
            // Gunakan gambar yang sudah ada
            $image = $kelPromo->gambar;
        }

        $tgl_awal = Carbon::createFromFormat('d-m-Y', $request->tgl_awal)->format('Y-m-d');
        $tgl_akhir = Carbon::createFromFormat('d-m-Y', $request->tgl_akhir)->format('Y-m-d');



        // Ambil nilai potongan
        $potongan = preg_replace("/[^0-9]/", "", $validatedData['potongan']);

        // Update data Promo
        $kelPromo->update([
            'gambar' => $image,
            'potongan' => $potongan,
            'kode' => $validatedData['kode'],
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'id_diklat' => $validatedData['diklat'] !== 'null' ? $validatedData['diklat'] : null,
            'kuota' => $kuota_angka,
            'pakai_kuota' => $kuota,
            'tampil' => $request->tampil,
            'deskripsi' => $request->deskripsi
        ]);

        // Redirect dengan pesan sukses
        return redirect('/kelPromo')->with('success', 'Data berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promos $kelPromo)
    {

        Storage::delete($kelPromo->gambar);
        $kelPromo->delete();
        return redirect('/kelPromo')->with('success', 'Data berhasil dihapus!');
    }
}
