@extends('layout.mainAdmin')
@section('container')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h1>Kelola Pendaftaran</h1>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Nama Diklat</th>
                <th>Kode Promo</th>
                <th>Harga Diklat</th>
                <th>Status Pembayaran Diklat</th>
                <th>Harga Pendaftaran</th>
                <th>Status Pembayaran Pendaftaran</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->diklat->nama_diklat }}</td>
                    <td>{{ $data->promo ? $data->promo->kode : '-' }}</td>
                    <td>Rp {{ number_format($data->harga_diklat, 0, ',', '.') }}</td>
                    <td>{{ $data->status_pembayaran_diklat }}</td>
                    <td>Rp 150.000</td>
                    <td>{{ $data->status_pembayaran_daftar }}</td>
                    <td>
                        <a href="/kelPendaftaran/{{ $data->id }}" class="btn btn-success">Lihat</a>
                        <a href="/kelPendaftaran/{{ $data->id }}/editAsAdmin" class="btn btn-warning">Edit</a>
                        <form action="/kelPendaftaran/{{ $data->id }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
