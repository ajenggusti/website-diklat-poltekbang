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
                    <th>Nama User</th>
                    <td>{{ $kelPembayaran->pendaftaran->user->name }}</td>
                </tr>
                <tr>
                    <th>Pendidikan Terakhir</th>
                    <td>{{ $kelPembayaran->pendaftaran->pendidikan_terakhir}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $kelPembayaran->pendaftaran->user->email }}</td>
                </tr>
                <tr>
                    <th>Nomor telepon</th>
                    <td>{{ $kelPembayaran->pendaftaran->no_hp }}</td>
                </tr>
                @if ($kelPembayaran->pendaftaran->user->jenis_berkas == "paspor")
                    <tr>
                        <th>Nomor paspor</th>
                        <td>{{ $kelPembayaran->pendaftaran->user->no_paspor }}</td>
                    </tr>
                    <tr>
                        <th>Nationality</th>
                        <td>{{ $kelPembayaran->pendaftaran->user->Nationality->name }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($kelPembayaran->pendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</td>
                    </tr>
                @else
                    <tr>
                        <th>NIK</th>
                        <td>{{ $kelPembayaran->pendaftaran->user->nik }}</td>
                    </tr>
                    <tr>
                        <th>Tempat | Tanggal Lahir</th>
                        <td>{{ $kelPembayaran->pendaftaran->user->tempat_lahir }} | {{ \Carbon\Carbon::parse($kelPembayaran->pendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>Kelurahan {{ $kelPembayaran->pendaftaran->user->kelurahan->name }}, Kecamatan {{ $kelPembayaran->pendaftaran->user->kecamatan->name }}, Kabupaten {{ $kelPembayaran->pendaftaran->user->kabupaten->name }}, Provinsi {{ $kelPembayaran->pendaftaran->user->provinsi->name }}</td>
                    </tr>
                @endif

                <div class="blank-space"></div>
                {{-- data pesanan --}}
                <tr>
                    <th>Nama diklat</th>
                    <td>{{ $kelPembayaran->pendaftaran->diklat->nama_diklat }}</td>
                </tr>
                <tr>
                    <th>Harga Pendaftaran</th>
                    <td>Rp 150.000</td>
                </tr>
                <tr>
                    <th>Status Pembayaran Daftar</th>
                    @if ($kelPembayaran->pendaftaran->status_pembayaran_daftar=="Lunas")
                        <td><span class="badge badge-pill badge-success">{{ $kelPembayaran->pendaftaran->status_pembayaran_daftar }}</span></td>
                    @elseif($kelPembayaran->pendaftaran->status_pembayaran_daftar=="Menunggu verifikasi")
                        <td><span class="badge badge-pill badge-warning">{{ $kelPembayaran->pendaftaran->status_pembayaran_daftar }}</span></td>
                    @elseif($kelPembayaran->pendaftaran->status_pembayaran_daftar=="kadaluarsa")
                        <td><span class="badge badge-pill badge-dark">{{ $kelPembayaran->pendaftaran->status_pembayaran_daftar }}</span></td>
                    @else
                        <td><span class="badge badge-pill badge-danger">{{ $kelPembayaran->pendaftaran->status_pembayaran_daftar }}</span></td>
                    @endif
                </tr>
                <tr>
                    <th>Harga diklat : </th>
                    <td>Rp {{ number_format($kelPembayaran->pendaftaran->harga_asli_diklat, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Kode Promo</th>
                    @if ($kelPembayaran->pendaftaran->id_promo)
                        <td>{{ $kelPembayaran->pendaftaran->promo->kode }}</td>
                    @else
                        <td>Tidak mengambil promo.</td>
                    @endif
                    
                </tr>
                <tr>
                    <th>Diskon promo : </th>
                    <td>-Rp {{ number_format($kelPembayaran->pendaftaran->potongan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Diskon admin : </th>
                    <td>-Rp {{ number_format($kelPembayaran->pendaftaran->potongan_admin, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total harga diklat : </th>
                    <td>Rp {{ number_format($kelPembayaran->pendaftaran->harga_diklat, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran Diklat</th>
                    @if ($kelPembayaran->pendaftaran->status_pembayaran_diklat=="Lunas")
                        <td><span class="badge badge-pill badge-success">{{ $kelPembayaran->pendaftaran->status_pembayaran_diklat }}</span></td>
                    @elseif($kelPembayaran->pendaftaran->status_pembayaran_diklat=="Menunggu verifikasi")
                        <td><span class="badge badge-pill badge-warning">{{ $kelPembayaran->pendaftaran->status_pembayaran_diklat }}</span></td>
                    @elseif($kelPembayaran->pendaftaran->status_pembayaran_diklat=="kadaluarsa")
                        <td><span class="badge badge-pill badge-dark">{{ $kelPembayaran->pendaftaran->status_pembayaran_diklat }}</span></td>
                    @else
                        <td><span class="badge badge-pill badge-danger">{{ $kelPembayaran->pendaftaran->status_pembayaran_diklat }}</span></td>
                    @endif
                </tr>
               
                <tr>
                    <th>Sertifikat Diklat</th>
                    <td>
                        @if ($kelPembayaran->pendaftaran->s_doc)
                            <a href="{{ asset('storage/' . $kelPembayaran->pendaftaran->s_doc) }}">Klik Untuk Melihat Sertifikat!</a>
                        @elseif($kelPembayaran->pendaftaran->s_gambar)
                            <img src="{{ asset('storage/' . $kelPembayaran->pendaftaran->s_gambar) }}" alt="sertifikat" width="300px">
                        @elseif($kelPembayaran->pendaftaran->s_link)
                            <a href="{{ $kelPembayaran->pendaftaran->s_link }}">Klik Untuk Melihat Sertifikat!</a>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
