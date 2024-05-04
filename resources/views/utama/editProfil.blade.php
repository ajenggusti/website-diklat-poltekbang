@extends('layout.mainUser')
@section('container')

hai {{ $user->name }}, Lengkapi datamu!
<br>
<h1>Kelengkapan Profil</h1>
    <form action="{{ route('updateProfil.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data" id="formPendaftaran">
        @method('put')
        @csrf

        
        <div class="mb-3">
            <label for="name" class="form-label is">Nama Lengkap</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name= "name" value="{{ old('name') ?: $user->name}}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label is">Email</label>
            <input type="text" class="form-control  @error('email') is-invalid @enderror" id="email" name= "email" value="{{ old('email') ?: $user->email}}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nik" class="form-label is">NIK</label>
            <input type="text" class="form-control  @error('nik') is-invalid @enderror" id="nik" name= "nik" value="{{ old('nik') ?: $user->nik}}">
            @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div class="mb-3">
            <label for="nik" class="form-label is">NIK</label>
            <input type="text" class="form-control  @error('nik') is-invalid @enderror" id="nik" name= "nik" value="{{ old('nik') ?: $user->nik}}">
            @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <select name="jenis_diklat" class="form-select" aria-label="Default select example">
            <option selected disabled>Pilih Jenis berkas</option>
            <option value="ktp" {{ old('jenis_diklat', $user->jenis_diklat) == 'ktp' ? 'selected' : '' }}>KTP</option>
            <option value="paspor" {{ old('jenis_diklat', $user->jenis_diklat) == 'paspor' || is_null($user->jenis_diklat) ? 'selected' : '' }}>Paspor</option>
        </select>
        <small class="text-muted">Jika kamu mengubah jenis berkas dari data yang kamu gunakan sebelumnya, data yang tersimpan akan terhapus. Dan admin akan memverifikasi ulang.</small>
        @error('jenis_diklat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <br><br>
        
        {{-- <select name="id_kelurahan" class="form-select" aria-label="Default select example">
            <option selected disabled>Kelurahan</option>
            @foreach ($kelurahans as $kelurahan)
                <option value="{{ $user->id_kelurahan }}" {{ old('id_kelurahan',$kelurahan->id) == $kelurahan->id ? 'selected' : '' }}>
                    {{ $kelurahan->name }}
                </option>
            @endforeach
        </select> --}}

        <button type="submit" class="btn btn-primary">Kirim</button>
        
    </form>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Include jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@endsection