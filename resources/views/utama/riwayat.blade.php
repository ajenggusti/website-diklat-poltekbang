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
            <div class="content-riwayat">
                <h1>RIWAYAT DIKLAT</h1>
                    @if (session('success') )
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="cards-container">
                        @foreach ($datas as $key => $data)
                        <div class="card-riwayat">
                            <div class="card-content">
                                <h3>{{ $dataDiklat[$key]->nama_diklat }}</h3>
                                <p>Status Diklat : {{ $dataDiklat[$key]->status }}</p>
                                <p>Harga Diklat : Rp. {{ number_format($data->diklat->harga, 0, ',', '.') }}</p>
                                <!-- Displaying Discount -->
                                @if($data->promo)
                                    <p>Diskon: - Rp. {{ number_format($data->promo->potongan, 0, ',', '.') }}</p>
                                @else
                                    <p>Diskon: - Rp. 0</p> 
                                @endif
                                <p>Total Biaya : Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</p>
                                <p>Status Pembayaran Diklat : {{ $data->status_pembayaran_diklat }}</p>
                                <p>Harga Pendaftaran : Rp. 150.000</p>
                                <p>Status Pembayaran Pendaftaran : {{ $data->status_pembayaran_daftar }}</p>

                                <a href="/riwayat/{{ $data->id }}" class="btn btn-success">Lihat</a>
                                
                                <p>Lakukan pembayaran ? <a href="{{ route('kelPembayaran.create', ['id' => $data->id]) }}" class="btn"><i class="bi bi-cash-coin" style="font-size: 24px;"></i></a></p>
                                <form action="/kelPendaftaran/{{ $data->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>

                                <p>Bukti Pembayaran : <a href="/bukti-pembayaran/{{ $data->id }}" class="btn" style=" color: #000000;"><i class="bi bi-wallet"></i></a> </p>

                                @if ($data->s_doc)
                                    <a href="{{ route('kelTestimoni.create', ['id' => $data->id]) }}"class="btn" style="background-color: rgb(44, 138, 192); color: #ffffff;">Sampaikan Pendapatmu</a>
                                @elseif($data->s_gambar)
                                    <a href="{{ route('kelTestimoni.create', ['id' => $data->id]) }}"class="btn" style="background-color: rgb(44, 138, 192); color: #ffffff;">Sampaikan Pendapatmu</a>
                                @elseif($data->s_link)
                                    <a href="{{ route('kelTestimoni.create', ['id' => $data->id]) }}"class="btn" style="background-color: rgb(44, 138, 192); color: #ffffff;">Sampaikan Pendapatmu</a>
                                @endif
                                
                                

                                <div class="riwayat-tombol row">

                                    {{-- <a href="{{ route('kelPembayaran.create', ['id' => $data->id]) }}" class="btn btn-secondary">Lakukan Pembayaran?</a> --}}
                                    
                                    {{-- <div class="col">
                                        <button onclick="window.location.href = '/riwayat/{{ $data->id }}'" class="btn btn-success"><i class="bi bi-eye" style="font-size: 24px;"></i></button> <span></span>
                                        <a href="/kelPendaftaran/{{ $data->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square" style="font-size: 24px;"></i></a> <span></span>
                                        <form action="/kelPendaftaran/{{ $data->id }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash" style="font-size: 24px;"></i></button>
                                        </form>
                                        <br> <br>
                                        
                                        
                                    </div> --}}
                                
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <br> <br>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
            </div>
        </body>
    </html>
@endsection
