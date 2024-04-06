@extends('layout.mainUser')
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
            <div class="content-land">
                <div class="card-riwayat">
                    <p>Nama diklat : {{ $data->nama_diklat }}</p>
                    <p>nama depan : {{ $data->nama_depan }}</p>
                    <p>nama belakang : {{ $data->nama_belakang }}</p>
                    <p>tempat lahir : {{ $data->tempat_lahir }}</p>
                    {{-- jangan lupa kasih format --}}
                    <p>tanggal Lahir : {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</p>
                    <p>Alamat : {{ $data->alamat }}</p>
                    <p>email : {{ $data->email }}</p>
                    <p>no hp : {{ $data->no_hp }}</p>
                    <p>pendidikan terakhir : {{ $data->pendidikan_terakhir }}</p>
                    <p>waktu pendaftaran : {{ \Carbon\Carbon::parse($data->waktu_pendaftaran)->format('H:i:s | d-m-Y') }}</p>
                    <p>kode promo : {{ $data->kode }}</p>
                    <p>potongan : Rp {{ number_format($data->potongan, 0, ',', '.') }}</p>
                    <p>biaya pendaftaran : Rp 150.000</p>
                    <p>status pembayaran pendaftaran : {{ $data->status_pembayaran_daftar }}</p>
                    <p>biaya diklat : Rp {{ number_format($data->harga_diklat, 0, ',', '.') }}</p>
                    <p>status pembayaran biaya diklat : {{ $data->status_pembayaran_diklat }}</p>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    <a href="#" class="btn btn-warning">Edit</a>
                </div>
            </div>
@endsection