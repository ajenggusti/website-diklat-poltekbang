@extends('layout.mainUser')
@section('container')
    <h2>Form Testimoni</h2>
    
    <form method="POST" action="/kelTestimoni" >
        @csrf
        <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id }}">
        <div class="mb-3">
            <label for="profesi" class="form-label is">Profesi</label>
            <input type="text" class="form-control  @error('profesi') is-invalid @enderror" id="profesi" name= "profesi" value="{{ old('profesi') }}">
            @error('profesi')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="testimoni" class="form-label is">testimoni</label>
            <textarea class="form-control  @error('testimoni') is-invalid @enderror" id="testimoni" name= "testimoni">{{ old('testimoni') }}</textarea>
            @error('testimoni')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>  
@endsection

