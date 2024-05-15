
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
            background-color: #fff;
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


        @media print {
            body * {
                visibility: hidden;
            }
            .invoice-content {
                margin-left: 10%;
                margin-right: 10%;
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
            }
            .invoice-details, .invoice-details * {
                visibility: visible;
            }
            .invoice-details {
                position: absolute;
                left: 50%;
                top: 30%;
                transform: translate(-50%, -50%);
                width: 800px; /* Ensure the printed card matches the screen size */
                box-shadow: none; /* Remove shadow for print */
                border: none; /* Remove border for print */
                background-color: rgb(255, 255, 255);
                margin: 0 auto;
                /* max-width: 600px; */
                line-height: 1.8;
                padding: 15px 35px 15px 35px;
                border: 1px solid #FF6900;
                border-radius: 10px;
            }
            .btn {
                display: none;
            }
        }
    </style>
    
</head>
<body>
    <div class="container">
        <div class="invoice-content">
            <div class="invoice-details">
                <div class="card-header">
                    <img src="/public/img/poltek.png" alt="Politeknik Penerbangan Surabaya Logo">
                    <h1 style="text-align: center;">Politeknik Penerbangan Surabaya</h1>
                </div>
                <hr>
                <p>Waktu Pendaftaran:   {{ \Carbon\Carbon::parse($data->waktu_pendaftaran)->format('H:i:s | d-m-Y') }}</p>
                <h1 style="text-align: center;">INVOICE</h1>
                
                <div class="info-row">
                    <strong>Nama Lengkap</strong><span>: {{ $data->nama_lengkap }}</span>
                </div>
                <div class="info-row">
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
                            <td>Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Diskon</th>
                            <td>
                                @if($data->promo)
                                    <p>Rp. {{ number_format($data->promo->potongan, 0, ',', '.') }}</p>
                                @else
                                    <p>Rp. 0</p> 
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
                </table>
                
                {{-- <p><strong>Waktu Pendaftaran:</strong> {{ \Carbon\Carbon::parse($data->waktu_pendaftaran)->format('H:i:s | d-m-Y') }}</p> --}}
                {{-- <p><strong>Status Pembayaran Pendaftaran:</strong> {{ $data->status_pembayaran_daftar }}</p>
                <p><strong>Harga Diklat:</strong> Rp. {{ number_format($data->diklat->harga, 0, ',', '.') }}</p>
                @if($data->promo)
                    <p><strong>Diskon:</strong> - Rp. {{ number_format($data->promo->potongan, 0, ',', '.') }}</p>
                @else
                    <p><strong>Diskon:</strong> - Rp. 0</p> 
                @endif
                <p><strong>Total Biaya:</strong> Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</p>
                <p><strong>Status Pembayaran Biaya Diklat:</strong> {{ $data->status_pembayaran_diklat }}</p> --}}
                
            </div>
        </div>
    </div>
</body>
<script>
    function printPage() {
        window.print();
    }
</script>
</html>