@extends('layout.mainAdmin')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">

    <div class="content-form">
        <form action="/kelGambarDiklat/{{ $kelGambarDiklat->id }}" method="post" enctype="multipart/form-data"class="edit-staff">
            @method('put')
            @csrf
            <h2>Form Edit Gambar Diklat</h2>
            <hr>
            <div class="mb-3">
                <label for="img" class="form-label">Gambar Sebelumnya</label> <br>
                <img class="img-preview img-fluid" style="width: 500px;" src="{{ asset('storage/'.$kelGambarDiklat->gambar_navbar) }}" alt="Preview Gambar">
                <br> <br>
                <label for="img" class="form-label">Masukkan Gambar</label> <br>
                <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
                <small style="color: rgb(16, 126, 190)">Ukuran maksimal gambar 5 MB</small>
                @error('img')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="diklat" class="form-label">Gambar untuk Diklat</label> <br>
                <select name="diklat" class="form-select @error('diklat') is-invalid @enderror" aria-label="Default select example">
                    <option value="" selected disabled>Gambar ini untuk diklat yang mana?</option>
                    <option value="null" style="color:red;" {{ old('diklat', $kelGambarDiklat->id_diklat) == 'null' ? 'selected' : '' }}>Untuk semua diklat</option>
                    @foreach ($diklats as $diklat)
                        <option value="{{ $diklat->id }}" {{ old('diklat', $kelGambarDiklat->id_diklat) == $diklat->id ? 'selected' : '' }}>
                            {{ $diklat->nama_diklat }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('diklat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('diklat') }}
                    </div>
                @endif
            </div>
            <div class="submit-button">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
@endsection