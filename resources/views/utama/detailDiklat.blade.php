@extends('layout/mainUser')

@section('container')
    @foreach ($detailDiklat as $detail)
        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a><br>
        @foreach ($gambars as $gambar)
            
        <img src="{{ asset('storage/' . $gambar->gambar_navbar) }}" alt="Gambar Diklat" style="width: 10%;">
        @endforeach
        <br>
        <strong>Nama Diklat:</strong> {{ $detail->nama_diklat }}
        <br>
        <strong>Detail Harga:</strong> {{ $detail->harga }}
        <br>
        <strong>Jumlah Pendaftar Saat Ini:</strong> {{ $detail->jumlah_pendaftar }}
        <br>
        <strong>Status Penerimaan Pendaftaran:</strong> {{ $detail->status }}
        <br>
        <strong>Deskripsi:</strong> {!! $detail->deskripsi !!}
    @endforeach

    @auth
        <div class="d-grid gap-2 col-6">
            <a href="{{ route('kelPendaftaran.create', ['id' => $detail->id]) }}" class="btn btn-primary">Daftarkan dirimu sekarang!</a>
        </div>
    @endauth

    @guest
        <div class="d-grid gap-2 col-6">
            <button class="btn btn-primary" type="button" onclick="window.location.href = '/login';">Login untuk mendaftar!</button>
        </div>
    @endguest
@endsection
