@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Testimoni</title>
    <link href="/css/actor.css" rel="stylesheet">
    {{-- <script src="/js/actor.js"></script> --}}
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
        <h2>Detail User</h2>
        <a href="/register/{{ $user->id }}/edit" class="btn btn-warning">Edit</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-sm show-user">
                @if ($user->jenis_berkas =="paspor")
                    <tr>
                        <th>Role level</th>
                        <td>{{ $user->level->level }}</td>
                    </tr>
                    <tr>
                        <th>Kewarganegaraan</th>
                        <td>{{ $user->nationality->name }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Berkas Pendukung</th>
                        <td><img width="300px;" src="{{ asset('storage/' . $user->berkas_pendukung) }}" alt="Nama Gambar"></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin </th>
                        <td>{{ $user->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Berkas </th>
                        <td>{{ $user->jenis_berkas }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Paspor </th>
                        <td>{{ $user->no_paspor }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Expired Paspor</th>
                        <td>{{ \Carbon\Carbon::parse($user->tgl_exp_paspor)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($user->tgl_lahir)->translatedFormat('d F Y') }}</td>
                    </tr>
                    
                    <tr>
                        <th>status</th>
                        <td>{{ $user->status }}</td>
                    </tr>
                @else
                
                    <tr>
                        <th>Role level</th>
                        <td>{{ $user->level->level }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $user->nik }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Berkas Pendukung</th>
                        <td><img width="300px;" src="{{ asset('storage/' . $user->berkas_pendukung) }}" alt="Nama Gambar"></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin </th>
                        <td>{{ $user->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Berkas </th>
                        <td>{{ $user->jenis_berkas }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Paspor </th>
                        <td>{{ $user->no_paspor }}</td>
                    </tr>
                    <tr>
                        <th>Tempat Lahir</th>
                        <td>{{ $user->tempat_lahir}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($user->tgl_lahir)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>Provinsi {{ $user->provinsi->name}} | kabupaten {{ $user->kabupaten->name }} | Kecamatan :{{ $user->kecamatan->name }} | Kelurahan : {{ $user->kecamatan->name }}</td>
                    </tr>
                    <tr>
                        <th>status</th>
                        <td>{{ $user->status }}</td>
                    </tr>
                @endif
            </table>
        </div>
        
    </div>
</body>
</html>
@endsection
