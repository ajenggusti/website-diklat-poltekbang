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
    <p>tanggal Lahir : {{ $data->tanggal_lahir }}</p>
    <br>
    <p>Alamat : {{ $data->alamat }}</p>
    <br>
    <p>email : {{ $data->email }}</p>
    <br>
    <p>no hp : {{ $data->no_hp }}</p>
    <br>
    <p>pendidikan terakhir : {{ $data->pendidikan_terakhir }}</p>
    <br>
    <p>waktu pendaftaran : {{ $data->waktu_pendaftaran }}</p>
    <br>
    <p>kode promo : {{ $data->kode }}</p>
    <p>potongan : {{ $data->potongan }}</p>
    <br>
    <p>biaya pendaftaran : Rp 150.000</p>
    <br>
    <p>status pembayaran pendaftaran : {{ $data->status_pembayaran_daftar }}</p>
    <br>
    <p>biaya diklat : {{ $data->harga_diklat }}</p>
    <br>
    <p>status pembayaran biaya diklat : {{ $data->status_pembayaran_diklat }}</p>
    <br>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    <a href="#" class="btn btn-warning">Edit</a>
@endsection