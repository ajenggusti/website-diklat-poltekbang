@extends('layout.mainUser')
@section('container')
    @foreach ($diklat as $perdiklat)
        <a href="/utama/detailDiklat/{{ $perdiklat->id }}">lihat detail tentang {{ $perdiklat->nama_diklat }}</a>
        <br>
    @endforeach

    <a href="/" class="btn btn-info">Kembali</a>
@endsection