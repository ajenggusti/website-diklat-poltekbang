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
        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a><br>
        <img src="{{ asset('storage/' . $detail->gambar) }}" alt="Gambar Diklat" class="img-detail">
        <div class="content-body2">
            @foreach ($detailDiklat as $detail)
            <div class="center-text">{{ $detail->nama_diklat }}</div>
            

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
                        <span>Durasi Diklat :</span><br>
                        {{ $detail->durasi }}
                    </p>
                    
                    <p>
                        <span>Deskripsi :</span><br>
                        {!! $detail->deskripsi !!}
                    </p>
                    
                    <p>
                        <span>Tujuan :</span><br>
                        {{ $detail->tujuan }}
                    </p>
                    
                    <p>
                        <span>Topik Yang Akan Dipelajari :</span><br>
                        {{ $detail->topik }}</p>
                    
                    <p>
                        <span>Tipe :</span><br>
                        {{ $detail->tipe }}</p>
                    
                    <p>
                        <span>Metode :</span><br>
                        {{ $detail->metode }}</p>
                    
                    <p>
                        <span>Fasilitas :</span><br>
                        {{ $detail->fasilitas }}</p>
                    
                    <p>
                        <span>Persyaratan :</span><br>
                        {{ $detail->persyaratan }}</p>
                    
                    <p>
                        <span>Lokasi :</span><br>
                        {{ $detail->lokasi }}</p>
                </div>
            </div> 
            @endforeach
            @guest
                <br>
                <div class="d-grid gap-2 col-6">
                    <button class="btn btn-primary" type="button"  onclick="window.location.href = '/login';">Daftarkan dirimu sekarang!</button>
                </div>
            @endguest

            @auth 
                <div class="d-grid gap-2 col-6">
                    <button class="btn btn-primary" type="button" onclick="window.location.href = '#';">Daftarkan dirimu sekarang!</button>
                </div>
            @endauth
        </div>
    </body>
</html>
@endsection
