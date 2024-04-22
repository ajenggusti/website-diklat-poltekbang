@extends('layout.mainAdmin')
@section('container')
    <h2>Form Tambah Kategori Diklat</h2>
    
    <form method="POST" action="/kelKatDiklat" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="img" class="form-label">Masukkan gambar untuk ditampilkan di detail diklat</label>
            <img class="img-preview img-fluid" style="width: 20%;">
            <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img" >
            @error('img')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <select name="default" class="form-select" aria-label="Default select example">
            <option value="ya" {{ old('default') == 'ya' ? 'selected' : '' }}>Ya</option>
            <option value="tidak" {{ old('default', 'tidak') == 'tidak' ? 'selected' : '' }}>Tidak</option>
        </select>
        <small class="text-muted">Pilih "ya" jika ingin gambar menjadi gambar default.</small>
        @error('default')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <br>
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

