{{-- extend merupakan inheritance dari nama file yang ingin di warisi --}}
@extends('layout/mainUser')
@section('container')
    @foreach ($gbrSlide as $slide)
        <img src="{{ asset('storage/' . $slide->gambar_navbar) }}" alt="Gambar slide" style="width: 50%;">
    @endforeach
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
    <h1>Promo</h1>
    @foreach ($promos as $promo)
    {{ $promo->id }}
    <img src="{{ asset('storage/'.$promo->gambar) }}" alt="Promo Image">
        
    @endforeach
    <h1>Testimoni</h1>
    @foreach ($testimonis as $testimoni)
        <h3>{{ $testimoni->pendaftaran->nama_depan }}</h3>
        <b>{{ $testimoni->profesi }}</b>
        <p>Alumni diklat {{ $testimoni->pendaftaran->diklat->nama_diklat }}</p>
        <p>{{ $testimoni->testimoni }}</p>
    @endforeach

@endsection
