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
        <div class="content-land">
            @foreach ($detailDiklat as $detail)
            <div class="card-jenis">
                nama diklat :
                {{ $detail->nama_diklat }}
                <br>
                detail harga :
                {{ $detail->harga }}
                <br>
                jumlah pendaftar saat ini :
                {{ $detail->jumlah_pendaftar }}
                <br>
                Status penerimaan pendaftaram :
                {{ $detail->status }}
                <br>
                Durasi diklat :
                {{ $detail->durasi }}
                <br>
                Deskripsi : 
                {{ $detail->deskripsi }}
                <br>
                Tujuan : 
                {{ $detail->tujuan }}
                <br>
                Topik yang akan dipelajari : 
                {{ $detail->topik }}
                <br>
                Tipe :
                {{ $detail->tipe }}
                <br>
                Metode : 
                {{ $detail->metode }}
                <br>
                Fasilitas : 
                {{ $detail->fasilitas }}
                <br>
                Persyaratan : 
                {{ $detail->persyaratan }}
                <br>
                Lokasi : 
                {{ $detail->lokasi }}
            </div> 
            @endforeach
        </div>
    </body>
</html>
@endsection