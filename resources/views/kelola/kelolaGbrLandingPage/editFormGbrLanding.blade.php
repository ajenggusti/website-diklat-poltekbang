@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Gambar Landing Page</title>
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
            
            <form action="/gbrLandingPage/{{ $data->id }}" method="post" enctype="multipart/form-data" class="edit-user">
                @method('put')
                @csrf
                <h2>Form Edit Gambar Landing Page</h2>
                <hr>
                <div class="mb-3">
                    <label for="img" class="form-label">Gambar sebelumnya</label><br>
                    <img src="{{ asset('storage/' . $data->gambar_navbar) }}" class="img-preview img-fluid" style="width: 550px">
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">Masukkan gambar baru</label>
                    <img class="img-preview img-fluid" style="width: 550px">
                    <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
                    <small style="color: rgb(16, 126, 190)">Ukuran maksimal gambar 5 MB</small>
                    @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Tampilan</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="tampilkan" value="tampilkan" {{ $data->status === 'tampilkan' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tampilkan">
                            Tampilkan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="sembunyikan" value="sembunyikan" {{ $data->status === 'sembunyikan' ? 'checked' : '' }}>
                        <label class="form-check-label" for="sembunyikan">
                            Sembunyikan
                        </label>
                    </div>
                </div>
                <div class="submit-button">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
                </form>
        </div>
    </body>
</html>
@endsection
