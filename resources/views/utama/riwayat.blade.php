@extends('layout.mainUser')
@section('container')
    <link href="/css/riwayat.css" rel="stylesheet">
    <script src="/js/landing.js"></script>

    <div class="bg-riwayat">
        <div class="content-riwayat">
            @if (count($datas) != 0 )
                <h1>RIWAYAT DIKLAT</h1>
                @if (session('success') )
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-contentRiwayat">
                    @foreach ($datas as $key => $data)
                        <div class="card-riwayat">
                            <div class="card-content">
                                <div class="wrapper-print">
                                    <h4>{{ $dataDiklat[$key]->nama_diklat }}</h4>
                                    <hr>
                                    <div class="status-print-wrapper">
                                        <p>Status Diklat : {{ $dataDiklat[$key]->status }}</p>
                                        <a href="/invoicePdf/{{ $data->id }}" class="btn"> <i class="bi bi-printer" style="font-size: 30px;"></i></a>
                                        
                                    </div>
                                    <p>Harga Pendaftaran : Rp. 150.000</p>
                                    <p>Harga Diklat : Rp. {{ number_format($data->diklat->harga, 0, ',', '.') }}</p>
                                    <!-- Displaying Discount -->
                                    @if($data->promo)
                                        <p>Diskon: - Rp. {{ number_format($data->promo->potongan, 0, ',', '.') }}</p>
                                    @else
                                        <p>Diskon: - Rp. 0</p> 
                                    @endif
                                    <p>Total Biaya : Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</p>
                            
                                    {{-- STATUS PEMBAYARAN --}}
                                    @if ($data->status_pembayaran_daftar == "Menunggu pembayaran" || $data->status_pembayaran_daftar == "Belum dibayar")
                                        <p>Status Pembayaran Pendaftaran : <br>
                                            <span class="btn btn-warning disable" style="background-color: rgba(213, 0, 0, 0.897); text-decoration: none;">
                                                {{ $data->status_pembayaran_daftar }}
                                            </span>
                                        </p>  
                                    @elseif ($data->status_pembayaran_daftar == "Menunggu verifikasi")
                                    <p>Status Pembayaran Pendaftaran : <br>
                                        <span class="btn btn-warning disable" style="background-color: rgb(250, 244, 62); text-decoration: none; ">
                                            {{ $data->status_pembayaran_daftar }}
                                        </span>
                                    </p>
                                    @elseif ($data->status_pembayaran_daftar == "Lunas")
                                        <p>Status Pembayaran Pendaftaran : <br>
                                            <span class="btn btn-warning disable" style="background-color: rgb(91, 248, 52); text-decoration: none;">
                                                {{ $data->status_pembayaran_daftar }}
                                            </span>
                                        </p>
                                    @endif
                                
                                    @if ($data->status_pembayaran_diklat == "Menunggu pembayaran" || $data->status_pembayaran_diklat == "Belum dibayar" )
                                    <p>Status Pembayaran Diklat : <br>
                                        <span class="btn btn-warning disable" style="background-color: rgba(213, 0, 0, 0.897); text-decoration: none;">
                                            {{ $data->status_pembayaran_diklat }}
                                        </span>
                                    </p> 
                                    @elseif ($data->status_pembayaran_diklat == "Menunggu verifikasi")
                                    <p>Status Pembayaran Diklat : <br>
                                        <span class="btn btn-warning disable" style="background-color: rgb(250, 244, 62); text-decoration: none; ">
                                            {{ $data->status_pembayaran_diklat }}
                                        </span>
                                    </p>
                                    @elseif ($data->status_pembayaran_diklat == "Lunas")
                                    <p>Status Pembayaran Diklat : <br>
                                        <span class="btn btn-warning disable" style="background-color: rgb(91, 248, 52); text-decoration: none;">
                                            {{ $data->status_pembayaran_diklat }}
                                        </span>
                                    </p>
                                    @endif
                    
                                
                                    

                                    <p>Lakukan pembayaran : </p>
                                    <div class="col">
                                        @if ($data->status_pembayaran_daftar != "Lunas")
                                            <form id="hiddenFormPendaftaran" method="POST" action="{{ route('kelPembayaranPendaftaran.savePendaftaran') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            </form>
                                            <a href="#" onclick="submitFormPendaftaran()" class="btn btn-secondary">Bayar Daftar</a>
                                        @endif
                                        @if ($data->status_pembayaran_diklat != "Lunas")
                                            <form id="hiddenFormDiklat" method="POST" action="{{ route('kelPembayaranDiklat-form.createDiklat') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            </form>
                                            <a href="#" onclick="submitFormDiklat()" class="btn btn-secondary">Bayar Diklat</a>
                                        @endif
                                    </div>
                                    <br>
                                    
                                    
                                    {{-- <a href="/detailRiwayat/{{ $data->id }}" class="btn btn-info">Lihat</a> --}}
                                    <br>
                                    
                                    <div class="button-transaksi">
                                        <p>Bukti Pembayaran :</p>
                                        <form id="transaksiPembayaran" method="POST" action="{{ route('bukti-pembayaran.buktiPembayaran') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                        </form>
                                        <a href="#"  style="background-color: rgb(248, 132, 0); color: #ffffff;" onclick="submitFormTransaksi()" class="btn btn-secondary transaksi-btn">Transaksi Pembayaran</a>
                                        <br><br>
                                        @if ($data->s_doc)
                                            <a href="{{ route('kelTestimoni.create', ['id' => $data->id]) }}"class="btn transaksi-btn" style="background-color: rgb(44, 138, 192); color: #ffffff;">Kirim Testimoni</a>
                                        @elseif($data->s_gambar)
                                            <a href="{{ route('kelTestimoni.create', ['id' => $data->id]) }}"class="btn transaksi-btn" style="background-color: rgb(44, 138, 192); color: #ffffff;">Kirim Testimoni</a>
                                        @elseif($data->s_link)
                                            <a href="{{ route('kelTestimoni.create', ['id' => $data->id]) }}"class="btn transaksi-btn" style="background-color: rgb(44, 138, 192); color: #ffffff;">Kirim Testimoni</a>
                                        @endif
                                    </div>
                                </div>
            
                                <br>
                                <hr>
                                <div class="row" style="text-align: center; padding-bottom: 10px;">
                                    <div class="col">
                                        {{-- <a href="/detailRiwayat/{{ $data->id }}" class="btn btn-info">Lihat</a> --}}
                                        <a href="/detailRiwayat/{{ $data->id }}" class="btn btn-info"><i class="bi bi-eye"></i> Detail</a>
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
                <div class="text-center no-found">
                    
                    <img src="{{ asset('img/search.png') }}" alt="data not found">
                    <h2>Ups!!Kamu belum daftar diklat</h2>
                    <a href="/">Back to previous</a>
                </div>
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
    </div>
@endsection
