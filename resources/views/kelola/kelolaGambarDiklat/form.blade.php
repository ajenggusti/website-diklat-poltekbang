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
            <h1>Tambah data</h1>
            <form action="/kelGambarDiklat" method="post" enctype="multipart/form-data">
                @csrf

                
                <div class="mb-3">
                    <label for="img" class="form-label">Masukkan gambar</label>
                    <img class="img-preview img-fluid" style="width: 20%;">
                    <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
                    @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                
                <select name="diklat" class="form-select @error('diklat') is-invalid @enderror" aria-label="Default select example">
                    <option value="" selected disabled>Gambar ini untuk diklat yang mana?</option>
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
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </body>
</html>
@endsection
