@extends('layout/mainUser')

@section('container')
    @foreach ($detailDiklat as $detail)
        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a><br>
        <img src="{{ asset('storage/' . $detail->gambar) }}" alt="Gambar Diklat" style="width: 10%;">
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
