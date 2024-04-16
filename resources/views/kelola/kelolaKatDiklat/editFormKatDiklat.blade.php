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
            <h2>Form Edit Kategori Diklat</h2>
            
            <form method="POST" action="/kelKatDiklat/{{ $data->id }}" >
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="katDiklat" class="form-label is">Kategori Diklat</label>
                    <input type="text" class="form-control  @error('katDiklat') is-invalid @enderror" id="katDiklat" name= "katDiklat" value="{{ old('katDiklat')?? $data->kategori_diklat }}">
                    @error('katDiklat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </body>
</html>  
@endsection

