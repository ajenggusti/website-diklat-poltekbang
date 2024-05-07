@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Detail Pendaftaran</title>
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
        <h2>Detail Pendaftaran</h2>
        <a href="/kelPendaftaran/{{ $pendaftaran->id }}/editAsAdmin" class="btn btn-success">Edit</a>
        <a href="{{ route('kelPendaftaran.index') }}" class="btn btn-primary">Kembali</a>
        <br> <br>
        <div class="table-responsive">
            <table class="table table-sm show-user">
                <tr>
                    <th>Nama User</th>
                    <td>{{ optional($pendaftaran->user)->name }}</td>
                </tr>
                <tr>
                    <th>Kode Promo</th>
                    <td>{{ optional($pendaftaran->promo)->kode }}</td>
                </tr>
                <tr>
                    <th>Harga Diklat</th>
                    <td>Rp {{ number_format($pendaftaran->harga_diklat, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran Diklat</th>
                    <td>{{ $pendaftaran->status_pembayaran_diklat }}</td>
                </tr>
                <tr>
                    <th>Harga Pendaftaran</th>
                    <td>Rp 150.000</td>
                </tr>
                <tr>
                    <th>Status Pembayaran Daftar</th>
                    <td>{{ $pendaftaran->status_pembayaran_daftar }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $pendaftaran->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $pendaftaran->tempat_lahir}}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ date('d F Y', strtotime($pendaftaran->tanggal_lahir)) }}</td>
                    
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $pendaftaran->alamat}}</td>
                </tr>
                <tr>
                    <th>Pendidikan Terakhir</th>
                    <td>{{ $pendaftaran->pendidikan_terakhir}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ optional($pendaftaran->user)->email }}</td>
                </tr>
                <tr>
                    <th>Sertifikat Diklat</th>
                    <td>
                        @if ($pendaftaran->s_doc)
                            <a href="{{ asset('storage/' . $pendaftaran->s_doc) }}">Klik Untuk Melihat Sertifikat!</a>
                        @elseif($pendaftaran->s_gambar)
                            <img src="{{ asset('storage/' . $pendaftaran->s_gambar) }}" alt="sertifikat">
                        @elseif($pendaftaran->s_link)
                            <a href="{{ $pendaftaran->s_link }}">Klik Untuk Melihat Sertifikat!</a>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
@endsection
