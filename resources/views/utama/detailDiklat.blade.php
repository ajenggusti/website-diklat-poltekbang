@extends('layout/mainUser')
@section('container')
    @foreach ($detailDiklat as $detail)
    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
        nama diklat :
        {{ $detail->nama_diklat }}
        <br>
        detail harga :
        {{ $detail->harga }}
        <br>
        jumlah pendaftar saat ini :
        {{ $detail->jumlah_pendaftar }}
        <br>
        Status penerimaan pendaftaram :
        {{ $detail->status }}
        <br>
        Deskripsi : 
        {!! $detail->deskripsi !!}
    
    @endforeach

    @guest
    <br>
    <div class="d-grid gap-2 col-6">
        <button class="btn btn-primary" type="button"  onclick="window.location.href = '/login';">Daftarkan dirimu sekarang!</button>
    </div>
    
    @endguest

    @auth 
        <div class="d-grid gap-2 col-6">
            <button class="btn btn-primary" type="button" onclick="window.location.href = '#';">Daftarkan dirimu sekarang!</button>
        </div>
    @endauth
@endsection