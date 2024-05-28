@extends('layout.mainAdmin')
@section('container')
        <link href="/css/actor.css" rel="stylesheet">

        <div class="content-form">
            <form method="POST" action="/kelTestimoni/{{ $kelTestimoni->id }}" class="edit-staff">
                @method('put')
                @csrf
                <h2>Kelola Testimoni</h2>
                <hr>
                {{-- <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id }}"> --}}
                @if ($kelTestimoni->id_pendaftaran != null)
                    <div class="mb-3">
                        <label for="diklat" class="form-label is">Nama Diklat</label>
                        <input disabled type="text" class="form-control" id="diklat" value="{{ $kelTestimoni->pendaftaran->diklat->nama_diklat }}">
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label is">Nama Penulis</label>
                        <input disabled type="text" class="form-control" id="penulis" value="{{ $kelTestimoni->pendaftaran->nama_lengkap }}">                    </div>
                    <div class="mb-3">
                        <label for="profesi" class="form-label is">Profesi</label>
                        <input disabled type="text" class="form-control" id="profesi" name= "profesi" value="{{ $kelTestimoni->profesi }}">
                    </div>
                    <div class="mb-3 testiReal">
                        <label>Isi Testimoni</label>
                        <p>{{ $kelTestimoni->testimoni }}
                    </div>
                @else
                    <div class="mb-3">
                        <label for="nama_dummy" class="form-label is">Nama Lengkap (dummy)</label>
                        <input type="text" class="form-control  @error('nama_dummy') is-invalid @enderror" id="nama_dummy" name= "nama_dummy" value="{{ old('nama_dummy') ?: $kelTestimoni->nama_dummy}}">
                        @error('nama_dummy')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="profesi" class="form-label is">Profesi</label>
                        <input type="text" class="form-control  @error('profesi') is-invalid @enderror" id="profesi" name= "profesi" value="{{ old('profesi') ?: $kelTestimoni->profesi}}">
                        @error('profesi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="testimoni" class="form-label is">Testimoni</label>
                        <textarea class="form-control  @error('testimoni') is-invalid @enderror" id="testimoni" name= "testimoni">{{ old('testimoni') ?: $kelTestimoni->testimoni}}</textarea>
                        @error('testimoni')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="diklat" class="form-label is">Testimoni Diklat</label>
                        <select name="diklat" class="form-select @error('diklat') is-invalid @enderror" aria-label="Default select example">
                            <option value="" selected disabled>Testimoni untuk diklat?</option>
                            @foreach ($diklats as $data)
                                <option value="{{ $data->id }}" {{ old('diklat', $kelTestimoni->id_diklat) == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_diklat }}
                                </option>
                            @endforeach
                        </select>
                        @error('diklat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
            
                </p>
                <div class="mb-3">
                    <label for="pilihan" class="form-label is">Apakah Testimoni ini akan ditampilkan? </label>
                    <select class="form-select" id="pilihan" name="pilihan">
                        <option value="iya" {{ ($kelTestimoni->tampil === 'iya' || old('pilihan') === 'iya') ? 'selected' : '' }}>Iya</option>
                        <option value="tidak" {{ ($kelTestimoni->tampil === 'tidak' || old('pilihan') === 'tidak') ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>
                <div class="submit-button">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
@endsection

