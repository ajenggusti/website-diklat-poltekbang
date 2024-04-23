@extends('layout.mainAdmin')
@section('container')
<html>
    <head>
        <!-- Custom styles for this template -->
        <link href="/css/form.css" rel="stylesheet">
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
        <div class="content-bodyForm">
            <h2>Form Edit Kategori Diklat</h2>
            
            <form method="POST" action="/kelKatDiklat/{{ $data->id }}"  enctype="multipart/form-data" >
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="img" class="form-label">Gambar sebelumnya</label><br>
                    @if($data->gambar)
                        <img src="{{ asset('storage/' . $data->gambar) }}" class="img-preview img-fluid" style="width: 20%;">
                    @else
                        <p>Tidak ada gambar</p>
                    @endif
                </div>
                
                <div class="mb-3">
                    <label for="img" class="form-label">Masukkan gambar untuk ditampilkan di Kategori Diklat</label>
                    <img class="img-preview img-fluid" style="width: 20%;">
                    <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img" >
                    @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <select name="default" class="form-select" aria-label="Default select example">
                    <option value="ya" {{ old('default', $data->default) == 'ya' ? 'selected' : '' }}>Ya</option>
                    <option value="tidak" {{ old('default', $data->default) == 'tidak' || is_null($data->default) ? 'selected' : '' }}>Tidak</option>
                </select>
                <small class="text-muted">Pilih "ya" jika ingin gambar menjadi gambar default.</small>
                @error('default')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <br><br>

                <div class="mb-3">
                    <label for="katDiklat" class="form-label is">Kategori Diklat</label>
                    <input type="text" class="form-control  @error('katDiklat') is-invalid @enderror" id="katDiklat" name= "katDiklat" value="{{ old('katDiklat')?? $data->kategori_diklat }}">
                    @error('katDiklat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </body>
</html>  
@endsection

