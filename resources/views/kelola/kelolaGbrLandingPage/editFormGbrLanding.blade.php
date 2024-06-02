@extends('layout.mainAdmin')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">

    <div class="content-form">
            
            <form action="/gbrLandingPage/{{ $data->id }}" method="post" enctype="multipart/form-data" class="edit-staff">
                @method('put')
                @csrf
                <h2>Form Edit Gambar Landing Page</h2>
                <hr>
                <div class="mb-3 img-pre">
                    <label for="img" class="form-label">Gambar sebelumnya</label><br>
                    <img src="{{ asset('storage/' . $data->gambar_navbar) }}" class="img-preview img-fluid img-pre" style="width: 500px; height: 250px;">
                </div>
                <div class="mb-3 ">
                    <label for="img" class="form-label">Masukkan gambar baru</label>
                    <img class="img-preview img-fluid ">
                    <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
                    <small style="color: rgb(16, 126, 190)">Ukuran maksimal gambar 2 MB</small>
                    @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Tampilan</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="tampilkan" value="tampilkan" {{ $data->status === 'tampilkan' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tampilkan">
                            Tampilkan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="sembunyikan" value="sembunyikan" {{ $data->status === 'sembunyikan' ? 'checked' : '' }}>
                        <label class="form-check-label" for="sembunyikan">
                            Sembunyikan
                        </label>
                    </div>
                </div>
                <div class="submit-button">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>

@endsection
