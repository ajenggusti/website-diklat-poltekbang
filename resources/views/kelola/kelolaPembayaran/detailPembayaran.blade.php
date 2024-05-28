@extends('layout.mainAdmin')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">

    <div class="content-show">
        <h2>Detail Pembayaran</h2>
        <a href="{{ route('kelPembayaran.index') }}" class="btn btn-primary">Kembali</a>
        {{-- <a href="/kelPembayaran/{{ $kelPembayaran->id }}/edit" class="btn btn-warning">Edit</a> --}}
        <div class="table-responsive">
            <table class="table table-sm show-user">

                <tr>
                    <th>Bukti Pembayaran</th>
                    <td><img src="{{ asset('storage/'.$kelPembayaran->bukti_pembayaran) }}" alt=""></td>
                </tr>
                <tr>
                    <th>Total Biaya</th>
                    <td>Rp {{ number_format($kelPembayaran->pendaftaran->harga_diklat, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran Diklat</th>
                    <td>{{ $kelPembayaran->pendaftaran->status_pembayaran_diklat }}</td>
                </tr>
                <tr>
                    <th>Harga Pendaftaran</th>
                    <td>Rp 150.000</td>
                </tr>
                <tr>
                    <th>Status Pembayaran Daftar</th>
                    <td>{{ $kelPembayaran->pendaftaran->status_pembayaran_daftar }}</td>
                </tr>
                <tr>
                    <th>Nama Diklat</th>
                    <td>{{ $kelPembayaran->pendaftaran->diklat->nama_diklat }}</td>
                </tr>
                <tr>
                    <th>Nama User</th>
                    <td>{{ optional($kelPembayaran->pendaftaran->user)->name }}</td>
                </tr>
                <tr>
                    <th>Kode Promo</th>
                    <td>{{ optional($kelPembayaran->pendaftaran->promo)->kode }}</td>
                </tr>
                
                {{-- <tr>
                    <th>Nama Depan</th>
                    <td>{{ $kelPembayaran->pendaftaran->nama_lengkap }}</td>
                </tr> --}}
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $kelPembayaran->pendaftaran->tempat_lahir}}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ date('d F Y', strtotime($kelPembayaran->pendaftaran->tanggal_lahir)) }}</td>
                    
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $kelPembayaran->pendaftaran->alamat}}</td>
                </tr>
                <tr>
                    <th>Pendidikan Terakhir</th>
                    <td>{{ $kelPembayaran->pendaftaran->pendidikan_terakhir}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ optional($kelPembayaran->pendaftaran->user)->email }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
