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
                    @foreach ($datas as $index => $data)
                    {{-- {{ $data->id }} --}}
                        <div class="card-riwayat">
                            <div class="card-content">
                                <div class="wrapper-print">
                                    <h5>{{ $data->diklat->nama_diklat }}</h5>
                                    <hr>
                                    <div class="status-print-wrapper">
                                        <p>Status Diklat : {{ $data->diklat->status }}</p>
                                        <a href="/invoicePdf/{{ $data->id }}" class="btn"> <i class="bi bi-printer" style="font-size: 30px;"></i></a>
                                    </div>
                                    <p>Harga Pendaftaran : Rp. 150.000</p>
                                    <p>Status Pembayaran Pendaftaran :
                                        @if ($data->status_pembayaran_daftar=="Lunas")
                                            <span class="badge badge-pill badge-success">{{ $data->status_pembayaran_daftar }} Via {{ $data->jenis_pembayaran_daftar }}</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">{{ $data->status_pembayaran_daftar }}</span>
                                        @endif
                                    </p> 

                                    <p>Harga Diklat : Rp. {{ number_format($data->harga_asli_diklat, 0, ',', '.') }}</p>
                                    <!-- Displaying Discount -->
                                    {{-- @if($data->promo) --}}
                                        <p>Diskon promo: - Rp. {{ number_format($data->potongan, 0, ',', '.') }}</p>
                                        <p>Diskon admin: - Rp. {{ number_format($data->potongan_admin, 0, ',', '.') }}</p>
                                    {{-- @else
                                        <p>Diskon: - Rp. 0</p> 
                                    @endif --}}
                                    <p>Total Biaya Diklat : Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</p>
                        
                                     <p>Status Pembayaran Diklat :
                                        @if ($data->status_pembayaran_diklat=="Lunas")
                                            <span class="badge badge-pill badge-success">{{ $data->status_pembayaran_diklat }} Via {{ $data->jenis_pembayaran_diklat }}</span>
                                        @elseif($data->status_pembayaran_diklat=="Menunggu verifikasi")
                                            <span class="badge badge-pill badge-warning">{{ $data->status_pembayaran_diklat }}</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">{{ $data->status_pembayaran_diklat }}</span>
                                        @endif
                                    </p> 

                                    <div class="col">
                                        @if ($data->status_pembayaran_daftar != "Lunas")
                                            <form id="hiddenFormPendaftaran{{ $index }}" method="POST" action="{{ route('kelPembayaranPendaftaran.savePendaftaran') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            </form>
                                            <a href="#" onclick="submitFormPendaftaran('hiddenFormPendaftaran{{ $index }}')" class="btn btn-secondary"><i class="bi bi-currency-dollar"></i>Bayar Daftar</a>
                                        @endif
                                        @if ($data->status_pembayaran_diklat != "Lunas")
                                            <form id="hiddenFormDiklat{{ $index }}" method="POST" action="{{ route('kelPembayaranDiklat-form.createDiklat') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            </form>
                                            <a href="#" onclick="submitFormDiklat('hiddenFormDiklat{{ $index }}')" class="btn btn-secondary"><i class="bi bi-currency-dollar"></i>Bayar Diklat</a>
                                        @endif
                                    </div>
                                    <br>
                                    
                                    
                                    {{-- <a href="/detailRiwayat/{{ $data->id }}" class="btn btn-info">Lihat</a> --}}
                                    <br>
                                    
                                    <div class="button-transaksi">
                                        <form id="transaksiPembayaran{{ $index }}" method="POST" action="{{ route('bukti-pembayaran.buktiPembayaran') }}">
                                            @csrf
                                            <input type="hidden" name="id" id="hiddenId{{ $index }}" value="{{ $data->id }}">
                                        </form>
                                        
                                        <a href="#" style="background-color: rgb(248, 132, 0); color: #ffffff;" 
                                           onclick="submitFormTransaksi('transaksiPembayaran{{ $index }}', '{{ $index }}')" 
                                           class="btn btn-secondary transaksi-btn"><i class="bi bi-clipboard-data"></i>
                                            Transaksi Pembayaran
                                        </a>

                                        <br><br>
                                        @if ($data->s_doc || $data->s_gambar || $data->s_link)
                                            <a href="{{ route('kelTestimoni.create', ['id' => $data->id]) }}"class="btn transaksi-btn" style="background-color: rgb(44, 138, 192); color: #ffffff;"><i class="bi bi-chat-left-quote"></i> Kirim Testimoni</a>
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
                    function submitFormPendaftaran(formId) {
                        document.getElementById(formId).submit(); 
                    }
                    function submitFormDiklat(formId) {
                        document.getElementById(formId).submit();
                    }
                    function submitFormTransaksi(formId, index) {
                        document.getElementById(formId).submit();
                    }
                </script>
        </div>
    </div>
@endsection
