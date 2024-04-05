@extends('layout.mainAdmin')
@section('container')
    <h2>Form Tambah Promo</h2>
        
    <form method="POST" action="/kelPromo" enctype="multipart/form-data">
        @csrf
        
        <hr>
        <div class="mb-3">
            <label for="img" class="form-label">Masukkan gambar untuk ditampilkan di Banner Promo</label>
            <img class="img-preview img-fluid" style="width: 20%;">
            <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
            @error('img')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <select name="diklat" class="form-select @error('diklat') is-invalid @enderror" aria-label="Default select example">
            <option value="" selected disabled>Promo ini untuk diklat yang mana?</option>
            <option value="null" style="color:red;" {{ old('diklat') == 'null' ? 'selected' : '' }}>Untuk semua diklat</option>
            @foreach ($datas as $data)
                <option value="{{ $data->id }}" {{ old('diklat') == $data->id ? 'selected' : '' }}>
                    {{ $data->nama_diklat }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('diklat'))
            <div class="invalid-feedback">
                {{ $errors->first('diklat') }}
            </div>
        @endif
        <div class="mb-3">
            <label for="potongan" class="form-label is">Potongan</label>
            <input type="text" class="form-control  @error('potongan') is-invalid @enderror" id="potongan" name= "potongan" value="{{ old('potongan') }}">
            @error('potongan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="kode" class="form-label is">Kode Promo</label>
            <input type="text" class="form-control  @error('kode') is-invalid @enderror" id="kode" name= "kode" value="{{ old('kode') }}">
            @error('kode')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3"> <!-- Date input -->
            <label class="control-label" for="tgl_awal">Tanggal Mulai Promo </label>
            <input class="form-control  @error('tgl_awal') is-invalid @enderror"  value="{{ old('tgl_awal') }}" id="tgl_awal" name="tgl_awal" placeholder="dd-mm-yyyy" type="text"/>
            @error('tgl_awal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3"> <!-- Date input -->
            <label class="control-label" for="tgl_akhir">Tanggal Promo Berakhir</label>
            <input class="form-control  @error('tgl_akhir') is-invalid @enderror" value="{{ old('tgl_akhir') }}" id="tgl_akhir" name="tgl_akhir" placeholder="dd-mm-yyyy" type="text"/>
            @error('tgl_akhir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>  
{{-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@endsection