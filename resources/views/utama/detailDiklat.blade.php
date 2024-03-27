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
        Durasi diklat :
        {{ $detail->durasi }}
        <br>
        Deskripsi : 
        {{ $detail->deskripsi }}
        <br>
        Tujuan : 
        {{ $detail->tujuan }}
        <br>
        Topik yang akan dipelajari : 
        {{ $detail->topik }}
        <br>
        Tipe :
        {{ $detail->tipe }}
        <br>
        Metode : 
        {{ $detail->metode }}
        <br>
        Fasilitas : 
        {{ $detail->fasilitas }}
        <br>
        Persyaratan : 
        {{ $detail->persyaratan }}
        <br>
        Lokasi : 
        {{ $detail->lokasi }}
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