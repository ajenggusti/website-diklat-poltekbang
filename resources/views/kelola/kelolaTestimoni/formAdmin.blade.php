@extends('layout.mainAdmin')
@section('container')
        <link href="/css/actor.css" rel="stylesheet">

        <div class="content-form">
            <form method="POST" action="{{ route('testimoniAdmin-store.store') }}" class="edit-staff">
                @csrf
                <h2>Form Dummy Testimoni</h2>
                <hr>
                <div class="mb-3">
                    <label for="nama_dummy" class="form-label is">Nama Lengkap (dummy)</label>
                    <input type="text" class="form-control  @error('nama_dummy') is-invalid @enderror" id="nama_dummy" name= "nama_dummy" value="{{ old('nama_dummy') }}">
                    @error('nama_dummy')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="profesi" class="form-label is">Profesi</label>
                    <input type="text" class="form-control  @error('profesi') is-invalid @enderror" id="profesi" name= "profesi" value="{{ old('profesi') }}">
                    @error('profesi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="testimoni" class="form-label is">Testimoni</label>
                    <textarea class="form-control  @error('testimoni') is-invalid @enderror" id="testimoni" name= "testimoni">{{ old('testimoni') }}</textarea>
                    @error('testimoni')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="diklat" class="form-label is">Testimoni untuk diklat</label>
                    <select name="diklat" class="form-select @error('diklat') is-invalid @enderror" aria-label="Default select example">
                        <option value="" selected disabled>Testimoni untuk diklat?</option>
                        @foreach ($diklats as $data)
                            <option value="{{ $data->id }}" {{ old('diklat') == $data->id ? 'selected' : '' }}>
                                {{ $data->nama_diklat }}
                            </option>
                        @endforeach
                    </select>
                    @error('diklat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="submit-button">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>  
        </div>
@endsection

