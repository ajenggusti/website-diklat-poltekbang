@extends('layout.mainAdmin')
@section('container')
{{-- Font Poppins --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

</style>
    <h4>Jumlah pendafatar yang membayar biaya diklat</h4>
    {{ $getBayarDiklat }} orang
    <br><br>
    <h4>jumlah pendafatar yang membayar pendaftaran</h4>
    {{ $getBayarPendaftaran }} orang

    <hr>
    <h1>bagian diklat</h1>
    <h4>pembayaran diklat yang belum terkonfirmasi(yang perlu dicek)</h4>
     {{ $hitungPembayaranDiklatDicek }} orang
    <h4>pembayaran diklat yang sudah terkonfirmasi</h4>
     {{ $hitungPembayaranDiklatLunas }} orang

     <hr>
     <h1>bagian pendaftaran</h1>
     <h4>pembayaran pendaftaran yang belum terkonfirmasi</h4>
      {{ $hitungPembayaranPendaftaranDicek }} orang
    <h4>pembayaran pendaftaran yang sudah terkonfirmasi</h4>
      {{ $hitungPembayaranPendaftaranLunas }} orang
@endsection
