@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href="/css/dashboard.css" rel="stylesheet">
    {{-- Font Poppins --}}
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            /* font-family: 'Poppins', sans-serif; */
        }
    
    </style>
</head>
<body>
    <div class="content-dashboard">
        <p >Jumlah seluruh pendaftar diklat : {{ $jumlahPendaftar }}</p>
        @foreach($diklatCounts as $diklatCount)
        <div class="card-dashboard">
            <p>Jumlah pendaftar diklat {{ $diklatCount->nama_diklat }}: {{ $diklatCount->total_pendaftar }}</p>
        </div>
        @endforeach
    </div>
</body>
</html>
@endsection
