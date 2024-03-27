@extends('layout.mainAdmin')
@section('container')
{{-- Font Poppins --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

</style>
    <p>jumlah seluruh user saat ini : {{ $count }}</p>
    @foreach($userCounts as $userCount)
        <p>Jumlah pengguna pada  {{ $userCount->level }}: {{ $userCount->total_users }}</p>
    @endforeach
@endsection
