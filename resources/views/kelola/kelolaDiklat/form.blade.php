@extends('layout.mainAdmin')
@section('container')
    <h1>Tambah data Diklat</h1>
    <form action="/kelDiklat" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <div class="mb-3">
                <label for="img" class="form-label">Masukkan gambar untuk ditampilkan di detail diklat</label>
                <img class="img-preview img-fluid" style="width: 20%;">
                <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img" >
                @error('img')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <select name="kategoriDiklat" class="form-select" aria-label="Default select example">
                <option selected disabled>Pilih Kategori Diklat</option>
                @foreach ($getKategori as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategoriDiklat') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->kategori_diklat }}
                    </option>
                @endforeach
            </select>
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
            <textarea name="deskripsi" id="editor">{{ old('deskripsi') }}</textarea>

            
    
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>

        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

