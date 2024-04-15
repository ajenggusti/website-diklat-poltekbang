@extends('layout.mainUser')
@section('container')
    <h1>Form Pendaftaran</h1>
    <form action="/kelPendaftaran" method="post" enctype="multipart/form-data" id="formPendaftaran">
        @csrf
        <div class="mb-3">
            <p>Diklat yang dipilih</p>
            <select name="diklat" class="form-select" aria-label="Default select example" disabled>
                <option selected disabled>Pilih Diklat</option>
                @foreach ($dtDiklats as $diklats)
                    <option value="{{ $diklats->id }}" {{ old('diklat', $kelPendaftaran->diklat->id) == $diklats->id ? 'selected' : '' }}>
                        {{ $diklats->nama_diklat }}
                    </option>
                @endforeach
            </select>
            <input type="hidden" name="diklat" value="{{ old('diklat', $kelPendaftaran->diklat->id) }}">
        </div>
        <br>
        <div class="mb-3">
            <label for="harga" class="form-label is">Harga</label>
            <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="Rp {{ isset($harga) ? number_format($harga) : number_format($kelPendaftaran->diklat->harga) }}">
            <input type="hidden" name="harga" value="{{ isset($harga) ? $harga : $kelPendaftaran->diklat->harga }}">
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>      

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') ?: $kelPendaftaran->email }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <br>
        <div class="mb-3">
            <label for="kode" class="form-label">Kode Promo (Opsional)</label>
            <input type="hidden" name="kode" value="{{$kelPendaftaran->promo ?$kelPendaftaran->promo->kode : 'Tidak ada promo yang diambil' }}">
            <input type="text" class="form-control" value="{{$kelPendaftaran->promo ?$kelPendaftaran->promo->kode : 'Tidak ada promo yang diambil' }}" disabled>
            <small class="text-muted">Kode promo yang sudah dimasukkan tidak dapat diubah.</small>
        </div>
        <br>
        
        <div class="mb-3">
            <label for="nama_depan" class="form-label is">Nama Depan</label>
            <input type="text" class="form-control  @error('nama_depan') is-invalid @enderror" id="nama_depan" name= "nama_depan" value="{{ old('nama_depan') ?: $kelPendaftaran->nama_depan}}">
            @error('nama_depan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nama_belakang" class="form-label is">Nama belakang</label>
            <input type="text" class="form-control  @error('nama_belakang') is-invalid @enderror" id="nama_belakang" name= "nama_belakang" value="{{ old('nama_belakang')?: $kelPendaftaran->nama_belakang }}">
            @error('nama_belakang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <br>
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat lahir</label>
            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') ?: $kelPendaftaran->tempat_lahir}}">
            @error('tempat_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3"> <!-- Date input -->
            <label class="control-label" for="tgl_awal">Tanggal Lahir </label>
            <input class="form-control  @error('tgl_awal') is-invalid @enderror"  value="{{ old('tgl_awal') ?: $kelPendaftaran->tanggal_lahir}}" id="tgl_awal" name="tgl_awal" placeholder="dd-mm-yyyy" type="text"/>
            @error('tgl_awal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="4">{{ old('alamat')?: $kelPendaftaran->alamat }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        
        <div class="mb-3">
            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
            <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-select @error('pendidikan_terakhir') is-invalid @enderror">
                <option value="" disabled {{ old('pendidikan_terakhir') == '' ? 'selected' : '' }}>Pilih Pendidikan Terakhir</option>
                <option value="SD" {{ old('pendidikan_terakhir', $kelPendaftaran->pendidikan_terakhir) == 'SD' ? 'selected' : '' }}>SD</option>
                <option value="SMP" {{ old('pendidikan_terakhir', $kelPendaftaran->pendidikan_terakhir) == 'SMP' ? 'selected' : '' }}>SMP</option>
                <option value="SMA/SMK" {{ old('pendidikan_terakhir', $kelPendaftaran->pendidikan_terakhir) == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                <option value="Diploma" {{ old('pendidikan_terakhir', $kelPendaftaran->pendidikan_terakhir) == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                <option value="Sarjana" {{ old('pendidikan_terakhir', $kelPendaftaran->pendidikan_terakhir) == 'Sarjana' ? 'selected' : '' }}>Sarjana</option>
                <option value="Magister" {{ old('pendidikan_terakhir', $kelPendaftaran->pendidikan_terakhir) == 'Magister' ? 'selected' : '' }}>Magister</option>
                <option value="Doktor" {{ old('pendidikan_terakhir', $kelPendaftaran->pendidikan_terakhir) == 'Doktor' ? 'selected' : '' }}>Doktor</option>
            </select>
            @error('pendidikan_terakhir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <br>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') ?: $kelPendaftaran->no_hp}}">
            @error('no_hp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
        
    </form>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Include jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

@endsection
