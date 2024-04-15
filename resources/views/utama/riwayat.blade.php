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
            <div class="content-land">
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
                            <p>Status Pembayaran Diklat : {{ $data->status_pembayaran_daftar }}</p>
                            {{-- {{ $data->id }} --}}

                            <div class="riwayat-tombol row">
                                <div class="col" style="text-align: right;">
                                    <button onclick="window.location.href = '/riwayat/{{ $data->id }}'" class="btn btn-success"><i class="bi bi-eye"></i></button>
                                </div>

                                <a href="{{ route('kelPembayaran.create', ['id' => $data->id]) }}" class="btn btn-secondary">Lakukan Pembayaran?</a>
                                
                                <div class="col">
                                    <form action="/kelPendaftaran/{{ $data->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></button>
                                    </form>
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
