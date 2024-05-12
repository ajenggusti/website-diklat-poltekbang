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
                @if (count($datas) != 0 )
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
                                    <hr>
                                    {{-- <p>Status Diklat : {{ $dataDiklat[$key]->status }}</p> --}}
                                    <p>Harga Pendaftaran : Rp. 150.000</p>
                                    <p>Status Pembayaran Pendaftaran : 
                                        <span class="btn btn-warning disable" style="text-decoration: none;">{{ $data->status_pembayaran_daftar }}</span>
                                    </p>    
                                    <p>Harga Diklat : Rp. {{ number_format($data->diklat->harga, 0, ',', '.') }}</p>
                                    <p>Status Pembayaran Diklat : 
                                        <span class="btn btn-warning disable" style="text-decoration: none;">{{ $data->status_pembayaran_diklat }}</span>
                                    </p>
                                    <!-- Displaying Discount -->
                                    @if($data->promo)
                                        <p>Diskon: - Rp. {{ number_format($data->promo->potongan, 0, ',', '.') }}</p>
                                    @else
                                        <p>Diskon: - Rp. 0</p> 
                                    @endif
                                    <p>Total Biaya : Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</p>
                                    
                                    
                                    {{-- <p>Lakukan pembayaran ? <a href="{{ route('kelPembayaran.create', ['id' => $data->id]) }}">Bayar Disini</a></p> --}}
                                    

                                    <p>Lakukan pembayaran : </p>
                                    <div class="col">
                                        @if ($data->status_pembayaran_daftar != "Lunas")
                                            <form id="hiddenFormPendaftaran" method="POST" action="{{ route('kelPembayaranPendaftaran.savePendaftaran') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            </form>
                                            <a href="#" onclick="submitFormPendaftaran()" class="btn btn-secondary">Pendaftaran?</a>
                                        @endif
                                        @if ($data->status_pembayaran_diklat != "Lunas")
                                            <form id="hiddenFormDiklat" method="POST" action="{{ route('kelPembayaranDiklat-form.createDiklat') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            </form>
                                            <a href="#" onclick="submitFormDiklat()" class="btn btn-secondary">Diklat?</a>
                                        @endif
                                    </div>
                                    <p>Bukti Pembayaran :</p>
                                    <form id="transaksiPembayaran" method="POST" action="{{ route('bukti-pembayaran.buktiPembayaran') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                    </form>
                                    <a href="#"  style="background-color: palevioletred; color: #ffffff;" onclick="submitFormTransaksi()" class="btn btn-secondary">Transaksi Pembayaran</a>

                                    @if ($data->s_doc)
                                        <a href="{{ route('kelTestimoni.create', ['id' => $data->id]) }}"class="btn btn-info" style="background-color: rgb(44, 138, 192); color: #ffffff;">Sampaikan Pendapatmu</a>
                                    @elseif($data->s_gambar)
                                        <a href="{{ route('kelTestimoni.create', ['id' => $data->id]) }}"class="btn" style="background-color: rgb(44, 138, 192); color: #ffffff;">Sampaikan Pendapatmu</a>
                                    @elseif($data->s_link)
                                        <a href="{{ route('kelTestimoni.create', ['id' => $data->id]) }}"class="btn" style="background-color: rgb(44, 138, 192); color: #ffffff;">Sampaikan Pendapatmu</a>
                                    @endif
             
                                    <hr>
                                    <div class="row" style="text-align: center; padding-bottom: 10px;">
                                        <div class="col">
                                            <a href="/riwayat/{{ $data->id }}" class="btn btn-info"><i class="bi bi-eye"></i> Detail</a>
                                            <a href="/kelPendaftaran/{{ $data->id }}/edit" class="btn btn-success"><i class="bi bi-pencil-square"></i> Edit</a>
                                        {{-- </div> --}}
                                        {{-- <div class="col"> --}}
                                            <form action="/kelPendaftaran/{{ $data->id }}" method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i>Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <br> <br>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    @else
                        <p>ups kamu belum daftar diklat</p>
                    @endif

                    <script>
                        function submitFormPendaftaran() {
                            document.getElementById('hiddenFormPendaftaran').submit();  
                        }
                        function submitFormDiklat() {
                            document.getElementById('hiddenFormDiklat').submit();
                        }
                        function submitFormTransaksi() {
                            document.getElementById('transaksiPembayaran').submit(); 
                        }
                    </script>
            </div>
        </body>
    </html>
@endsection
