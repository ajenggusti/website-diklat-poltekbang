@extends('layout/mainUser')

@section('container')
<html>
    <head>
        <!-- Custom styles for this template -->
        <link href="/css/detailDiklat.css" rel="stylesheet">
        {{-- <script src="/js/landing.js"></script> --}}
        {{-- Boostrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        {{-- Font Poppins --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <title></title>
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
            .container-fluid {
                /* margin: 0;
                padding: 0; */
                /* background-color: #d98686; */
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            
            <div class="content-body2">
                <br>
                {{-- @foreach ($detailDiklat as $detail) <br> <br> --}}
                    {{-- <nav aria-label="breadcrumb" style="background-color: #FFFFFF !important;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="/">HOME</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="/macamDiklat">{{ $diklatOne->kategori_diklat }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="/detailDiklat">{{ $detailDiklat->nama_diklat }}</a>
                            </li>
                        </ol>
                    </nav> --}}
                {{-- <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a><br> --}}
             
                        
                            <h2>{{ $detailDiklat->nama_diklat }}</h2><br>
                            <div id="carouselExampleIndicators" class="carousel slide img-diklat" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach ($gambars as $key => $gambar)
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach ($gambars as $key => $gambar)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $gambar->gambar_navbar) }}" class="d-block w-100" alt="Gambar Diklat" >
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            {{-- </div> --}}

                            {{-- <img src="{{ asset('img/diklat.jpeg') }}" alt="Gambar Diklat" class="img-detailDiklat"> --}}
                            <div class="card-container3">
                                <div class="card-content3">
                                    <p>
                                        <span>Nama Diklat : </span><br>
                                        {{ $detailDiklat->nama_diklat }}
                                    </p>
                                    
                                    <p>
                                        <span>detailDiklat Harga :</span><br>
                                        {{ $detailDiklat->harga }}</p>
                                    
                                    <p>
                                        <span>Jumlah Pendaftar Saat Ini :</span><br>
                                        {{ $detailDiklat->jumlah_pendaftar }}
                                    </p>
                                    
                                    <p>
                                        <span>Status Penerimaan PendaftaraN :</span><br>
                                        {{ $detailDiklat->status }}
                                    </p>
                                    
                                    <p>
                                        <span>Deskripsi :</span><br>
                                        {!! $detailDiklat->deskripsi !!}
                                    </p>
                                </div>
                            </div> 
                 
                {{-- <br> --}}
               
                <div class="btn-regDiklat d-flex justify-content-center">
                    @guest
                    @if ($dobelDiklat==null)
                        <div class="d-grid gap-2 col-6 btn-container">
                            <button class="btn btn-primary" type="button" onclick="window.location.href = '/login';" style="justify-content: center;">Login untuk mendaftar!</button>
                        </div>
                        @endif
                    @endguest
                    @auth
                        @if($dobelDiklat)
                            <div class="alert alert-warning" role="alert">
                                Ups, kamu sudah mendaftar diklat ini. <a href="/riwayat">Lihat riwayat...</a>
                            </div>
                        @elseif($user->status!= "Diverifikasi")
                            <div class="alert alert-danger" role="alert">
                                Ups, data pribadimu belum Diverifikasi. <a href="/editProfil">Lengkapi data disini....</a>
                            </div>
                        @else
                            <div class="d-grid gap-2 col-6 button-daftar">
                                <a href="{{ route('kelPendaftaran.create', ['id' => $detailDiklat->id]) }}" class="btn btn-primary">Daftarkan dirimu sekarang!</a>
                            </div>
                        @endif
                    @endauth
                </div>
        </div>
    </body>
</html>
@endsection
