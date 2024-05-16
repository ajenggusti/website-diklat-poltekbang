@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Detail Promo</title>
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
    <div class="content-show">
        <h2>Detail Promo</h2>
        <a href="/kelPromo/{{ $kelPromo->id }}/edit" class="btn btn-success">Edit</a>
        <a href="{{ route('kelPromo.index') }}" class="btn btn-primary">Kembali</a>
        {{-- <a href="{{ route('kelPendaftaran.index') }}" class="btn btn-primary">Kembali</a> --}}
        <br> <br>
        <div class="table-responsive">
            <table class="table table-sm show-user">
            
                @if ($kelPromo->id_diklat != null)
                    <tr>
                        <th>Promo untuk diklat mana?</th>
                        <td>{{ $kelPromo->diklat->nama_diklat }}</td>
                    </tr>
                @else
                    <tr>
                        <th>Promo untuk?</th>
                        <td>Semua diklat</td>
                    </tr>
                @endif
                <tr>
                    <th>Gambar</th>
                    <td><img src="{{ asset('storage/' . $kelPromo->gambar) }}" alt="Nama Gambar" width="300px;"></td>
                </tr>
                <tr>
                    <th>Potongan </th>
                    <td>{{ $kelPromo->potongan }}</td>
                </tr>
                <tr>
                    <th>Kode</th>
                    <td>{{ $kelPromo->kode }}</td>
                </tr>
                <tr>
                    <th>Status Tampil </th>
                    <td>{{ $kelPromo->tampil }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $kelPromo->deskripsi }}</td>
                </tr>
                <tr>
                    <th>Tanggal Awal</th>
                    <td>{{ date('d F Y', strtotime($kelPromo->tgl_awal)) }}</td>
                </tr>
                <tr>
                    <th>Tanggal Akhir</th>
                    <td>{{ date('d F Y', strtotime($kelPromo->tgl_akhir)) }}</td>
                </tr>
                @if ($kelPromo->pakai_kuota != null)  
                    <tr>
                        <th>Pakai Kuota </th>
                        <td>{{ $kelPromo->pakai_kuota }}</td>
                    </tr>
                    <tr>
                        <th>Kuota </th>
                        <td>{{ $kelPromo->kuota }}</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</body>
</html>
@endsection
