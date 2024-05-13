@extends('layout.mainUser')
@section('container')
<html>
    <head>
        <!-- Custom styles for this template -->
        {{-- <link href="/css/form.css" rel="stylesheet">
        <link href="/css/actor.css" rel="stylesheet"> --}}
        <link href="/css/editForUser.css" rel="stylesheet">
        {{-- Boostrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        {{-- Font Poppins --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

        </style>
    </head>
    <body>
        <div class="content">
            <div class="bg-edit">
                <div class="content-editProfil">
                    {{-- <div class="content-form2Column"> --}}
                        <form action="/kelPendaftaran/{{ $kelPendaftaran->id }}" method="post" enctype="multipart/form-data" id="formPendaftaran" class="edit-profil">
                            @method('put')
                            @csrf
                            <h2>Form Pendaftaran</h2>
                            <hr>
                            <div class="left-profil">
                                <div class="mb-3">
                                    <label for="diklat" class="form-label is">Diklat yang dipilih</label>
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
                                
                                <div class="mb-3">
                                    <label for="harga" class="form-label is">Harga</label>
                                    <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="Rp {{ isset($harga) ? number_format($harga) : number_format($kelPendaftaran->diklat->harga) }}">
                                    <input type="hidden" name="harga" value="{{ isset($harga) ? $harga : $kelPendaftaran->diklat->harga }}">
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>    

                                <div class="mb-3">
                                    <label for="harga" class="form-label is">Potongan harga</label>
                                    @if($kelPendaftaran->id_promo && $kelPendaftaran->promo)
                                        <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="Potongan" value="-Rp {{ $kelPendaftaran->promo->potongan }}">
                                    @else
                                        <input disabled type="text" class="form-control" id="harga" name="Potongan" value="Tidak ada potongan harga">
                                    @endif
                                </div>
                                

                                <div class="mb-3">
                                    <label for="harga" class="form-label is">Total Biaya</label>
                                    <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="Rp {{ isset($harga) ? number_format($harga) : number_format($kelPendaftaran->harga_diklat ) }}">
                                    <input type="hidden" name="harga" value="{{ isset($harga) ? $harga : $kelPendaftaran->harga_diklat  }}">
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>   
                                {{-- {{ $kelPendaftaran->email }} --}}
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input disabled type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') ?: $kelPendaftaran->email }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="email" value="{{ $kelPendaftaran->email }}">
                                
                                
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode Promo (Opsional)</label>
                                    <input type="hidden" name="kode" value="{{$kelPendaftaran->promo ?$kelPendaftaran->promo->kode : 'Tidak ada promo yang diambil' }}">
                                    <input type="text" class="form-control" value="{{$kelPendaftaran->promo ?$kelPendaftaran->promo->kode : 'Tidak ada promo yang diambil' }}" disabled>
                                    <small class="text-muted">Kode promo yang sudah dimasukkan tidak dapat diubah.</small>
                                </div>
                                
                            </div>
                            
                            <div class="right-profil">
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label is">Nama Lengkap</label>
                                    <input type="text" class="form-control  @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name= "nama_lengkap" value="{{ old('nama_lengkap') ?: $kelPendaftaran->nama_lengkap}}">
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat lahir</label>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') ?: $kelPendaftaran->tempat_lahir}}">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                        
                                <div class="form-group mb-3">
                                    <label class="control-label" for="tgl_awal">Tanggal Lahir</label>
                                    <input class="form-control datepicker @error('tgl_awal') is-invalid @enderror" value="{{ old('tgl_awal') ?? ($kelPendaftaran->tanggal_lahir ? \Carbon\Carbon::parse($kelPendaftaran->tanggal_lahir)->format('d-m-Y') : '') }}" id="tgl_awal" name="tgl_awal" placeholder="dd-mm-yyyy" type="text"/>
                                    @error('tgl_awal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
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
                                
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') ?: $kelPendaftaran->no_hp}}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <hr>
                            <div class="btn-editUser">
                                <button type="submit" class="btn btn-primary">Kirimkan Perubahan</button>
                            </div>
                        </form>  
                    {{-- </div> --}}
                </div>
            </div>
        </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            
            <!-- Include jQuery -->
            <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    </body>
</html>
@endsection
