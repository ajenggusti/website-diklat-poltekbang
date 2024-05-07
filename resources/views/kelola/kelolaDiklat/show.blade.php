@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Diklat</title>
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
        <h2>Detail Diklat</h2>
        <a href="/kelDiklat/{{ $diklatData->id}}/edit" class="btn btn-success">Edit</a>
        <a href="{{ route('kelDiklat.index') }}" class="btn btn-primary">Kembali</a>
        <br> <br>
        <div class="table-responsive">
            <table class="table table-sm show-user">
            
                <tr>
                    <th>Gambar Sampul</th>
                    <td>
                        @if ($diklatData->gambar)
                            <!-- Tampilkan gambar dari database jika ada -->
                            <img src="{{ asset('storage/' . $diklatData->gambar) }}" alt="" style="width: 300px;">
                        @else
                            @php $foundDefault = false; @endphp
                            @foreach ($allDiklatData as $data)
                                @if ($data->default == 'ya')
                                    <img src="{{ asset('storage/' . $data->gambar) }}" alt="Default Image" style="width: 300px;">
                                    @php $foundDefault = true; @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$foundDefault)
                                <!-- Jika tidak ditemukan data dengan default 'ya', gunakan gambar default umum -->
                                <img src="{{ asset('img/123.png') }}" alt="Default Image" style="width: 30%;">
                            @endif
                        @endif
                    </td>
                </tr>
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
                    <th>Kuota Minimal</th>
                    <td>{{ $diklatData->kuota_minimal }}</td>
                </tr>
                <tr>
                    <th>Jumlah Pendaftar</th>
                    <td>{{ $diklatData->jumlah_pendaftar}}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $diklatData->status }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{!! $diklatData->deskripsi !!}</td>
                </tr>
                <tr>
                    <th>Link whatsapp</th>
                    <td><a href="{{ $diklatData->whatsapp }}">{{ $diklatData->whatsapp }}</a></td>
                </tr>
            </table>
            
        </div>
    </div>
</body>
</html>
@endsection
