@extends('layout.mainAdmin')
@section('container')
    <h1>Edit Data</h1>
    <form action="/gbrLandingPage/{{ $data->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="img" class="form-label">Gambar sebelumnya</label><br>
            <img src="{{ asset('storage/' . $data->gambar_navbar) }}" class="img-preview img-fluid" style="width: 20%;">
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Masukkan gambar baru untuk ditampilkan di Landing Page</label>
            <img class="img-preview img-fluid" style="width: 20%;">
            <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
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
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
@endsection
