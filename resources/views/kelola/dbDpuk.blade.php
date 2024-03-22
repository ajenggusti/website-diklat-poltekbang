@extends('layout.mainAdmin')
@section('container')
    <p>Jumlah seluruh pendaftar diklat : {{ $jumlahPendaftar }}</p>
    @foreach($diklatCounts as $diklatCount)
        <p>Jumlah pendaftar diklat {{ $diklatCount->nama_diklat }}: {{ $diklatCount->total_pendaftar }}</p>
    @endforeach
@endsection
