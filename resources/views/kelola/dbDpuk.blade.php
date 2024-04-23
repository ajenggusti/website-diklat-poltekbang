@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href="/css/dashboard.css" rel="stylesheet">
    {{-- Font Poppins --}}
    {{-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    
    </style>
</head>
<body>
    <div class="container-admin">
        <div class="dashAdmin">
            <div class="dashItem" style="background-color: #BC4F00;">
                <div class="dashItemContent">Jumlah Seluruh Pendaftar Diklat : </div>
                <div class="dashItemNumber">{{ $jumlahPendaftar }}</div>
            </div>

            @foreach($diklatCounts as $diklatCount)
                @php
                    $diklatColors = [
                        '1' => '#B90000', // Merah
                        '2' => '#D6C211',
                        '3' => '#307C1E' // Hijau
                        
                    ];

                    $bgColor = $diklatColors[$diklatCount->id] ?? '#FFFFFF'; // Default putih

                @endphp
                <div class="dashItem" style="background-color: {{ $bgColor }};">
                    <div class="dashItemContent">
                        <p>Jumlah pendaftar diklat {{ $diklatCount->nama_diklat }}</p> <!-- Tulisan di sisi kiri -->
                    </div>
                    <div class="dashItemNumber">
                        {{ $diklatCount->total_pendaftar }} <!-- Angka di sisi kanan -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
@endsection
