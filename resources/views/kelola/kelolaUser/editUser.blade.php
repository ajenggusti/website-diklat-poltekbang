@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="/css/actor.css" rel="stylesheet">
    {{-- <script src="/js/landing.js"></script> --}}
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
        
        
        <form method="POST" action="/register/{{ $data->id }}" class="edit-user">
            @method('put')
            @csrf
            <h2>Form Edit Level User</h2>
            <hr>
            <div class="mb-3">
                <label for="namaPengguna">Nama Pengguna</label>
                <input name="namaPengguna" type="text" class="form-control @error('namaPengguna') is-invalid @enderror" id="namaPengguna" value="{{ old('namaPengguna')?? $data->name }}" disabled>
                @error('namaPengguna')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input name="email" value="{{ old('email')?? $data->email }}" type="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Email address" disabled>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="id_level">Pilih Level untuk User</label>
                <select name="id_level" class="form-select" aria-label="Default select example">
                    <option selected disabled>Pilih level</option>
                    @foreach ($getLevel as $level)
                        <option value="{{ $level->id }}" {{ old('id_level', $data->id_level) == $level->id ? 'selected' : '' }}>
                            {{ $level->level }}
                        </option>
                    @endforeach
                </select>   
            </div>       
            {{-- <a href="{{ route('register') }}" class="btn btn-primary">Kembali</a> --}}
            <div class="submit-button">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>    
            
        </form>
    </div>
</body>
</html>
@endsection

