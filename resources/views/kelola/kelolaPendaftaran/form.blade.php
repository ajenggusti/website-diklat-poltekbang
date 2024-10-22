@extends('layout.mainUser')
@section('title', 'Form Pendaftaran Diklat')
@section('container')
            <link href="/css/form.css" rel="stylesheet">
            <link href="/css/actor.css" rel="stylesheet">

            <div class="content-bodyForm">
                <div class="content-form2Column">
                    
                    <form action="/kelPendaftaran" method="post" enctype="multipart/form-data" id="formPendaftaran" class="edit-2column">
                        @csrf
                        <h2>Form Pendaftaran Diklat</h2>
                        <hr>
                        <div class="form-column-left">
                            <div class="mb-3">
                                <label for="diklat" class="form-label is">Diklat Yang Dipilih</label>
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
                                <small class="text-muted">Jika tidak ada pesan error pada kode promo, berarti promo yang dimasukkan valid.</small>
                            </div>
                            <br>
                        </div>


                        <div class="form-column-right">
                        
                            
                            <div class="mb-3">
                                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                                <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-select @error('pendidikan_terakhir') is-invalid @enderror">
                                    <option value="" disabled {{ old('pendidikan_terakhir') == '' ? 'selected' : '' }}>Pilih Pendidikan Terakhir</option>
                                    <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA/SMK" {{ old('pendidikan_terakhir') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                    <option value="Diploma" {{ old('pendidikan_terakhir') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                    <option value="Sarjana" {{ old('pendidikan_terakhir') == 'Sarjana' ? 'selected' : '' }}>Sarjana</option>
                                    <option value="Magister" {{ old('pendidikan_terakhir') == 'Magister' ? 'selected' : '' }}>Magister</option>
                                    <option value="Doktor" {{ old('pendidikan_terakhir') == 'Doktor' ? 'selected' : '' }}>Doktor</option>
                                </select>
                                @error('pendidikan_terakhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    
                    
                    </form>  
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                
                <!-- Include jQuery -->
                <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
                <!-- Include Date Range Picker -->
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
            </div>
@endsection
