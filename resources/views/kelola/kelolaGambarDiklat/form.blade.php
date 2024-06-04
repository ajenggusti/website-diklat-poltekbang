@extends('layout.mainAdmin')
@section('container')
        <link href="/css/actor.css" rel="stylesheet">

        <div class="content-form">
            
            <form action="/kelGambarDiklat" method="post" enctype="multipart/form-data" class="edit-staff">
                @csrf
                <h2>Form Tambah Gambar Diklat</h2>
                <hr>
                <div class="mb-3">
                    <label for="img" class="form-label">Masukkan Gambar</label><br>
                    {{-- <div class="image-container"> --}}
                        <img class="img-preview img-fluid">
                    {{-- </div> --}}
                    {{-- <br> --}}
                    <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
                    <small style="color: rgb(16, 126, 190)">Ukuran maksimal gambar 2 MB</small>
                    @error('img')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="diklat">Gambar untuk Diklat</label>
                    <select name="diklat" class="form-select @error('diklat') is-invalid @enderror" aria-label="Default select example">
                        <option value="" selected disabled>Gambar untuk diklat yang mana?</option>
                        <option value="null" style="color:red;" {{ old('diklat') == 'null' ? 'selected' : '' }}>Untuk semua diklat</option>
                        @foreach ($diklats as $diklat)
                            <option value="{{ $diklat->id }}" {{ old('diklat') == $diklat->id ? 'selected' : '' }}>
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
        </div>
@endsection
