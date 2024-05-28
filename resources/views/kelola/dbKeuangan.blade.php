@extends('layout.mainAdmin')
@section('container')
        <link href="/css/dashboard.css" rel="stylesheet">

        <div class="container-admin">
            <div class="dashAdmin">
                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #BC4F00;">
                    <div class="dashItemContent">Total Pembayar Biaya Diklat </div>
                    <div class="dashItemNumber">{{ $getBayarDiklat }}</div>
                </div>

                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #B90000;">
                    <div class="dashItemContent">Total Pembayar Biaya Daftar</div>
                    <div class="dashItemNumber">{{ $getBayarPendaftaran }}</div>
                </div>

                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #D6C211;">
                    <div class="dashItemContent">Total Pembayaran Diklat Belum Terkonfirmasi</div>
                    <div class="dashItemNumber">{{ $hitungPembayaranDiklatDicek }}</div>
                </div>

                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #307C1E;">
                    <div class="dashItemContent">Total Pembayaran Diklat Sudah Terkonfirmasi</div>
                    <div class="dashItemNumber"> {{ $hitungPembayaranDiklatLunas }}</div>
                </div>

                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #84A6FF;">
                    <div class="dashItemContent">Total Pembayaran Pendaftaran Belum Terkonfirmasi</div>
                    <div class="dashItemNumber">{{ $hitungPembayaranPendaftaranDicek }}</div>
                </div>

                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #bf68d5;">
                    <div class="dashItemContent">Total Pembayaran Pendaftaran Sudah Terkonfirmasi</div>
                    <div class="dashItemNumber"> {{ $hitungPembayaranPendaftaranLunas }}</div>
                </div>
            </div>
        </div>
@endsection


