@extends('layout.mainAdmin')
@section('container')
    <h1>Detail Pendaftaran</h1>
    <a href="/kelPendaftaran/{{ $pendaftaran->id }}/edit" class="btn btn-warning">Edit</a>
    <table class="table">
        
        <tr>
            <th>Nama User</th>
            <td>{{ optional($pendaftaran->user)->name }}</td>
        </tr>
        <tr>
            <th>Kode Promo</th>
            <td>{{ optional($pendaftaran->promo)->kode }}</td>
        </tr>
        <tr>
            <th>Harga Diklat</th>
            <td>Rp {{ number_format($pendaftaran->harga_diklat, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status Pembayaran Diklat</th>
            <td>{{ $pendaftaran->status_pembayaran_diklat }}</td>
        </tr>
        <tr>
            <th>Harga Pendaftaran</th>
            <td>Rp 150.000</td>
        </tr>
        <tr>
            <th>Status Pembayaran Daftar</th>
            <td>{{ $pendaftaran->status_pembayaran_daftar }}</td>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <td>{{ $pendaftaran->nama_lengkap }}</td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td>{{ $pendaftaran->tempat_lahir}}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ date('d F Y', strtotime($pendaftaran->tanggal_lahir)) }}</td>
            
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $pendaftaran->alamat}}</td>
        </tr>
        <tr>
            <th>Pendidikan Terakhir</th>
            <td>{{ $pendaftaran->pendidikan_terakhir}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ optional($pendaftaran->user)->email }}</td>
        </tr>
        <tr>
            <th>Sertifikat Diklat</th>
            <td>{{ $pendaftaran->sertifikat }}</td>
        </tr>

    </table>
    <a href="{{ route('kelPendaftaran.index') }}" class="btn btn-primary">Kembali</a>
@endsection
