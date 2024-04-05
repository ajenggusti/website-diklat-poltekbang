@extends('layout.mainUser')
@section('container')
    <p>nama diklat : {{ $data->nama_diklat }}</p>
    <br>
    <p>nama depan : {{ $data->nama_depan }}</p>
    <br>
    <p>nama belakang : {{ $data->nama_belakang }}</p>
    <br>
    <p>tempat lahir : {{ $data->tempat_lahir }}</p>
    <br>
    {{-- jangan lupa kasih format --}}
    <p>tanggal Lahir : {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</p>
    <br>
    <p>Alamat : {{ $data->alamat }}</p>
    <br>
    <p>email : {{ $data->email }}</p>
    <br>
    <p>no hp : {{ $data->no_hp }}</p>
    <br>
    <p>pendidikan terakhir : {{ $data->pendidikan_terakhir }}</p>
    <br>
    <p>waktu pendaftaran : {{ \Carbon\Carbon::parse($data->waktu_pendaftaran)->format('H:i:s | d-m-Y') }}</p>
    <br>
    <p>kode promo : {{ $data->kode }}</p>
    <p>potongan : Rp {{ number_format($data->potongan, 0, ',', '.') }}</p>
    <br>
    <p>biaya pendaftaran : Rp 150.000</p>
    <br>
    <p>status pembayaran pendaftaran : {{ $data->status_pembayaran_daftar }}</p>
    <br>
    <p>biaya diklat : Rp {{ number_format($data->harga_diklat, 0, ',', '.') }}</p>
    <br>
    <p>status pembayaran biaya diklat : {{ $data->status_pembayaran_diklat }}</p>
    <br>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    <a href="#" class="btn btn-warning">Edit</a>
@endsection