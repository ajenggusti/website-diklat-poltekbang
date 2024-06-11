
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            position: relative;
        }

        .container-Hal3::before {
            content: "";
            position: fixed;
            top: 50%;
            left: 50%;
            width: 55%;
            height: 55%;
            background: url('{{ public_path('img/hitamputih_hal3.png') }}') no-repeat center center fixed;
            background-size: contain;
            opacity: 0.1;
            z-index: -1;
            transform: translate(-50%, -50%);
        }

        .container-Hal3 {
            position: relative;
            z-index: 1;
            padding: 20px 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 20px auto;
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

        .content-invoice {
            display: flex;
            flex-direction: column;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .info-row strong {
            width: 160px;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #0030c2;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #ddd;
        }

        tbody tr td:nth-child(3), tbody tr td:nth-child(4) {
            text-align: center;
        }
    </style>
    
</head>
<body>
    <div class="container-Hal3">
        <div class="invoice-content">
            <div class="invoice-details">
                <div class="card-header">
                    <img src="{{ public_path('img/poltek.png') }}" alt="Poltekbang Image">
                    <h1 style="text-align: center;">Politeknik Penerbangan Surabaya</h1>
                    <span>Jalan Jemur Andayani No 73 Surabaya 60236</span><br>
                    <span>Tel/Fax. 62 31 8410871/62 31 8490005 | Email. mail@poltekbangsby.ac.id</span><br>
                    <span>Laman: https://shortcourses.poltekbangsby.ac.id</span>
                </div>
                <hr>
                {{-- <p>Order id : {{ %data }}</p> --}}
                
                <h1 style="text-align: center;">INVOICE PEMBAYARAN DIKLAT</h1>
                <div class="content-invoice">
                    @if ($idPembayaranDiklat != null)
                    {{-- diambil dari tabel pembayaran --}}
                        {{-- ========================================================= --}}
                        
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
    </div>
</body>
</html>