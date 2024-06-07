
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    {{-- <link rel="stylesheet" href="/css/style.css"> --}}
    <style>
        
        .invoice-details {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 20px auto;
            /* background-image: url('poltekbang.png'); */
        }

        .card-header {
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-header img {
            width: 100px;
            height: auto;
            margin-right: 20px;
        }
        
        .card-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .info-row {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 10px;
        }

        .info-row strong {
            width: 160px; /* Adjust width as necessary */
            display: inline-block;
            line-height: 1.0;
        }

        .info-row span {
            flex: 1;
            line-height: 0.6;
        }


        .col {
            clear: both;
            text-align: center;
            margin-top: 20px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .info-row strong {
            flex-basis: 30%;
        }

        .info-row span {
            flex-basis: 70%;
        }

        table, th, td {
            border: 1px solid black; 
        }
        th, td{
            text-align: left;
            /* border: 1px solid black; */
        }
    </style>
    
</head>
<body>
    <div class="container">
        <div class="invoice-content">
            <div class="invoice-details">
                <div class="card-header">
                    <img src="{{ public_path('img/poltek.png') }}" alt="Poltekbang Image">
                    <h1 style="text-align: center;">Politeknik Penerbangan Surabaya</h1>
                    <span>Jalan Jemur Andayani No 73 Surabaya 60236</span><br>
                    <span>Tel/Fax. 62 31 8410871/62 31 8490005 | Email. mail@poltekbangsby.ac.id</span><br>
                    <span>Laman: https://web.poltekbangsby.ac.id/course-list/</span>
                </div>
                <hr>
                {{-- <p>Order id : {{ %data }}</p> --}}
                
                <h1 style="text-align: center;">INVOICE PEMBAYARAN DIKLAT</h1>
                @if ($idPembayaranDiklat != null)
                  {{-- diambil dari tabel pembayaran --}}
                    {{-- ========================================================= --}}
                    <div class="content-invoice">
                        {{-- data pembayarannya --}}
                        <div class="content-right">
                            <p>Pembayaran id : {{ $dataPendaftaran->order_id }}</p>
                            <p>Metode pembayaran : {{ $dataPendaftaran->metode_pembayaran }}</p>
                            <p>Waktu pembayaran  : {{ \Carbon\Carbon::parse($dataPendaftaran->updated_at)->format('H:i:s | d-m-Y') }}</p>
                        </div>
                        <br><br>
                        <div class="info-container">
                            <div class="leftInvoice">
                                <div class="info-row">
                                    <strong>Jenis berkas</strong><span>: {{ $dataPendaftaran->pendaftaran->user->jenis_berkas }}</span><br>
                                </div>
                                {{-- pembeda berkas --}}
                                @if ($dataPendaftaran->pendaftaran->user->jenis_berkas == "paspor")
                                    <div class="info-row">
                                        <strong>Nomor paspor</strong><span>: {{ $dataPendaftaran->pendaftaran->user->no_paspor }}</span><br>
                                    </div>
                                    <div class="info-row">
                                        <strong>Nationality</strong><span>: {{ $dataPendaftaran->pendaftaran->user->Nationality->name }}</span><br>
                                    </div>
                                    <div class="info-row">
                                        <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($dataPendaftaran->pendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</span>
                                    </div>
                                @else
                                    <div class="info-row">
                                        <strong>NIK</strong><span>: {{ $dataPendaftaran->pendaftaran->user->nik }}</span><br>
                                    </div>
                                    <div class="info-row">
                                        <strong>Tempat lahir</strong><span>: {{ $dataPendaftaran->pendaftaran->user->tempat_lahir }}</span><br>
                                    </div>
                                    <div class="info-row">
                                        <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($dataPendaftaran->pendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</span>
                                    </div>
                                    <div class="info-row">
                                        <strong>Alamat</strong><span>: {{ $dataPendaftaran->pendaftaran->user->kelurahan->name }} | {{ $dataPendaftaran->pendaftaran->user->kecamatan->name }} | {{ $dataPendaftaran->pendaftaran->user->kabupaten->name }} | {{ $dataPendaftaran->pendaftaran->user->provinsi->name }}.</span><br>
                                    </div>
                                @endif
                            </div>
                            <div class="rightInvoice">
                                <div class="info-row">
                                    <strong>Waktu daftar</strong><span>: {{ \Carbon\Carbon::parse($dataPendaftaran->pendaftaran->created_at)->format('H:i:s | d-m-Y') }}</span><br>
                                </div>
                                <div class="info-row">
                                    <strong>Nama Lengkap</strong><span>: {{ $dataPendaftaran->pendaftaran->user->name }}</span><br>
                                </div>
                                <div class="info-row">
                                    @if ($dataPendaftaran->pendaftaran->user->jenis_kelamin =="l")
                                        <strong>Jenis kelamin</strong><span>: Laki laki</span><br>
                                    @else
                                        <strong>Jenis kelamin</strong><span>: Perempuan</span><br>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        {{-- pesanannya --}}
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Diklat</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                        <tr>
                                            <td>{{ $dataPendaftaran->pendaftaran->diklat->nama_diklat }}</td>
                                            <td>Pendaftaran</td>
                                            <td>Rp 150.000</td>
                                            <td>{{ $dataPendaftaran->pendaftaran->status_pembayaran_daftar }}</td>
                                        </tr>
                                
                                </tbody>
                            </table>
                        </div>
                        
                        {{-- ========================================================= --}}
                @else
                {{-- diambil dari tabel pendaftaran --}}
                    <div class="content-invoice">
                        {{-- data pembayarannya --}}
                        <div class="content-right">
                            <p>Pembayaran id: Belum tersedia.</p>
                            <p>Metode pembayaran : Belum tersedia.</p>
                            <p>Waktu pembayaran  : Belum tersedia.</p>
                        </div>
                        <div class="info-container">
                            <div class="leftInvoice">
                                <div class="info-row">
                                    <strong>Jenis berkas</strong><span>: {{ $dataDiklat->pendaftaran->user->jenis_berkas }}</span><br>
                                </div>
                                {{-- pembeda berkas --}}
                                @if ($dataDiklat->pendaftaran->user->jenis_berkas == "paspor")
                                    <div class="info-row">
                                        <strong>Nomor paspor</strong><span>: {{ $dataDiklat->pendaftaran->user->no_paspor }}</span><br>
                                    </div>
                                    <div class="info-row">
                                        <strong>Nationality</strong><span>: {{ $dataDiklat->pendaftaran->user->Nationality->name }}</span><br>
                                    </div>
                                    <div class="info-row">
                                        <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->pendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</span>
                                    </div>
                                @else
                                    <div class="info-row">
                                        <strong>NIK</strong><span>: {{ $dataDiklat->pendaftaran->user->nik }}</span><br>
                                    </div>
                                    <div class="info-row">
                                        <strong>Tempat lahir</strong><span>: {{ $dataDiklat->pendaftaran->user->tempat_lahir }}</span><br>
                                    </div>
                                    <div class="info-row">
                                        <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->pendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</span>
                                    </div>
                                    <div class="info-row">
                                        <strong>Alamat</strong><span>: {{ $dataDiklat->pendaftaran->user->kelurahan->name }} | {{ $dataDiklat->pendaftaran->user->kecamatan->name }} | {{ $dataDiklat->pendaftaran->user->kabupaten->name }} | {{ $dataDiklat->pendaftaran->user->provinsi->name }}.</span><br>
                                    </div>
                                    
                                @endif
                            </div>
                            <div class="rightInvoice">
                                <div class="info-row">
                                    <strong>Waktu daftar</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->pendaftaran->created_at)->format('H:i:s | d-m-Y') }}</span><br>
                                </div>
                                <div class="info-row">
                                    <strong>Nama Lengkap</strong><span>: {{ $dataDiklat->pendaftaran->user->name }}</span><br>
                                </div>
                                <div class="info-row">
                                    @if ($dataDiklat->pendaftaran->user->jenis_kelamin =="l")
                                        <strong>Jenis kelamin</strong><span>: Laki laki</span><br>
                                        @else
                                        <strong>Jenis kelamin</strong><span>: Perempuan</span><br>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        
                        {{-- pesanannya --}}
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Diklat</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                        <tr>
                                            <td>{{ $dataPendaftaran->diklat->nama_diklat }}</td>
                                            <td>Pendaftaran</td>
                                            <td>Rp 150.000</td>
                                            <td>{{ $dataPendaftaran->status_pembayaran_daftar }}</td>
                                        </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>    





                    <div class="info-row">
                        <strong>Waktu daftar</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->pendaftaran->created_at)->format('H:i:s | d-m-Y') }}</span><br>
                    </div>
                    <div class="info-row">
                        <strong>Nama Lengkap</strong><span>: {{ $dataDiklat->pendaftaran->user->name }}</span><br>
                    </div>
                    <div class="info-row">
                        @if ($dataDiklat->pendaftaran->user->jenis_kelamin =="l")
                            <strong>Jenis kelamin</strong><span>: Laki laki</span><br>
                            @else
                            <strong>Jenis kelamin</strong><span>: Perempuan</span><br>
                        @endif
                    </div>
                    <div class="info-row">
                        <strong>Jenis berkas</strong><span>: {{ $dataDiklat->pendaftaran->user->jenis_berkas }}</span><br>
                    </div>
                    {{-- pembeda berkas --}}
                    @if ($dataDiklat->pendaftaran->user->jenis_berkas == "paspor")
                        <div class="info-row">
                            <strong>Nomor paspor</strong><span>: {{ $dataDiklat->pendaftaran->user->no_paspor }}</span><br>
                        </div>
                        <div class="info-row">
                            <strong>Nationality</strong><span>: {{ $dataDiklat->pendaftaran->user->Nationality->name }}</span><br>
                        </div>
                        <div class="info-row">
                            <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->pendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</span>
                        </div>
                    @else
                        <div class="info-row">
                            <strong>NIK</strong><span>: {{ $dataDiklat->pendaftaran->user->nik }}</span><br>
                        </div>
                        <div class="info-row">
                            <strong>Tempat lahir</strong><span>: {{ $dataDiklat->pendaftaran->user->tempat_lahir }}</span><br>
                        </div>
                        <div class="info-row">
                            <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->pendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</span>
                        </div>
                        <div class="info-row">
                            <strong>Alamat</strong><span>: {{ $dataDiklat->pendaftaran->user->kelurahan->name }} | {{ $dataDiklat->pendaftaran->user->kecamatan->name }} | {{ $dataDiklat->pendaftaran->user->kabupaten->name }} | {{ $dataDiklat->pendaftaran->user->provinsi->name }}.</span><br>
                        </div>
                        
                    @endif
                    {{-- pesanannya --}}
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Diklat</th>
                                    <th>Harga diklat</th>
                                    <th>Kode Promo</th>
                                    <th>Diskon promo</th>
                                    <th>Diskon admin</th>
                                    <th>Total harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    <tr>
                                        <td>{{ $dataDiklat->pendaftaran->diklat->nama_diklat }}</td>
                                        <td>{{ 'Rp ' . number_format($dataDiklat->pendaftaran->harga_asli_diklat, 0, ',', '.') }}</td>
                                        @if($dataDiklat->pendaftaran->id_promo)
                                            <td>{{ $dataDiklat->pendaftaran->promo->kode }}</td>
                                        @else
                                            <td>Tidak ada promo yang diambil</td>
                                        @endif
                                        <td>{{ '-Rp ' . number_format($dataDiklat->pendaftaran->potongan, 0, ',', '.') }}</td>
                                        <td>{{ '-Rp ' . number_format($dataDiklat->pendaftaran->potongan_admin, 0, ',', '.') }}</td>
                                        <td>{{ 'Rp ' . number_format($dataDiklat->pendaftaran->harga_diklat, 0, ',', '.') }}</td>
                                        <td>{{ $dataDiklat->pendaftaran->status_pembayaran_diklat }}</td>
                                    </tr>
                            
                            </tbody>
                        </table>
                    </div>
                    {{-- data pembayarannya --}}
                    <p>Pembayaran id : {{ $dataDiklat->order_id }}</p>
                    <p>Metode pembayaran : {{ $dataDiklat->metode_pembayaran }}</p>
                    <p>Waktu pembayaran  : {{ \Carbon\Carbon::parse($dataDiklat->updated_at)->format('H:i:s | d-m-Y') }}</p>
                    {{-- ========================================================= --}}
                @else
                {{-- diambil dari tabel pendaftaran --}}
                    
                    <div class="info-row">
                        <strong>Waktu daftar</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->created_at)->format('H:i:s | d-m-Y') }}</span><br>
                    </div>
                    <div class="info-row">
                        <strong>Nama Lengkap</strong><span>: {{ $dataDiklat->user->name }}</span><br>
                    </div>
                    <div class="info-row">
                        @if ($dataDiklat->user->jenis_kelamin =="l")
                            <strong>Jenis kelamin</strong><span>: Laki laki</span><br>
                            @else
                            <strong>Jenis kelamin</strong><span>: Perempuan</span><br>
                        @endif
                    </div>
                    <div class="info-row">
                        <strong>Jenis berkas</strong><span>: {{ $dataDiklat->user->jenis_berkas }}</span><br>
                    </div>
                    {{-- pembeda berkas --}}
                    @if ($dataDiklat->user->jenis_berkas == "paspor")
                        <div class="info-row">
                            <strong>Nomor paspor</strong><span>: {{ $dataDiklat->user->no_paspor }}</span><br>
                        </div>
                        <div class="info-row">
                            <strong>Nationality</strong><span>: {{ $dataDiklat->user->Nationality->name }}</span><br>
                        </div>
                        <div class="info-row">
                            <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->user->tanggal_lahir)->format('d-m-Y') }}</span>
                        </div>
                    @else
                        <div class="info-row">
                            <strong>NIK</strong><span>: {{ $dataDiklat->user->nik }}</span><br>
                        </div>
                        <div class="info-row">
                            <strong>Tempat lahir</strong><span>: {{ $dataDiklat->user->tempat_lahir }}</span><br>
                        </div>
                        <div class="info-row">
                            <strong>Alamat</strong><span>: {{ $dataDiklat->user->kelurahan->name }} | {{ $dataDiklat->user->kecamatan->name }} | {{ $dataDiklat->user->kabupaten->name }} | {{ $dataDiklat->user->provinsi->name }}.</span><br>
                        </div>
                        <div class="info-row">
                            <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->user->tanggal_lahir)->format('d-m-Y') }}</span>
                        </div>
                    @endif
                    {{-- pesanannya --}}
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Diklat</th>
                                    <th>Harga diklat</th>
                                    <th>Kode Promo</th>
                                    <th>Diskon promo</th>
                                    <th>Diskon admin</th>
                                    <th>Total harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    <tr>
                                        <td>{{ $dataDiklat->diklat->nama_diklat }}</td>
                                        <td>{{ 'Rp ' . number_format($dataDiklat->harga_asli_diklat, 0, ',', '.') }}</td>
                                        @if($dataDiklat->id_promo)
                                            <td>{{ $dataDiklat->promo->kode }}</td>
                                        @else
                                            <td>Tidak ada promo yang diambil</td>
                                        @endif
                                        <td>{{ '-Rp ' . number_format($dataDiklat->potongan, 0, ',', '.') }}</td>
                                        <td>{{ '-Rp ' . number_format($dataDiklat->potongan_admin, 0, ',', '.') }}</td>
                                        <td>{{ 'Rp ' . number_format($dataDiklat->harga_diklat, 0, ',', '.') }}</td>
                                        <td>{{ $dataDiklat->status_pembayaran_diklat }}</td>
                                    </tr>
                            
                            </tbody>
                        </table>
                    </div>
                    {{-- data pembayarannya --}}
                    <p>Pembayaran id : Belum tersedia.</p>
                    <p>Metode pembayaran : Belum tersedia.</p>
                    <p>Waktu pembayaran  : Belum tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>