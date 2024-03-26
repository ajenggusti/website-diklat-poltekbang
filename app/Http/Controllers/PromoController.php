<?php

namespace App\Http\Controllers;

use App\Models\Promos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Promos::all();
        return view('kelola.kelolaPromo.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelola.kelolaPromo.formPromo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'potongan.required' => 'Potongan wajib diisi.',
            'kode.required' => 'Kode Promo wajib diisi.',
            'kode.unique' => 'Kode Promo sudah ada.',
            'tgl_awal.required' => 'Tanggal Mulai Promo wajib diisi.',
            'tgl_akhir.required' => 'Tanggal Promo Berakhir wajib diisi.',
            'tgl_akhir.after' => 'Tanggal Promo Berakhir harus setelah Tanggal Mulai Promo.',
        ];

        $request->validate([
            'potongan' => 'required',
            'kode' => 'required|unique:promos,kode',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required|after:tgl_awal',
        ], $messages);

        Promos::create([
            'potongan' => $request->potongan,
            'kode' => $request->kode,
            'tgl_awal' => Carbon::createFromFormat('d-m-Y', $request->tgl_awal)->format('Y-m-d'),
            'tgl_akhir' => Carbon::createFromFormat('d-m-Y', $request->tgl_akhir)->format('Y-m-d')
        ]);
        return redirect('/kelPromo')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promos $kelPromo)
    {
        $data = ['data'=>$kelPromo];
        return view('kelola.kelolaPromo.editFormPromo', $data);
    }

    /**
     * Update the specified resource in storage.
     */
 
    public function update(Request $request, Promos $kelPromo)
    {
        $messages = [
            'potongan.required' => 'Potongan wajib diisi.',
            'kode.required' => 'Kode Promo wajib diisi.',
            'kode.unique' => 'Kode Promo sudah ada.',
            'tgl_awal.required' => 'Tanggal Mulai Promo wajib diisi.',
            'tgl_akhir.required' => 'Tanggal Promo Berakhir wajib diisi.',
            'tgl_akhir.after' => 'Tanggal Promo Berakhir harus setelah Tanggal Mulai Promo.',
        ];
        $request->validate([
            'potongan' => 'required',
            'kode' => 'required|unique:promos,kode,'.$kelPromo->id,
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required|after:tgl_awal',
        ], $messages);
        
    
        $kelPromo->update([
            'potongan' => $request->potongan,
            'kode' => $request->kode,
            'tgl_awal' => Carbon::createFromFormat('d-m-Y', $request->tgl_awal)->format('Y-m-d'),
            'tgl_akhir' => Carbon::createFromFormat('d-m-Y', $request->tgl_akhir)->format('Y-m-d')
        ]);
    
        return redirect('/kelPromo')->with('success', 'Data berhasil diperbarui!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promos $kelPromo)
    {
        Promos::destroy($kelPromo->id);
        return redirect('/kelPromo')->with('success', 'Data berhasil dihapus!');
    }
}
