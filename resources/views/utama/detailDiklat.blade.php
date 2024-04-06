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
        
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

        </style>
    </head>
    <body>
        {{-- <img src="{{ asset('storage/' . $detail->gambar) }}" alt="Gambar Diklat" class="img-detail"> --}}
        <div class="content-body2">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a><br>
            @foreach ($detailDiklat as $detail) <br> <br>

            <div class="center-text">{{ $detail->nama_diklat }}</div>
            
            {{-- <img src="{{ asset('storage/' . $detail->gambar) }}" alt="" style="width: 30%;"> --}}

            <img src="{{ asset('img/plane3.jpg') }}" alt="Gambar Diklat" class="img-detail">
            <div class="card-container3">
                <div class="card-content3">
                    <p>
                        <span>Nama Diklat : </span><br>
                        {{ $detail->nama_diklat }}
                    </p>
                    
                    <p>
                        <span>Detail Harga :</span><br>
                        {{ $detail->harga }}</p>
                    
                    <p>
                        <span>Jumlah Pendaftar Saat Ini :</span><br>
                        {{ $detail->jumlah_pendaftar }}
                    </p>
                    
                    <p>
                        <span>Status Penerimaan PendaftaraN :</span><br>
                        {{ $detail->status }}
                    </p>
                    
                    <p>
                        <span>Deskripsi :</span><br>
                        {!! $detail->deskripsi !!}
                    </p>
                </div>
            </div> 
            @endforeach
   
            @auth
                <div class="d-grid gap-2 col-6">
                    <a href="{{ route('kelPendaftaran.create', ['id' => $detail->id]) }}" class="btn btn-primary" style="width: 1200px;">Daftarkan dirimu sekarang!</a>
                </div>
            @endauth
        
            @guest
                <div class="d-grid gap-2 col-6">
                    <button style="width: 1200px;" class="btn btn-primary" type="button" onclick="window.location.href = '/login';">Login untuk mendaftar!</button>
                </div>
            @endguest
        </div>
    </body>
</html>
@endsection
