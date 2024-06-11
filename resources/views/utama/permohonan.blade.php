@extends('layout.mainUser')
@section('title', 'Form Permohonan Mengubah Data')
@section('container')
    <link href="/css/riwayat.css" rel="stylesheet">

    {{-- <div class="content"> --}}
        <div class="bg-permohonan">
            <div class="content-mohon">
                
                <h2>Permohonan Mengubah Berkas</h2>
                <br>
                <form method="POST" action="/updatePermohonan/{{ $id }}" enctype="multipart/form-data" >
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="permohonan_ubah" class="form-label is">Tuliskan alasan permohonan perubahan data : </label>
                        <input type="text" class="form-control  @error('permohonan_ubah') is-invalid @enderror" id="permohonan_ubah" name= "permohonan_ubah">
                        @error('permohonan_ubah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="btn-mohon">
                        <button type="submit" class="btn btn-primary">  Kirimkan Alasan   </button>
                    </div>
                </form>  
            </div>
        </div>
    {{-- </div> --}}
@endsection