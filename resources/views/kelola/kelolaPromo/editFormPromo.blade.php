@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Edit Promo</title>
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
    <div class="content-form2Column">    
        <form method="POST" action="/kelPromo/{{  $kelPromo->id }}" enctype="multipart/form-data" class="edit-2column">
            @method('put')
            @csrf
            <h2>Form Edit Promo</h2>
            <hr>
            <div class="form-column-left">
                <div class="mb-3">
                    <label for="img" class="form-label">Gambar sebelumnya</label><br>
                    <img src="{{ asset('storage/' . $kelPromo->gambar) }}" class="img-preview img-fluid" style="width: 550px">
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">Masukkan gambar baru</label>
                    <img class="img-preview img-fluid" style="width: 550px">
                    <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
                    @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="diklat" class="form-label">Promo untuk diklat</label>
                    <select name="diklat" class="form-select @error('diklat') is-invalid @enderror" aria-label="Default select example">
                        <option value="" selected disabled>Promo ini untuk diklat yang mana?</option>
                        <option value="null" style="color:red;" {{ (old('diklat', $kelPromo->id_diklat) === null || old('diklat', $kelPromo->id_diklat) == 'null') ? 'selected' : '' }}>Untuk semua diklat</option>
                        @foreach ($datas as $data)
                            <option value="{{ $data->id }}" {{ (old('diklat', $kelPromo->id_diklat) !== null && old('diklat', $kelPromo->id_diklat) == $data->id) ? 'selected' : '' }}>
                                {{ $data->nama_diklat }}
                            </option>
                        @endforeach
                    </select>
                    @error('diklat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="potongan" class="form-label">Potongan</label>
                    <input type="text" class="form-control @error('potongan') is-invalid @enderror" id="potongan" name="potongan" value="{{ old('potongan') ?? $kelPromo->potongan }}">
                    @error('potongan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-column-right">
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span style="font-size: 10px; color:red;">*contoh: Promo Hari Kartini*</span></label>
                    <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') ?? $kelPromo->deskripsi }}">
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode Promo</label>
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode') ?? $kelPromo->kode }}">
                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="control-label" for="tgl_awal">Tanggal Promo Berawal</label>
                    <input class="form-control datepicker @error('tgl_awal') is-invalid @enderror" value="{{ old('tgl_awal') ?? ($kelPromo->tgl_awal ? \Carbon\Carbon::parse($kelPromo->tgl_awal)->format('d-m-Y') : '') }}" id="tgl_awal" name="tgl_awal" placeholder="dd-mm-yyyy" type="text"/>
                    @error('tgl_awal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="control-label" for="tgl_akhir">Tanggal Promo Berakhir</label>
                    <input class="form-control datepicker @error('tgl_akhir') is-invalid @enderror" value="{{ old('tgl_akhir') ?? ($kelPromo->tgl_akhir ? \Carbon\Carbon::parse($kelPromo->tgl_akhir)->format('d-m-Y') : '') }}" id="tgl_akhir" name="tgl_akhir" placeholder="dd-mm-yyyy" type="text"/>
                    @error('tgl_akhir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Apakah ingin menggunakan kuota??</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kuota" id="kuota_yes" value="iya" {{ (old('kuota', $kelPromo->pakai_kuota == 'iya') == "iya") ? 'checked' : '' }}>
                        <label class="form-check-label" for="kuota_yes">Iya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kuota" id="kuota_no" value="tidak" {{ (old('kuota', $kelPromo->pakai_kuota == 'tidak') == "tidak") ? 'checked' : '' }}>
                        <label class="form-check-label" for="kuota_no">Tidak</label>
                    </div>
                    @error('kuota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                        
                <div class="mb-3">
                    <label for="kuota_angka" class="form-label">Kuota_angka</label>
                    <input type="text" class="form-control @error('kuota_angka') is-invalid @enderror" id="kuota_angka" name="kuota_angka" value="{{ old('kuota_angka') ?? $kelPromo->kuota }}">
                    @error('kuota_angka')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tampil" class="form-label is">Apakah Promo ini akan ditampilkan? </label>
                    <select class="form-select" id="tampil" name="tampil">
                        <option value="ya" {{ old('tampil', $kelPromo->tampil) == 'ya' ? 'selected' : '' }}>Ya</option>
                        <option value="tidak" {{ old('tampil', $kelPromo->tampil) == 'tidak'  ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>
                <div class="submit-button">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </form>  
    </div>

    <!-- Include jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</body>
</html>
@endsection
