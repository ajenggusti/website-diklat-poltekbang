@extends('layout.mainUser')
@section('container')
    <h1>Form Pendaftaran</h1>
    <form action="/kelPendaftaran" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <p>Diklat yang dipilih</p>
            <select name="diklat" class="form-select" aria-label="Default select example" disabled>
                <option selected disabled>Pilih Diklat</option>
                @foreach ($dtDiklats as $diklats)
                    <option value="{{ $diklats->id }}" {{ old('diklat', $diklat->id) == $diklats->id ? 'selected' : '' }}>
                        {{ $diklats->nama_diklat }}
                    </option>
                @endforeach
            </select>
            <input type="hidden" name="diklat" value="{{ old('diklat', $diklat->id) }}">
        </div>
        <br>
        <div class="mb-3">
            <label for="harga" class="form-label is">Harga</label>
            <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="Rp {{ isset($harga) ? number_format($harga) : number_format($diklat->harga) }}">
            <input type="hidden" name="harga" value="{{ isset($harga) ? $harga : $diklat->harga }}">
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>        
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') ?: Auth::user()->email }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <br>
        <div class="mb-3">
            <label for="kode" class="form-label is">Kode Promo (Opsional)</label>
            <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode') }}">
            @error('kode')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if(session('error'))
                <div class="invalid-feedback" style="display: block;">{{ session('error') }}</div>
            @endif
        </div>
        
            
            
            
            
            <br>
            
            <div class="mb-3">
                <label for="nama_depan" class="form-label is">Nama Depan</label>
                <input type="text" class="form-control  @error('nama_depan') is-invalid @enderror" id="nama_depan" name= "nama_depan" value="{{ old('nama_depan') }}">
                @error('nama_depan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama_belakang" class="form-label is">Nama belakang</label>
                <input type="text" class="form-control  @error('nama_belakang') is-invalid @enderror" id="nama_belakang" name= "nama_belakang" value="{{ old('nama_belakang') }}">
                @error('nama_belakang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <br>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat lahir</label>
                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                @error('tempat_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3"> <!-- Date input -->
                <label class="control-label" for="tgl_awal">Tanggal Lahir </label>
                <input class="form-control  @error('tgl_awal') is-invalid @enderror"  value="{{ old('tgl_awal') }}" id="tgl_awal" name="tgl_awal" placeholder="dd-mm-yyyy" type="text"/>
                @error('tgl_awal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <div class="mb-3">
                <label for="alamat" class="form-label">alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}">
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-select">
                    <option value="" disabled selected>Pilih Pendidikan Terakhir</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA/SMK">SMA/SMK</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Sarjana">Sarjana</option>
                    <option value="Magister">Magister</option>
                    <option value="Doktor">Doktor</option>
                </select>
            </div>
            <br>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                @error('no_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
                
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

{{-- <select name="id_level" class="form-select" aria-label="Default select example">
    <option selected disabled>Pilih level untuk user</option>
    @foreach ($getLevel as $level)
        <option value="{{ $level->id }}" {{ old('id_level', $data->id_level) == $level->id ? 'selected' : '' }}>
            {{ $level->level }}
        </option>
    @endforeach
</select>        --}}