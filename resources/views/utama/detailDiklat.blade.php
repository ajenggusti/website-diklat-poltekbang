@extends('layout/mainUser')
@section('container')
    @foreach ($detailDiklat as $detail)
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
@endsection