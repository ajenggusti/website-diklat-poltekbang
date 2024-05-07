@extends('layout.mainAdmin')
@section('container')
<html>
    <head>
        <!-- Custom styles for this template -->
        <link href="/css/actor.css" rel="stylesheet">
        {{-- Boostrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        {{-- Font Poppins --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="content-form">
            
            
            <form method="POST" action="/kelKatDiklat" enctype="multipart/form-data" class="edit-user">
                @csrf
                <h2>Form Tambah Kategori Diklat</h2>
                <hr>
                <div class="mb-3">
                    <label for="img" class="form-label">Masukkan gambar</label>
                    <img class="img-preview img-fluid" style="width: 550px">
                    <br> <br>
                    <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img" >
                    @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="defaulf">Menjadi gambar default</label>
                    <select name="default" class="form-select" aria-label="Default select example">
                        <option value="ya" {{ old('default') == 'ya' ? 'selected' : '' }}>Ya</option>
                        <option value="tidak" {{ old('default', 'tidak') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    <small class="text-muted">Pilih "ya" jika ingin gambar menjadi gambar default.</small>
                    @error('default')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="katDiklat" class="form-label is">Kategori Diklat</label>
                    <input type="text" class="form-control  @error('katDiklat') is-invalid @enderror" id="katDiklat" name= "katDiklat" value="{{ old('katDiklat') }}">
                    @error('katDiklat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="submit-button">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </body>
</html>
@endsection

