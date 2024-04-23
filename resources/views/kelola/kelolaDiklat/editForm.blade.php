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
            <h1>Tambah data Diklat</h1>
            <form action="/kelDiklat/{{ $kelDiklat->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="img" class="form-label">Gambar sebelumnya</label><br>
                    @if($kelDiklat->gambar)
                        <img src="{{ asset('storage/' . $kelDiklat->gambar) }}" class="img-preview img-fluid" style="width: 20%;">
                    @else
                        <p>Tidak ada gambar</p>
                    @endif
                </div>
                
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="img" class="form-label">Masukkan gambar untuk ditampilkan di detail diklat</label>
                        <img class="img-preview img-fluid" style="width: 20%;">
                        <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img" >
                        @error('img')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <select name="default" class="form-select" aria-label="Default select example">
                        <option value="ya" {{ old('default', $kelDiklat->default) == 'ya' ? 'selected' : '' }}>Ya</option>
                        <option value="tidak" {{ old('default', $kelDiklat->default) == 'tidak' || is_null($kelDiklat->default) ? 'selected' : '' }}>Tidak</option>
                    </select>
                    <small class="text-muted">Pilih "ya" jika ingin gambar menjadi gambar default.</small>
                    @error('default')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <br><br>
                    
                    <label for="kategori_diklat"  class="form-label is">Kategori Diklat</label>
                    <select name="kategoriDiklat" class="form-select" aria-label="Default select example">
                        <option selected disabled>Pilih Kategori Diklat</option>
                        @foreach ($getKategori as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategoriDiklat',$kelDiklat->id) == $kelDiklat->id ? 'selected' : '' }}>
                                {{ $kategori->kategori_diklat }}
                            </option>
                        @endforeach
                    </select>
                    <div class="mb-3">
                        <label for="nama_diklat" class="form-label is">Nama Diklat</label>
                        <input type="text" class="form-control  @error('nama_diklat') is-invalid @enderror" id="nama_diklat" name= "nama_diklat" value="{{ old('nama_diklat') ?? $kelDiklat->nama_diklat }}">
                        @error('nama_diklat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label is">Link untuk grup whatsapp</label>
                        <input type="text" class="form-control  @error('whatsapp') is-invalid @enderror" id="whatsapp" name= "whatsapp" value="{{ old('whatsapp') ?? $kelDiklat->whatsapp }}">
                        @error('whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label is">Harga</label>
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') ? number_format(old('harga'), 0, ',', '.') : number_format($kelDiklat->harga, 0, ',', '.') }}">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kuota" class="form-label is">Kuota Minimal</label>
                        <input type="number" class="form-control  @error('kuota') is-invalid @enderror" id="kuota" name= "kuota" value="{{ old('kuota')?? $kelDiklat->kuota_minimal }}">
                        @error('kuota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <span>Deskripsi bisa meliputi durasi, tujuan, topik, tipe, metode, fasilitas, persyaratan, lokasi : </span>
                    <textarea name="deskripsi" id="editor">{{ old('deskripsi')?? $kelDiklat->deskripsi }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>     
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>
</html>
@endsection

