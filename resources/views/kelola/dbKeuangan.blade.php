@extends('layout.mainAdmin')
@section('container')
<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="/css/dashboard.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
            /* .container-admin {
                display: flex;
            } */

        </style>
    </head>
    <body>
        <div class="container-admin">
            <div class="dashAdmin">
                <div class="dashItem" style="background-color: #BC4F00;">
                    <div class="dashItemContent">Jumlah pendaftar yang membayar biaya diklat </div>
                    <div class="dashItemNumber">{{ $getBayarDiklat }}</div>
                </div>

                <div class="dashItem" style="background-color: #B90000;">
                    <div class="dashItemContent">jumlah pendaftar yang membayar pendaftaran</div>
                    <div class="dashItemNumber">{{ $getBayarPendaftaran }}</div>
                </div>

                <div class="dashItem" style="background-color: #D6C211;">
                    <div class="dashItemContent">pembayaran diklat yang belum terkonfirmasi(yang perlu dicek)</div>
                    <div class="dashItemNumber">{{ $hitungPembayaranDiklatDicek }}</div>
                </div>

                <div class="dashItem" style="background-color: #307C1E;">
                    <div class="dashItemContent">pembayaran diklat yang sudah terkonfirmasi</div>
                    <div class="dashItemNumber"> {{ $hitungPembayaranDiklatLunas }}</div>
                </div>

                <div class="dashItem" style="background-color: #84A6FF;">
                    <div class="dashItemContent">pembayaran pendaftaran yang belum terkonfirmasi</div>
                    <div class="dashItemNumber">{{ $hitungPembayaranPendaftaranDicek }}</div>
                </div>

                <div class="dashItem" style="background-color: #bf68d5;">
                    <div class="dashItemContent">pembayaran pendaftaran yang sudah terkonfirmasi</div>
                    <div class="dashItemNumber"> {{ $hitungPembayaranPendaftaranLunas }}</div>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection