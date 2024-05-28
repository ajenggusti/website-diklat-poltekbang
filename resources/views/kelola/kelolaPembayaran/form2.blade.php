@extends('layout.mainUser')
@section('container')
        <link href="/css/actor.css" rel="stylesheet">

        {{-- <div class="content"> --}}
            <div class="bg-nota">
                <div class="content-nota">
                    
                        @csrf
                        <div class="edit-user">
                            <h4>Pembayaran Pendaftaran</h4>
                            <hr>
                            <small>Nama Diklat : {{ $pembayaran->pendaftaran->diklat->nama_diklat }}</small>
                            <br>
                            <small>Jenis Pembayaran : {{ $pembayaran->jenis_pembayaran }}</small>
                            <br>
                            <small>Total biaya : {{ 'Rp ' . number_format($pembayaran->total_harga, 0, ',', '.') }}</small>
                            <br>

                            <div class="submit-button">
                                <button type="submit" id="pay-button" class="btn btn-primary">Bayar</button>
                            </div>
                        </div>
                </div>
            </div>
        {{-- </div> --}}
          
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include jQuery -->
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
    
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    
    <script type="text/javascript">
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
          window.snap.pay('{{ $snapToken }}', {
              onSuccess: function(result){
                  // Redirect ke halaman setelah pembayaran berhasil
                  window.location.href = "{{ route('riwayat.detail', ['detail' => $pembayaran->id_pendaftaran]) }}";
              },
              // Handle callback ketika pengguna menutup pembayaran pop-up
              onClose: function(){
                  // Tambahkan logika yang sesuai jika diperlukan
                  console.log('Pembayaran pop-up ditutup.');
              }
          });
      });
    </script>
@endsection








