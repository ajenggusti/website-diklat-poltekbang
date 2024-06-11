@extends('layout.mainAdmin')
@section('title', 'DPUK | Detail Pendaftaran User')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">

    <div class="content-show">
        <h2>Detail Pendaftaran</h2>
        <a href="/kelPendaftaran/{{ $pendaftaran->id }}/editAsAdmin" class="btn btn-success">Edit</a>
        <a href="{{ route('kelPendaftaran.index') }}" class="btn btn-primary">Kembali</a>
        <br> <br>
        <div class="table-responsive">
            <table class="table table-sm show-user">
                <tr>
                    <th>Nama User</th>
                    <td>{{ $pendaftaran->user->name }}</td>
                </tr>
                <tr>
                    <th>Pendidikan Terakhir</th>
                    <td>{{ $pendaftaran->pendidikan_terakhir}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $pendaftaran->user->email }}</td>
                </tr>
                <tr>
                    <th>Nomor telepon</th>
                    <td>{{ $pendaftaran->no_hp }}</td>
                </tr>
                @if ($pendaftaran->user->jenis_berkas == "paspor")
                    <tr>
                        <th>Nomor paspor</th>
                        <td>{{ $pendaftaran->user->no_paspor }}</td>
                    </tr>
                    <tr>
                        <th>Nationality</th>
                        <td>{{ $pendaftaran->user->Nationality->name }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($pendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</td>
                    </tr>
                @else
                    <tr>
                        <th>NIK</th>
                        <td>{{ $pendaftaran->user->nik }}</td>
                    </tr>
                    <tr>
                        <th>Tempat | Tanggal Lahir</th>
                        <td>{{ $pendaftaran->user->tempat_lahir }} | {{ \Carbon\Carbon::parse($pendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>Kelurahan {{ $pendaftaran->user->kelurahan->name }}, Kecamatan {{ $pendaftaran->user->kecamatan->name }}, Kabupaten {{ $pendaftaran->user->kabupaten->name }}, Provinsi {{ $pendaftaran->user->provinsi->name }}</td>
                    </tr>
                @endif

                {{-- data pesanan --}}
                <tr>
                    <th>Nama diklat</th>
                    <td>{{ $pendaftaran->diklat->nama_diklat }}</td>
                </tr>
                <tr>
                    <th>Harga Pendaftaran</th>
                    <td>Rp 150.000</td>
                </tr>
                <tr>
                    <th>Status Pembayaran Daftar</th>
                    @if ($pendaftaran->status_pembayaran_daftar=="Lunas")
                        <td><span class="badge badge-pill badge-success">{{ $pendaftaran->status_pembayaran_daftar }}</span></td>
                    @elseif($pendaftaran->status_pembayaran_daftar=="Menunggu verifikasi")
                        <td><span class="badge badge-pill badge-warning">{{ $pendaftaran->status_pembayaran_daftar }}</span></td>
                    @elseif($pendaftaran->status_pembayaran_daftar=="kadaluarsa")
                        <td><span class="badge badge-pill badge-dark">{{ $pendaftaran->status_pembayaran_daftar }}</span></td>
                    @else
                        <td><span class="badge badge-pill badge-danger">{{ $pendaftaran->status_pembayaran_daftar }}</span></td>
                    @endif
                </tr>
                <tr>
                    <th>Harga diklat : </th>
                    <td>Rp {{ number_format($pendaftaran->harga_asli_diklat, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Kode Promo</th>
                    @if ($pendaftaran->id_promo)
                        <td>{{ $pendaftaran->promo->kode }}</td>
                    @else
                        <td>Tidak mengambil promo.</td>
                    @endif
                    
                </tr>
                <tr>
                    <th>Diskon promo : </th>
                    <td>-Rp {{ number_format($pendaftaran->potongan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Diskon admin : </th>
                    <td>-Rp {{ number_format($pendaftaran->potongan_admin, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total harga diklat : </th>
                    <td>Rp {{ number_format($pendaftaran->harga_diklat, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran Diklat</th>
                    @if ($pendaftaran->status_pembayaran_diklat=="Lunas")
                        <td><span class="badge badge-pill badge-success">{{ $pendaftaran->status_pembayaran_diklat }}</span></td>
                    @elseif($pendaftaran->status_pembayaran_diklat=="Menunggu verifikasi")
                        <td><span class="badge badge-pill badge-warning">{{ $pendaftaran->status_pembayaran_diklat }}</span></td>
                    @elseif($pendaftaran->status_pembayaran_diklat=="kadaluarsa")
                        <td><span class="badge badge-pill badge-dark">{{ $pendaftaran->status_pembayaran_diklat }}</span></td>
                    @else
                        <td><span class="badge badge-pill badge-danger">{{ $pendaftaran->status_pembayaran_diklat }}</span></td>
                    @endif
                </tr>
               
                <tr>
                    <th>Sertifikat Diklat</th>
                    <td>
                        @if ($pendaftaran->s_doc)
                            <a href="{{ asset('storage/' . $pendaftaran->s_doc) }}">Klik Untuk Melihat Sertifikat!</a>
                        @elseif($pendaftaran->s_gambar)
                            <img src="{{ asset('storage/' . $pendaftaran->s_gambar) }}" alt="sertifikat" width="300px">
                        @elseif($pendaftaran->s_link)
                            <a href="{{ $pendaftaran->s_link }}">Klik Untuk Melihat Sertifikat!</a>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
