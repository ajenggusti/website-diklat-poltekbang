@extends('layout.mainAdmin')
@section('container')
    <h2>Form Edit Kategori Diklat</h2>
    
    <form method="POST" action="/kelKatDiklat/{{ $data->id }}" >
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="katDiklat" class="form-label is">Kategori Diklat</label>
            <input type="text" class="form-control  @error('katDiklat') is-invalid @enderror" id="katDiklat" name= "katDiklat" value="{{ old('katDiklat')?? $data->kategori_diklat }}">
            @error('katDiklat')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>  
@endsection

