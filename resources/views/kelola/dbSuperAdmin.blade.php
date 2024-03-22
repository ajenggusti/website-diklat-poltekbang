@extends('layout.mainAdmin')
@section('container')
    <p>jumlah seluruh user saat ini : {{ $count }}</p>
    @foreach($userCounts as $userCount)
        <p>Jumlah pengguna pada  {{ $userCount->level }}: {{ $userCount->total_users }}</p>
    @endforeach
@endsection
