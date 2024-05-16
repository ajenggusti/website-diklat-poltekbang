@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Edit Diklat</title>
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
    <div class="content-form2Column">
        <form action="/kelDiklat/{{ $kelDiklat->id }}" method="post" enctype="multipart/form-data" class="edit-2column">
            @method('put')
            @csrf
            <h2>Form Edit Diklat</h2>
            <hr>
            <div class="form-column-left">
                <div class="mb-3">
                    <label for="img" class="form-label">Gambar Sebelumnya</label><br>
                    @if($kelDiklat->gambar)
                        <img src="{{ asset('storage/' . $kelDiklat->gambar) }}" class="img-preview img-fluid" style="width: 550px;">
                    @else
                        <p>Tidak ada gambar</p>
                    @endif
                </div>
                
                {{-- <div class="mb-3"> --}}
                    <div class="mb-3">
                        <label for="img" class="form-label">Masukkan gambar untuk ditampilkan di detail diklat</label>
                        <img class="img-preview img-fluid" style="width: 550px;">
                        <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img" >
                        <small style="color: rgb(16, 126, 190);">Ukuran maksimal gambar 5 MB</small>
                        @error('img')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="default">Menjadi Gambar Default</label>
                        <select name="default" class="form-select" aria-label="Default select example">
                            <option value="ya" {{ old('default', $kelDiklat->default) == 'ya' ? 'selected' : '' }}>Ya</option>
                            <option value="tidak" {{ old('default', $kelDiklat->default) == 'tidak' || is_null($kelDiklat->default) ? 'selected' : '' }}>Tidak</option>
                        </select>
                        <small class="text-muted">Pilih "ya" jika ingin gambar menjadi gambar default.</small>
                        @error('default')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori_diklat"  class="form-label is">Kategori Diklat</label>
                        <select name="kategoriDiklat" class="form-select" aria-label="Default select example">
                            <option selected disabled>Pilih Kategori Diklat</option>
                            @foreach ($getKategori as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategoriDiklat',$kelDiklat->id) == $kelDiklat->id ? 'selected' : '' }}>
                                    {{ $kategori->kategori_diklat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_diklat" class="form-label is">Nama Diklat</label>
                        <input type="text" class="form-control  @error('nama_diklat') is-invalid @enderror" id="nama_diklat" name= "nama_diklat" value="{{ old('nama_diklat') ?? $kelDiklat->nama_diklat }}">
                        @error('nama_diklat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
            {{-- </form> --}}
            </div>
            <div class="form-column-right">
            {{-- <form action="/kelDiklat/{{ $kelDiklat->id }}" method="post" enctype="multipart/form-data" class="edit-user"> --}}
                
                <div class="mb-3">
                    <label for="whatsapp" class="form-label is">Link untuk Grup Whatsapp</label>
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
                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        
                        <textarea name="deskripsi" id="editor">{{ old('deskripsi')?? $kelDiklat->deskripsi }}</textarea>
                        <span style="font-weight: bold; font-size: 12px;">*Deskripsi bisa meliputi durasi, tujuan, topik, tipe, metode, fasilitas, persyaratan, lokasi :*</span>
                    </div>
                    <div class="submit-button">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
            
            </div>
        </form>     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>
@endsection

