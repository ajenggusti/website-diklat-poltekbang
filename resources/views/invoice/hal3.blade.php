
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    {{-- <link rel="stylesheet" href="/css/style.css"> --}}
    <style>
        * {
            /* background-color: aqua; */
            /* background-image: url({{ public_path('path/to/your/background-image.jpg') }});
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.1; */
        }
        
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
                </div>
                <hr>
                {{-- <p>Order id : {{ %data }}</p> --}}
                
                <h1 style="text-align: center;">INVOICE PEMBAYARAN DIKLAT</h1>
                @if ($idPembayaranDiklat != null)
                  {{-- diambil dari tabel pembayaran --}}
                    Order id : {{ $dataDiklat->order_id }}
                    {{-- ========================================================= --}}
                    
                    <div class="info-row">
                        <strong>Waktu daftar</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->pendaftaran->created_at)->format('H:i:s | d-m-Y') }}</span><br>
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
                            <strong>Alamat</strong><span>: {{ $dataDiklat->pendaftaran->user->kelurahan->name }} | {{ $dataDiklat->pendaftaran->user->kecamatan->name }} | {{ $dataDiklat->pendaftaran->user->kabupaten->name }} | {{ $dataDiklat->pendaftaran->user->provinsi->name }}.</span><br>
                        </div>
                        <div class="info-row">
                            <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->pendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</span>
                        </div>
                    @endif
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
                                        <td>{{ $dataDiklat->pendaftaran->diklat->nama_diklat }}</td>
                                        <td>Diklat</td>
                                        <td>{{ 'Rp' . number_format($dataDiklat->pendaftaran->harga_diklat, 0, ',', '.') }}</td>
                                        <td>{{ $dataDiklat->pendaftaran->status_pembayaran_diklat }}</td>
                                    </tr>
                            
                            </tbody>
                        </table>
                    </div>
                    {{-- data pembayarannya --}}
                    <p>Order id : {{ $dataDiklat->order_id }}</p>
                    <p>Metode pembayaran : {{ $dataDiklat->metode_pembayaran }}</p>
                    <p>Waktu pembayaran  : {{ $dataDiklat->updated_at }}</p>
                    {{-- ========================================================= --}}
                @else
                {{-- diambil dari tabel pendaftaran --}}
                    
                    <div class="info-row">
                        <strong>Waktu daftar</strong><span>: {{ \Carbon\Carbon::parse($dataDiklat->created_at)->format('H:i:s | d-m-Y') }}</span><br>
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
                                    <th>Jenis Pembayaran</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    <tr>
                                        <td>{{ $dataDiklat->diklat->nama_diklat }}</td>
                                        <td>Diklat</td>
                                        <td>{{ 'Rp' . number_format($dataDiklat->harga_diklat, 0, ',', '.') }}</td>
                                        <td>{{ $dataDiklat->status_pembayaran_diklat }}</td>
                                    </tr>
                            
                            </tbody>
                        </table>
                    </div>
                    {{-- data pembayarannya --}}
                    <p>Order id : Order id belum tersedia.</p>
                    <p>Metode pembayaran : Metode pembayaran belum tersedia.</p>
                    <p>Waktu pembayaran  : waktu pembayaran belum tersedia.</p>
                @endif
                
                {{-- <div class="info-row">
                    <strong>Nama Lengkap</strong><span>: {{ $data->nama_lengkap }}</span>
                </div> --}}
                {{-- <div class="info-row">
                    <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</span>
                <div class="info-row">
                    <strong>Alamat</strong><span>: {{ $data->alamat }}</span><br>
                </div>
                <div class="info-row">
                    <strong>Email</strong><span>: {{ $data->email }}</span><br>
                </div>
                <div class="info-row">
                    <strong>No HP</strong><span>: {{ $data->no_hp }}</span><br>
                </div>
                <div class="info-row">
                    <strong>Pendidikan Terakhir</strong><span>: {{ $data->pendidikan_terakhir }}</span><br>
                </div>
                <br><br>
                <table class="invoiceTable">
                        <tr>
                            <th scope="col">Nama Diklat</th>
                            <td>{{ $data->diklat->nama_diklat }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Harga Pendaftaran</th>
                            <td>Rp 150.000</td>
                        </tr>
                        <tr>
                            <th scope="col">Status Pembayaran Pendaftaran</th>
                            <td>{{ $data->status_pembayaran_daftar }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Harga Diklat</th>
                            <td>Rp. {{ number_format($data->diklat->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Diskon</th>
                            <td>
                                @if($data->promo)
                                    <p>Rp. {{ number_format($data->promo->potongan, 0, ',', '.') }}</p>
                                @else
                                    <p> - Rp. 0</p> 
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Total Biaya</th>
                            <td>Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Status Pembayaran Diklat</th>
                            <td>{{ $data->status_pembayaran_diklat }}</td>
                        </tr>
                </table> --}}
                
               
                
            </div>
        </div>
    </div>
</body>
</html>