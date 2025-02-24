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

        .container::before{
            content: "";
            position: fixed;
            top: 50%;
            left: 50%;
            width: 55%;
            height: 55%;
            background: url('{{ public_path('img/poltekbang_hal2.png') }}') no-repeat center center fixed;
            background-size: contain;
            opacity: 0.1;
            z-index: -1;
            transform: translate(-50%, -50%);
        }

        .container {
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

        .content-right {
            display: flex;
            flex-direction: column;
            margin-left: 400px;
            font-size: 15px;
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
    <div class="container">
        <div class="invoice-content">
            <div class="invoice-details">
                <div class="card-header">
                    <img src="{{ public_path('img/poltek.png') }}" alt="Poltekbang Image">
                    <h1>Politeknik Penerbangan Surabaya</h1>
                    <span>Jalan Jemur Andayani No 73 Surabaya 60236</span><br>
                    <span>Tel/Fax. 62 31 8410871/62 31 8490005 | Email. mail@poltekbangsby.ac.id</span><br>
                    <span>Laman: https://shortcourses.poltekbangsby.ac.id</span>
                </div>
                <hr>
                
                <h1 style="text-align: center;">INVOICE PEMBAYARAN PENDAFTARAN</h1>
                <div class="content-invoice">
                    @if ($idPembayaranDaftar != null)
                        {{-- diambil dari tabel pembayaran --}}
                        {{-- ========================================================= --}}
                            
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
                        {{-- data pembayarannya --}}
                        <p>Pembayaran id : {{ $dataPendaftaran->order_id }}</p>
                        <p>Metode pembayaran : {{ $dataPendaftaran->metode_pembayaran }}</p>
                        <p>Waktu pembayaran  : {{ \Carbon\Carbon::parse($dataPendaftaran->updated_at)->format('H:i:s | d-m-Y') }}</p>
                        {{-- ========================================================= --}}
                    @else
                    {{-- diambil dari tabel pendaftaran --}}
                        <div class="info-row">
                            <strong>Waktu daftar</strong><span>: {{ \Carbon\Carbon::parse($dataPendaftaran->created_at)->format('H:i:s | d-m-Y') }}</span><br>
                        </div>
                        <div class="info-row">
                            <strong>Nama Lengkap</strong><span>: {{ $dataPendaftaran->user->name }}</span><br>
                        </div>
                        <div class="info-row">
                            @if ($dataPendaftaran->user->jenis_kelamin =="l")
                                <strong>Jenis kelamin</strong><span>: Laki laki</span><br>
                                @else
                                <strong>Jenis kelamin</strong><span>: Perempuan</span><br>
                            @endif
                        </div>
                        <div class="info-row">
                            <strong>Jenis berkas</strong><span>: {{ $dataPendaftaran->user->jenis_berkas }}</span><br>
                        </div>
                        {{-- pembeda berkas --}}
                        @if ($dataPendaftaran->user->jenis_berkas == "paspor")
                            <div class="info-row">
                                <strong>Nomor paspor</strong><span>: {{ $dataPendaftaran->user->no_paspor }}</span><br>
                            </div>
                            <div class="info-row">
                                <strong>Nationality</strong><span>: {{ $dataPendaftaran->user->Nationality->name }}</span><br>
                            </div>
                            <div class="info-row">
                                <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($dataPendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</span>
                            </div>
                        @else
                            <div class="info-row">
                                <strong>NIK</strong><span>: {{ $dataPendaftaran->user->nik }}</span><br>
                            </div>
                            <div class="info-row">
                                <strong>Tempat lahir</strong><span>: {{ $dataPendaftaran->user->tempat_lahir }}</span><br>
                            </div>
                            <div class="info-row">
                                <strong>Alamat</strong><span>: {{ $dataPendaftaran->user->kelurahan->name }} | {{ $dataPendaftaran->user->kecamatan->name }} | {{ $dataPendaftaran->user->kabupaten->name }} | {{ $dataPendaftaran->user->provinsi->name }}.</span><br>
                            </div>
                            <div class="info-row">
                                <strong>Tanggal Lahir</strong><span>: {{ \Carbon\Carbon::parse($dataPendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</span>
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
                                            <td>{{ $dataPendaftaran->diklat->nama_diklat }}</td>
                                            <td>Pendaftaran</td>
                                            <td>Rp 150.000</td>
                                            <td>{{ $dataPendaftaran->status_pembayaran_daftar }}</td>
                                            {{-- <td>{{ $dataPendaftaran->pendaftaran->diklat->nama_diklat }}</td>
                                            <td>Pendaftaran</td>
                                            <td>Rp 150.000</td>
                                            <td>{{ $dataPendaftaran->pendaftaran->status_pembayaran_daftar }}</td> --}}
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <p>Pembayaran id: Belum tersedia.</p>
                        <p>Metode pembayaran : Belum tersedia.</p>
                        <p>Waktu pembayaran  : Belum tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>