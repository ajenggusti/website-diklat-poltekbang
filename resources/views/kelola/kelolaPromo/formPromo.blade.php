@extends('layout.mainAdmin')
@section('container')
<html>
    <head>
        <!-- Custom styles for this template -->
        <link href="/css/actor.css" rel="stylesheet">
        {{-- Boostrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        {{-- Font Poppins --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="content-form">
              
            <form method="POST" action="/kelPromo" enctype="multipart/form-data" class="edit-user">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2>Form Tambah Promo</h2>  
                <hr>
                <div class="mb-3">
                    <label for="img" class="form-label">Masukkan gambar untuk ditampilkan di Banner Promo</label>
                    <img class="img-preview img-fluid" style="width: 550px">
                    <br><br>
                    <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
                    @error('img')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="diklat">Promo untuk diklat</label>
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
                </div>
                <div class="mb-3">
                    <label for="potongan" class="form-label is">Potongan</label>
                    <input type="text" class="form-control  @error('potongan') is-invalid @enderror" id="potongan" name= "potongan" value="{{ old('potongan') }}">
                    @error('potongan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label is"> Deskripsi <span style="font-size: 10px; color:red;">*contoh: Promo Hari Kartini*</span></label>
                    <input type="text" class="form-control  @error('deskripsi') is-invalid @enderror" id="deskripsi" name= "deskripsi" value="{{ old('deskripsi') }}">
                    @error('deskripsi')
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
                <div class="mb-3">
                    <label class="form-label">Apakah ingin menggunakan kuota??</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kuota" id="kuota_yes" value="iya" {{ old('kuota') === 'iya' ? 'checked' : '' }}>
                        <label class="form-check-label" for="kuota_yes">Iya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kuota" id="kuota_no" value="tidak" {{ old('kuota') === 'tidak' || old('kuota') === null ? 'checked' : '' }}>
                        <label class="form-check-label" for="kuota_no">Tidak</label>
                    </div>
                    @error('kuota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                
                <div class="mb-3">
                    <label for="kuota_angka" class="form-label">Masukkan kuota Promo yang anda inginkan</label>
                    <input type="text" class="form-control @error('kuota_angka') is-invalid @enderror" id="kuota_angka" name="kuota_angka" value="{{ old('kuota_angka') }}">
                    @error('kuota_angka')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tampil" class="form-label is">Apakah Promo ini akan ditampilkan? </label>
                    <select class="form-select" id="tampil" name="tampil">
                        <option value="ya" {{ old('tampil') == 'ya' ? 'selected' : '' }}>Ya</option>
                        <option value="tidak" {{ old('tampil', 'tidak') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>
                <div class="submit-button">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
                </form>
        </div>      
{{-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
        <!-- Include jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    
    </body>
</html>
@endsection