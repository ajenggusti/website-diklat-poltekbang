@extends('layout.mainAdmin')
@section('container')
<html>
    <head>
            <!-- Custom styles for this template -->
        <link href="/css/landing.css" rel="stylesheet">
        <script src="/js/landing.js"></script>
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
        <h1>Detail Diklat</h1>
        <a href="/kelDiklat/{{ $diklatData->id}}/edit" class="btn btn-warning">Edit</a>
        <table class="table">
    {{--         
            <tr>
                <th>Gambar</th>
                <td><img src="{{ asset('storage/' . $diklatData->gambar) }}" alt="" style="width: 30%;"></td>
            </tr> --}}
            <tr>
                <th>Nama Diklat</th>
                <td>{{ $diklatData->nama_diklat }}</td>
            </tr>
            <tr>
                <th>Kategori Diklat</th>
                <td>{{ $diklatData->kategori_diklat }}</td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>Rp {{ number_format($diklatData->harga, 0, ',', '.') }}</td>
            </tr>        
            <tr>
                <th>kuota_minimal</th>
                <td>{{ $diklatData->kuota_minimal }}</td>
            </tr>
            <tr>
                <th>jumlah_pendaftar</th>
                <td>{{ $diklatData->jumlah_pendaftar}}</td>
            </tr>
            <tr>
                <th>status</th>
                <td>{{ $diklatData->status }}</td>
            </tr>
            <tr>
                <th>deskripsi</th>
                <td>{!! $diklatData->deskripsi !!}</td>
        </table>
        <a href="{{ route('kelDiklat.index') }}" class="btn btn-primary">Kembali</a>
    </body>
</html>
@endsection
