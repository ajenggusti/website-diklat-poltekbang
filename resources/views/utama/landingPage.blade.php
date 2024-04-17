@extends('layout/mainUser')
@section('container')
    <h1>jumlah pendaftar saat ini : {{ $jmlPendaftar }}</h1>
    <h1>jumlah diklat saat ini : {{ $jmlDiklat }}</h1>
    <hr>
    <h3>kategori diklat</h3>
    @foreach ($katDiklat as $kategori)
    Kategori "{{ $kategori->kategori_diklat }}"
    <br>
    {{-- <a href="/utama/macamDiklat/{{ $kategori->id }}">Lihat semua diklat</a> --}}
    <a href="/utama/macamDiklat/{{ $kategori->id }}">{{ $kategori->kategori_diklat }}</a>

        <br>
        
    @endforeach

    <hr>
    <h1>Testimoni</h1>
    @foreach ($testimonis as $testimoni)
        <h3>{{ $testimoni->nama_depan }}</h3>
        <b>{{ $testimoni->profesi }}</b>
        <p>{{ $testimoni->testimoni }}</p>
    @endforeach

@endsection
