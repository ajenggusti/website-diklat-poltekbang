@extends('layout/mainUser')
@section('container')
<html>
    <head>
        <link href="/css/landing.css" rel="stylesheet">
            {{-- <script src="/js/landing.js"></script> --}}
        {{-- Boostrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        {{-- Font Poppins --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <h2>Jenis Diklat</h2>
        <div class="cards-container">
            @foreach ($diklat as $perdiklat)
            <div class="card-jenis">
                <img src="img/jenis.png" alt="Macam Diklat">
                <br>
                <button class="button-link" onclick="window.location.href='/utama/detailDiklat/{{ $perdiklat -> id}}'">
                    Lihat detail tentang {{ $perdiklat -> nama_diklat }}
                </button>
            </div>
                <br>
            @endforeach   
        </div>     
    </body>
    </html>
@endsection