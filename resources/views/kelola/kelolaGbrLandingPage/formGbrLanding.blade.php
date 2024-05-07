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
            
            <form action="/gbrLandingPage" method="post" enctype="multipart/form-data" class="edit-user">
                @csrf
                <h2>Tambah Gambar Landing Page</h2>
                <hr>
                <div class="mb-3">
                    <label for="img" class="form-label">Masukkan gambar untuk ditampilkan di Landing Page</label>
                    <img class="img-preview img-fluid" style="width: 550px;">
                    <br><br>
                    <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
                    @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Tampilan</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="tampilkan" value="tampilkan" >
                        <label class="form-check-label" for="tampilkan">
                            Tampilkan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="sembunyikan" value="sembunyikan" checked>
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
