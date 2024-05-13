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
                            <h2>INVOICE!!</h2>
                            <hr>
                            <div class="detail-left">
                                Nama diklat : <br>
                                <span>{{ $data->diklat->nama_diklat }}</span>
                                <br><br>

                                Nama Lengkap : <br>
                                <span>{{ $data->nama_lengkap }}</span>
                                <br><br>
                                
                                {{-- Tempat Lahir : <br>
                                <span>{{ $data->tempat_lahir }}</span>
                                <br><br> --}}
                                
                                {{-- jangan lupa kasih format --}}
                                Tanggal Lahir : <br>
                                <span>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</span>
                                <br><br>
                                
                                Alamat : <br>
                                <span>{{ $data->alamat }}</span>
                                <br><br>
                                
                                Email : <br>
                                <span>{{ $data->email }}</span>
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
                            </div>
                            
                            <div class="detail-right">
                                

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
                                <span>{{ $data->status_pembayaran_daftar }}</span>
                                <br><br>
                                
                                Harga Diklat : <br>
                                <span>Rp. {{ number_format($data->diklat->harga, 0, ',', '.') }}</span>
                                <br><br>
                                
                                <!-- Displaying Discount -->
                                @if($data->promo)
                                        Diskon: <br>
                                            <span> - Rp. {{ number_format($data->promo->potongan, 0, ',', '.') }} </span>
                                    @else
                                        Diskon: <br>
                                        <span> - Rp. 0</span> 
                                    @endif
                                <br><br>
                                Total Biaya : <br>
                                <span>Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</span>
                                <br><br>
                                
                                Status Pembayaran Biaya Diklat : <br>
                                <span>{{ $data->status_pembayaran_diklat }} </span>
                                <br><br>

                                Join Grup whatsapp: <br>
                                <span>
                                    <a href="{{ $data->diklat->whatsapp }}">Klik untuk join!</a>
                                </span>
                                <br><br>

                                <td>
                                    @if ($data->s_doc)
                                    Sertifikat :  <a href="{{ asset('storage/' . $data->s_doc) }}">Klik Untuk Melihat Sertifikat!</a>
                                    @elseif($data->s_gambar)
                                        Sertifikat :<img src="{{ asset('storage/' . $data->s_gambar) }}" alt="sertifikat">
                                    @elseif($data->s_link)
                                        Sertifikat :<a href="{{ $data->s_link }}">Klik Untuk Melihat Sertifikat!</a>
                                    @endif
                                </td>
                                
                                <div class="col">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                                    <a href="/kelPendaftaran/{{ $data->id }}/edit" class="btn btn-warning">Edit</a>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
@endsection