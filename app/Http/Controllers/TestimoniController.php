<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Testimoni;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Testimoni::get();
        // dd($datas);
        return view('kelola.kelolaTestimoni.index', ['datas'=>$datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = $request->query('id');
        // dd($id);
        $pendaftaran=Pendaftaran::find($id);
        return view('kelola.kelolaTestimoni.form',[
            'pendaftaran'=>$pendaftaran
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        // dd($request);
        // Pesan error validasi dalam Bahasa Indonesia
        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
        
        ];
    
        // Validasi input
        $validator = Validator::make($request->all(), [
            'profesi' => 'required|string|max:255',
            'testimoni' => 'required|string',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Testimoni::create([
            'profesi' => $request->profesi,
            'testimoni' => $request->testimoni,
            'id_pendaftaran' => $request->id_pendaftaran,
            
        ]);
    
        // Redirect pengguna ke halaman yang sesuai atau berikan respons sukses
        return redirect('/riwayat')->with('success', 'Terimakasih, testimoni berhasil disimpan!.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $kelTestimoni)
    {
        $pendaftaran=Pendaftaran::find($kelTestimoni->id_pendaftaran);
        $diklats = Diklat::get();
        return view('kelola.kelolaTestimoni.editForm',[
            'kelTestimoni'=>$kelTestimoni,
            'pendaftaran'=>$pendaftaran,
            'diklats'=>$diklats

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $kelTestimoni)
    {    
        // dd($kelTestimoni);
        // dd($request);
        if ($kelTestimoni->id_pendaftaran == null) {
            $request->validate([
                'nama_dummy' => 'required',
                'profesi' => 'required',
                'testimoni' => 'required',
                'diklat' => 'required',
            ], [
                'nama_dummy.required' => 'Kolom nama dummy wajib diisi.',
                'profesi.required' => 'Kolom profesi wajib diisi.',
                'testimoni.required' => 'Kolom testimoni wajib diisi.',
                'diklat.required' => 'Kolom diklat wajib dipilih',
            ]);
            $kelTestimoni->update([
                'tampil' => $request->pilihan,
                'nama_dummy'=>$request->nama_dummy,
                'profesi'=>$request->profesi,
                'testimoni'=>$request->testimoni,
                'id_diklat'=>$request->diklat
            ]);
        }else{
            $kelTestimoni->update([
                'tampil' => $request->pilihan,
            ]);
        }
        return redirect('/kelTestimoni')->with('success', 'Testimoni berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $kelTestimoni)
    {
        $kelTestimoni->delete();
        return redirect('/kelTestimoni')->with('success', 'Data berhasil dihapus!');
    }
    public function testimoniAdminCreate(){
        $diklats=Diklat::get();
        return view('kelola.kelolaTestimoni.formAdmin', [
            'diklats'=>$diklats, 
        ]);
    }
    public function testimoniAdminStore(Request $request){
        // dd($request);
        $request->validate([
            'nama_dummy' => 'required',
            'profesi' => 'required',
            'testimoni' => 'required',
            'diklat' => 'required',
        ], [
            'nama_dummy.required' => 'Kolom nama dummy wajib diisi.',
            'profesi.required' => 'Kolom profesi wajib diisi.',
            'testimoni.required' => 'Kolom testimoni wajib diisi.',
            'diklat.required' => 'Kolom diklat wajib dipilih',
        ]);
        $testimoni = new Testimoni();
        $testimoni->nama_dummy = $request->nama_dummy;
        $testimoni->profesi = $request->profesi;
        $testimoni->testimoni = $request->testimoni;
        $testimoni->id_diklat = $request->diklat;
        $testimoni->save();
        return redirect('/kelTestimoni')->with('success', 'Testimoni dummy berhasil dibuat!.');


    }
}
