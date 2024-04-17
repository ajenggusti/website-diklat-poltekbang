@extends('layout.mainUser')
@section('container')
    <h2>Kelola Testimoni</h2>
    
    <form method="POST" action="/kelTestimoni/{{ $kelTestimoni->id }}" >
        @method('put')
        @csrf
        {{-- <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id }}"> --}}
        <div class="mb-3">
            <label for="diklat" class="form-label is">Nama Diklat</label>
            <input disabled type="text" class="form-control" id="diklat" value="{{ $kelTestimoni->pendaftaran->diklat->nama_diklat }}">
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label is">Nama penulis</label>
            <input disabled type="text" class="form-control" id="penulis" value="{{ $kelTestimoni->pendaftaran->nama_depan }}">
        </div>
        <div class="mb-3">
            <label for="profesi" class="form-label is">Profesi</label>
            <input disabled type="text" class="form-control" id="profesi" name= "profesi" value="{{ $kelTestimoni->profesi }}">
        </div>
        <h3>Isi testimoni</h3>
        <p>{{ $kelTestimoni->testimoni }}
        </p>
        <div class="mb-3">
            <label for="pilihan" class="form-label is">Apakah testimoni akan ditampilkan? :</label>
            <select class="form-select" id="pilihan" name="pilihan">
                <option value="iya" {{ ($kelTestimoni->tampil === 'iya' || old('pilihan') === 'iya') ? 'selected' : '' }}>Iya</option>
                <option value="tidak" {{ ($kelTestimoni->tampil === 'tidak' || old('pilihan') === 'tidak') ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
        
        
        
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>  
@endsection

