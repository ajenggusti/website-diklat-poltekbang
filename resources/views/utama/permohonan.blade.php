@extends('layout.mainUser')
@section('container')

    <h2>Permohonan mengganti berkas</h2>
    
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
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>  


@endsection