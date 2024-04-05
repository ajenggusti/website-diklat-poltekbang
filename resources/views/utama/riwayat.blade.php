@extends('layout.mainUser')
@section('container')
    <h1>RIWAYAT DIKLAT</h1>

    @foreach ($datas as $key => $data)
        <h3>{{ $dataDiklat[$key]->nama_diklat }}</h3>
        <p>Status Diklat : {{ $dataDiklat[$key]->status }}</p>
        <p>Harga Diklat : Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</p>
        <p>Status Pembayaran Diklat : {{ $data->status_pembayaran_diklat }}</p>
        <p>Harga Pendaftaran : Rp. 150.000</p>
        <p>Status Pembayaran Diklat : {{ $data->status_pembayaran_daftar }}</p>

        <a href="/riwayat/{{ $data->id }}" class="btn btn-success">Lihat</a>
        <form action="#" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
        </form>
        <hr>
    @endforeach
    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
@endsection
