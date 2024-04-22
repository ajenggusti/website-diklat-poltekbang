@extends('layout.mainUser')
@section('container')
    <h1>Form Pembayaran</h1>
    <form action="/kelPembayaran" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id }}">
            
        </div>
        <div class="mb-9 row">
            <label for="harga" class="form-label col-auto">Nama Diklat</label>
            <div class="col">
                <input disabled type="text" class="form-control custom-input @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ $pendaftaran->diklat->nama_diklat }}">
            </div>
        </div>
        <hr> 
        <div class="mb-3">
            <label for="harga" class="form-label is">Harga Diklat</label>
            <input disabled type="text" class="form-control custom-input @error('harga') is-invalid @enderror" id="harga" name="harga" value="Rp {{ number_format($pendaftaran->harga_diklat, 0, ',', '.') }}">
        </div>               
        <div class="mb-3">
            <label for="harga" class="form-label is">Status Pembayaran Diklat</label>
            <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ $pendaftaran->status_pembayaran_diklat }}">
        </div>    
        <br>    
        <div class="mb-3">
            <label for="harga" class="form-label is">Harga Pendaftaran</label>
            <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="Rp 150.000">
        </div>        
        <div class="mb-3">
            <label for="harga" class="form-label is">Status Pembayaran Pendaftaran</label>
            <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ $pendaftaran->status_pembayaran_daftar }}">
        </div>  
        <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-select @error('jenis_pembayaran') is-invalid @enderror" onchange="updateTotalHarga()">
            <option value="" disabled {{ old('jenis_pembayaran') ? '' : 'selected' }}>Pilih Jenis Pembayaran</option>
            <option value="diklat" {{ old('jenis_pembayaran') == 'diklat' ? 'selected' : '' }}>Diklat</option>
            <option value="pendaftaran" {{ old('jenis_pembayaran') == 'pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
        </select>
        <input type="hidden" name="total_harga" id="total_harga" value="{{ old('jenis_pembayaran') == 'diklat' ? $pendaftaran->harga_diklat 
        : '150000' }}">
        {{-- <input type="hidden" name="snapToken" value="{{ session('snapToken') }}"> --}}

        @if ($errors->has('jenis_pembayaran'))
            <div class="invalid-feedback" style="display: block;">{{ $errors->first('jenis_pembayaran') }}</div>
        @endif
        <button type="submit"  class="btn btn-primary">Kirim</button>
        {{ session('snapToken') }}
    </form> 
    

  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function updateTotalHarga() {
            var jenis_pembayaran = document.getElementById('jenis_pembayaran').value;
            var total_harga_input = document.getElementById('total_harga');
    
            if (jenis_pembayaran === 'diklat') {
                total_harga_input.value = "{{ $pendaftaran->harga_diklat }}";
            } else if (jenis_pembayaran === 'pendaftaran') {
                total_harga_input.value = "150000";
            }
        }
    </script>
<!-- Include jQuery -->
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> --}}

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
{{-- <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      // Also, use the embedId that you defined in the div above, here.
      window.snap.embed('{{ session('snapToken') }}', {
        embedId: 'snap-container',
        onSuccess: function (result) {
          /* You may add your own implementation here */
          alert("payment success!"); console.log(result);
        },
        onPending: function (result) {
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function (result) {
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function () {
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      });
    });
  </script>  --}}

  {{-- <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{ session('snapToken') }}');
      // customer will be redirected after completing payment pop-up
    });
  </script> --}}


@endsection








