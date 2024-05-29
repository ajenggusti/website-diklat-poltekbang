@extends('layout.mainUser')
@section('container')
        <link href="/css/editForUser.css" rel="stylesheet">

        {{-- <div class="content"> --}}
            <div class="bg-edit">
                <div class="content-editProfil">
                    {{-- <div class="content-form2Column"> --}}
                        <form action="/kelPendaftaran/{{ $kelPendaftaran->id }}" method="post" enctype="multipart/form-data" id="formPendaftaran" class="edit-profil">
                            @method('put')
                            @csrf
                            <h2>Form Edit Pendaftaran </h2>
                            <h5 style="text-align: center;">{{ $kelPendaftaran->diklat->nama_diklat }}</h5>
                            
                            <hr>
                            <div class="left-profil">
                                <div class="mb-3">
                                    <label for="harga" class="form-label is">Harga Diklat</label>
                                    <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="Rp {{ number_format($kelPendaftaran->diklat->harga , 0,',', '.') }}">
                                    <input type="hidden" name="harga" value="{{ isset($harga) ? $harga : $kelPendaftaran->diklat->harga }}">
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>    

                                <div class="mb-3">
                                    <label for="harga" class="form-label is">Diskon promo : </label>
                                    @if($kelPendaftaran->id_promo && $kelPendaftaran->promo)
                                        <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="Potongan" value="-Rp {{ number_format($kelPendaftaran->promo->potongan, 0, ',', '.') }}">
                                    @else
                                        <input disabled type="text" class="form-control" id="harga" name="Potongan" value="-Rp {{ number_format($kelPendaftaran->potongan , 0, ',', '.') }}">
                                    @endif
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label is">Diskon admin : </label>
                                        <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="Potongan" value="-Rp {{ number_format($kelPendaftaran->potongan_admin, 0, ',', '.') }}">
                                </div>
                                

                                <div class="mb-3">
                                    <label for="harga" class="form-label is">Total Biaya</label>
                                    <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="Rp {{ number_format($kelPendaftaran->harga_diklat, 0, ',', '.' ) }}">
                                </div>   
                                {{-- {{ $kelPendaftaran->email }} --}}
                                {{-- <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input disabled type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') ?: $kelPendaftaran->email }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="email" value="{{ $kelPendaftaran->email }}"> --}}
                                
                                
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode Promo (Opsional)</label>
                                    <input type="hidden" name="kode" value="{{$kelPendaftaran->promo ?$kelPendaftaran->promo->kode : 'Tidak ada promo yang diambil' }}">
                                    <input type="text" class="form-control" value="{{$kelPendaftaran->promo ?$kelPendaftaran->promo->kode : 'Tidak ada promo yang diambil' }}" disabled>
                                    <small class="text-muted">Kode promo yang sudah dimasukkan tidak dapat diubah.</small>
                                </div>
                                
                            </div>
                            
                            <div class="right-profil">
                                {{-- <div class="mb-3">
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
                                 --}}
                                
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
        {{-- </div> --}}
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            
            <!-- Include jQuery -->
            <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
@endsection
