@extends('layout.mainAdmin')
@section('container')
    <p>Jumlah seluruh pendaftar diklat : {{ $jumlahPendaftar }}</p>
    @foreach($pendaftarans as $pendaftaran)
    <p><a href="/dbDpukDetail/{{ $pendaftaran->diklat->id }}">Jumlah pendaftar diklat {{ $pendaftaran->diklat->nama_diklat }}: {{ $pendaftaran->total_pendaftar }}</a></p>    

    @endforeach
@endsection
