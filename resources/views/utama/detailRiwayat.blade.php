@extends('layout.mainUser')
@section('container')
    <html>
        <head>
            <!-- Custom styles for this template -->
            <link href="/css/landing.css" rel="stylesheet">
            <script src="/js/landing.js"></script>
            {{-- Boostrap Icons --}}
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            {{-- Font Poppins --}}
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
            
            <style>
                body {
                    font-family: 'Poppins', sans-serif;
                }

            </style>
        </head>
        <body>
            <div class="bg-detRiwayat">
                <div class="content-land">
                    <div class="content-detail">
                        <div class="card-detail">
                            {{-- <h1>Detail Pendaftaran Diklat</h1> --}}
                            <h2>Detail Pendaftaran</h2>
                            <hr>
                            <div class="detail-left">
                                Nama Lengkap : <br>
                                <span>{{ $data->user->name }}</span>
                                <br><br>

                                Email : <br>
                                <span>{{ $data->user->email }}</span>
                                <br><br>
                                
                                No HP : <br>
                                <span>{{ $data->no_hp }}</span>
                                <br><br>
                                
                                Pendidikan Terakhir : <br>
                                <span>{{ $data->pendidikan_terakhir }}</span>
                                <br><br>

                                Waktu Pendaftaran : <br>
                                <span>{{ \Carbon\Carbon::parse($data->waktu_pendaftaran)->format('H:i:s | d-m-Y') }} </span>
                                <br> <br>

                                Jenis kelengkapan berkas : <br>
                                <span>{{ $data->user->jenis_berkas }}</span>
                                <br><br>
                                Jenis kelamin : <br>
                                @if ($data->user->jenis_kelamin =="l")
                                    <span>Laki laki</span>
                                    <br><br>
                                @else
                                    <span>Perempuan</span>
                                    <br><br>
                                @endif
                                



                                {{-- data sesuai berkas user ktp ataw paspor ---------------------------------------}}
                                @if ($data->user->jenis_berkas=="ktp")
                                    Tempat Tanggal Lahir : <br>
                                    <span>{{ $data->user->tempat_lahir }} | {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</span>
                                    <br><br>
                                    Alamat : <br>
                                    <span>Kelurahan {{ $data->user->kelurahan->name }}, Kecamatan {{ $data->user->kecamatan->name }}, Kabupaten{{ $data->user->kabupaten->name }}, Provinsi {{ $data->user->provinsi->name }}</span>
                                    <br><br>
                                
                                @else
                                    Nomor paspor : <br>
                                    <span>{{ $data->user->no_paspor }}</span>
                                    <br><br>
                                    Nationality : <br>
                                    <span> {{ $data->user->Nationality->name }}</span>
                                    <br><br>
                                    Tanggal lahir : <br>
                                    <span> {{ \Carbon\Carbon::parse($data->user->tanggal_lahir)->format('d-m-Y') }}</span>
                                    <br><br>
                                @endif
                                
                                
                               
                                <br> <br>
                            </div>
                            
                            <div class="detail-right">
                                Nama diklat : <br>
                                <span>{{ $data->diklat->nama_diklat }}</span>
                                <br><br>

                                @if($data->promo)
                                    Kode Promo : <br>
                                        <span> {{ $data->promo->kode }}</span>
                                @else
                                    Kode Promo :  <br>
                                        <span> Tidak ada promo yang diambil</span>
                                @endif

                                <br><br>
                                Biaya Pendaftaran : <br>
                                <span>Rp 150.000</span>
                                <br><br>
                                
                                Status Pembayaran Pendaftaran : <br>
                                @if ($data->status_pembayaran_daftar=="Lunas")
                                    <span class="badge badge-pill badge-success">{{ $data->status_pembayaran_daftar }} Via {{ $data->jenis_pembayaran_daftar }}</span>
                                    <br><br>
                                @else
                                    <span class="badge badge-pill badge-danger">{{ $data->status_pembayaran_daftar }}</span>
                                    <br><br>
                                @endif
                                
                                
                                Harga Diklat : <br>
                                <span>Rp. {{ number_format($data->diklat->harga, 0, ',', '.') }}</span>
                                <br><br>
                                
                                <!-- Displaying Discount -->
                                @if($data->promo)
                                    Diskon promo: <br>
                                        <span> - Rp. {{ number_format($data->promo->potongan, 0, ',', '.') }} </span>
                                        <br><br>
                                @else
                                    Diskon promo: <br>
                                    <span> - Rp. 0</span> 
                                    <br><br>
                                @endif
                                Diskon Admin: <br>
                                <span> - Rp. {{ number_format($data->potongan_admin, 0, ',', '.') }} </span>
                                <br><br>
                                Total Biaya : <br>
                                <span>Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</span>
                                <br><br>
                                
                                Status Pembayaran Biaya Diklat : <br>
                                @if ($data->status_pembayaran_diklat=="Lunas")
                                    <span class="badge badge-pill badge-success">{{ $data->status_pembayaran_diklat }} Via {{ $data->jenis_pembayaran_diklat }}</span>
                                    <br><br>
                                @elseif($data->status_pembayaran_diklat=="Menunggu verifikasi")
                                    <span class="badge badge-pill badge-warning">{{ $data->status_pembayaran_diklat }}</span>
                                    <br><br>
                                @else
                                    <span class="badge badge-pill badge-danger">{{ $data->status_pembayaran_diklat }}</span>
                                    <br><br>
                                @endif
                               

                                Join Grup whatsapp: <br>
                                <span>
                                    <a href="{{ $data->diklat->whatsapp }}">Klik untuk join!</a>
                                </span>
                                <br><br>

                                <td>
                                    @if ($data->s_doc)
                                        <span>Sertifikat :</span>  <br>
                                        <a href="{{ asset('storage/' . $data->s_doc) }}">Klik Untuk Melihat Sertifikat!</a>
                                    @elseif($data->s_gambar)
                                        <span>Sertifikat :</span>  <br>
                                        <img src="{{ asset('storage/' . $data->s_gambar) }}" alt="sertifikat">
                                    @elseif($data->s_link)
                                        <span>Sertifikat :</span>  <br>
                                        <a href="{{ $data->s_link }}">Klik Untuk Melihat Sertifikat!</a>
                                    @endif
                                </td>
                                
                                <div class="col" style="margin-top: 20px;">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                                    <a href="/kelPendaftaran/{{ $data->id }}/edit" class="btn btn-warning">Edit</a>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
@endsection