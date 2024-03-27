@extends('layout.mainAdmin')
@section('container')
{{-- Font Poppins --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

</style>
    <h2>Form Tambah Kategori Diklat</h2>
    
    <form method="POST" action="/kelKatDiklat" >
        @csrf
        <div class="mb-3">
            <label for="katDiklat" class="form-label is">Kategori Diklat</label>
            <input type="text" class="form-control  @error('katDiklat') is-invalid @enderror" id="katDiklat" name= "katDiklat" value="{{ old('katDiklat') }}">
            @error('katDiklat')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>  
@endsection

