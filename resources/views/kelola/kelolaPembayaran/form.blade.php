@extends('layout.mainUser')
@section('container')
    <h1>Form Pembayaran</h1>
    <form action="/kelPembayaran" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <input type="hidden" name="id" value="{{ 'ORD_' . rand(100000, 999999) }}"> --}}

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
        <br>    
        <div class="mb-3">
            <label for="harga" class="form-label is">Harga Pendaftaran</label>
            <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="Rp 150.000">
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@endsection








