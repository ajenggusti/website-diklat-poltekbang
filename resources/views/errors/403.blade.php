<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container text-center">
        <div class="content">
            <img style="height: 300px; width: auto;" src="{{ asset('img/403error.png') }}">

        </div>
        <a href="{{ url('/riwayat') }}">Kembali</a>
    </div>
</body>
</html>
{{-- @extends('layout.mainUser')
@section('container')
<div class="content">
    <img style="height: 300px; width: auto;" src="{{ asset('img/403error.png') }}">
</div>
@endsection --}}
