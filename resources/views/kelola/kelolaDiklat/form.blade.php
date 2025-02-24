@extends('layout.mainAdmin')
@section('title', 'DPUK | Tambah Diklat')
@section('container')
        <link href="/css/actor.css" rel="stylesheet">

        <div class="content-form">
            
            <form action="/kelDiklat" method="post" enctype="multipart/form-data" class="edit-staff">
                @csrf
                <h2>Form Tambah Diklat</h2>
                <hr>
                {{-- <div class="mb-3"> --}}
                    <div class="mb-3">
                        <label for="img" class="form-label">Masukkan Gambar <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label><br>
                        {{-- <div class="image-container" > --}}
                            <img class="img-preview img-fluid">
                        {{-- </div> --}}
                        <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img" >
                        <small style="color: rgb(16, 126, 190);">Ukuran maksimal gambar 2 MB</small>
                        @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="default">Gambar untuk Default <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                        <select name="default" class="form-select" aria-label="Default select example">
                            <option value="ya" {{ old('default') == 'ya' ? 'selected' : '' }}>Ya</option>
                            <option value="tidak" {{ old('default', 'tidak') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        <small class="text-muted">Pilih "ya" jika ingin gambar menjadi gambar default semua kategori diklat.</small>
                        @error('default')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="kategoriDiklat">Kategori Diklat <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
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
                        <label for="nama_diklat" class="form-label is">Nama Diklat <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                        <input type="text" class="form-control  @error('nama_diklat') is-invalid @enderror" id="nama_diklat" name= "nama_diklat" value="{{ old('nama_diklat') }}">
                        @error('nama_diklat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label is">Link untuk Grup Whatsapp <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                        <input type="text" class="form-control  @error('whatsapp') is-invalid @enderror" id="whatsapp" name= "whatsapp" value="{{ old('whatsapp') }}">
                        @error('whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label is">Harga <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                        <input type="text" class="form-control  @error('harga') is-invalid @enderror" id="harga" name= "harga" value="{{ old('harga') }}">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kuota" class="form-label is">Kuota Maksimal <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                        <input type="number" class="form-control  @error('kuota') is-invalid @enderror" id="kuota" name= "kuota" value="{{ old('kuota') }}">
                        @error('kuota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label is">Deskripsi <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
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
@endsection

