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
            
            <form action="/kelDiklat" method="post" enctype="multipart/form-data" class="edit-user">
                @csrf
                <h2>Form Tambah Diklat</h2>
                <hr>
                {{-- <div class="mb-3"> --}}
                    <div class="mb-3">
                        <label for="img" class="form-label">Masukkan gambar</label>
                        <img class="img-preview img-fluid" style="width: 550px">
                        <br> <br>
                        <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img" >
                        <small style="color: rgb(91, 91, 255);">Ukuran maksimal gambar 5 MB</small>
                        @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="default">Gambar untuk default</label>
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
                        <label for="kategoriDiklat">Kategori Diklat</label>
                        <select name="kategoriDiklat" class="form-select  @error('kategoriDiklat') is-invalid @enderror" aria-label="Default select example">
                            <option selected value="" disabled>Pilih Kategori Diklat</option>
                            @foreach ($getKategori as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategoriDiklat') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->kategori_diklat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategoriDiklat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_diklat" class="form-label is">Nama Diklat</label>
                        <input type="text" class="form-control  @error('nama_diklat') is-invalid @enderror" id="nama_diklat" name= "nama_diklat" value="{{ old('nama_diklat') }}">
                        @error('nama_diklat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label is">Link untuk grup whatsapp</label>
                        <input type="text" class="form-control  @error('whatsapp') is-invalid @enderror" id="whatsapp" name= "whatsapp" value="{{ old('whatsapp') }}">
                        @error('whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label is">Harga</label>
                        <input type="text" class="form-control  @error('harga') is-invalid @enderror" id="harga" name= "harga" value="{{ old('harga') }}">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kuota" class="form-label is">Kuota Minimal</label>
                        <input type="number" class="form-control  @error('kuota') is-invalid @enderror" id="kuota" name= "kuota" value="{{ old('kuota') }}">
                        @error('kuota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label is">Deskripsi</label>
                        <textarea name="deskripsi" id="editor" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="submit-button">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
            </form>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        </div>
    </body>

</html>
@endsection

