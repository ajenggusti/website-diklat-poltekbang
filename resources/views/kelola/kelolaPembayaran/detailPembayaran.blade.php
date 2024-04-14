@extends('layout.mainAdmin')
@section('container')
    <h1>Detail Pendaftaran</h1>
    <a href="/kelPendaftaran/{{ $kelPendaftaran->id }}/edit" class="btn btn-warning">Edit</a>
    <table class="table">
        

    </table>
    <a href="{{ route('kelPembayaran.index') }}" class="btn btn-primary">Kembali</a>
@endsection
