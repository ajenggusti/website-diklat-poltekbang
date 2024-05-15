@extends('layout/mainUser')
@section('container')
<html>
    <head>
        <link href="/css/detailDiklat.css" rel="stylesheet">
        {{-- <link href="/css/landing.css" rel="stylesheet"> --}}
            {{-- <script src="/js/landing.js"></script> --}}
        {{-- Boostrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        {{-- Font Poppins --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="content-body">
            {{-- <div class="content-land"> --}}
                {{-- BREADCRUMBS --}}
                {{-- <br>
                <nav aria-label="breadcrumb" style="background-color: #FFFFFF !important;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="/">HOME</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="/macamDiklat">{{ $diklatOne->kategori_diklat }}</a>
                        </li>
                    </ol>
                </nav> --}}
                <a href="/" class="btn btn-info" style="margin-top: 40px;">Kembali</a>
                <br>
                <h2>PROGRAM {{ $diklatOne->kategori_diklat }}</h2>
                <div class="card-container2">
                {{-- <div class="cards-container"> --}}
                    @foreach ($diklat as $perdiklat)
                    <div class="card-img">
                    {{-- <div class="card-jenis"> --}}
                        @if ($perdiklat->gambar)
                            <img src="{{ asset('storage/' . $perdiklat->gambar) }}" alt="">
                        @else
                            @php $foundDefault = false; @endphp
                            @foreach ($allDiklat as $data)
                                @if ($data->default == 'ya')
                                    <img src="{{ asset('storage/' . $data->gambar) }}" alt="Default Image">
                                    @php $foundDefault = true; @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$foundDefault)
                                <img src="{{ asset('img/123.png') }}" alt="Default Image">
                            @endif
                        @endif
                        <div class="card-content2">
                        {{-- <div class="card-content"> --}}
                            <hr style="color:rgb(255, 255, 255)">
                            <h6 style="text-align: center">{{ $perdiklat->nama_diklat }}</h6>
                            <hr>
                            <p>Kuota : Belum Full</p>
                            <p>Biaya : Rp 5.598.000</p>
                            <p></p>

                            <button class="button-link" onclick="window.location.href='/utama/detailDiklat/{{ $perdiklat -> id}}'">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                        <br>
                    @endforeach   
                    
                </div>     
                
            </div>
        </div>
    </body>
    </html>
@endsection