@extends('layout.mainUser')
@section('container')
        <link href="/css/editForUser.css" rel="stylesheet">

        {{-- <div class="content"> --}}
            <div class="bg-edit">
                <div class="content-editProfil">
                    <form method="POST" action="/kelTestimoni" class="edit-testi">
                        @csrf
                        <h2>Form Testimoni</h2>
                        <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id }}">
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
                        <div class="submit-button">
                            <button type="submit" class="btn btn-primary">Kirimkan Testimoni</button>
                        </div>
                    </form>
                </div>
            </div>
        {{-- </div> --}}
@endsection

