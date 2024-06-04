@extends('layout.mainAdmin')
@section('container')
        <link href="/css/actor.css" rel="stylesheet">

        <div class="content-form">
            <form method="POST" action="/kelKatDiklat" enctype="multipart/form-data" class="edit-staff">
                @csrf
                <h2>Form Tambah Kategori Diklat</h2>
                <hr>
                <div class="mb-3">
                    <label for="img" class="form-label">Masukkan Gambar</label><br>
                    {{-- <div class="image-container" > --}}
                        <img class="img-preview img-fluid">
                    {{-- </div> --}}
                    <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img" >
                    <small style="color: rgb(16, 126, 190)">Ukuran maksimal gambar 2 MB</small>
                    @error('img')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="defaulf">Menjadi Gambar Default?</label>
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
@endsection

