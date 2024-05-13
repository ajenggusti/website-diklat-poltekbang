@extends('layout.mainAdmin')
@section('container')
    <p><a href="/kelPendaftaran">Jumlah seluruh pendaftar diklat : {{ $totalSemua }}</a></p>
    <p><a href="/PendaftaranTerlaksana">Jumlah alumni : {{ $alumni }}</a></p>
    <p><a href="/PendaftaranBelumTerlaksana">Jumlah pendaftaran yang belum terlaksana : {{ $jumlahBelumTerlaksana }}</a></p>

    @foreach($pendaftarans as $pendaftaran)
    <p><a href="/PendaftaranByDiklat/{{ $pendaftaran->diklat->id }}">Jumlah pendaftar diklat {{ $pendaftaran->diklat->nama_diklat }}: {{ $pendaftaran->total_pendaftar }}</a></p>    


    @endforeach
@endsection
