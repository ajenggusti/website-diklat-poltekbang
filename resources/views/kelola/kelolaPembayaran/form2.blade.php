@extends('layout.mainUser')
@section('container')
    <h1>Nota Pembayaran</h1>
        @csrf
        Nama Diklat : {{ $pembayaran->pendaftaran->diklat->nama_diklat }}
        <br>
        Jenis Pembayaran : {{ $pembayaran->jenis_pembayaran }}
        <br>
        Total biaya : {{ 'Rp ' . number_format($pembayaran->total_harga, 0, ',', '.') }}
        <br>

        <button type="submit" id="pay-button" class="btn btn-primary">Kirim</button>
        {{-- {{ $snapToken }} --}}
    

  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Include jQuery -->
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> --}}

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

  <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{ $snapToken }}');
      // customer will be redirected after completing payment pop-up
    });
  </script>


@endsection








