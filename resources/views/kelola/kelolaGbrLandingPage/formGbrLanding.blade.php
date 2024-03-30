@extends('layout.mainAdmin')
@section('container')
    <h1>Tambah data</h1>
    <form action="/gbrLandingPage" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="img" class="form-label">Masukkan gambar untuk ditampilkan di Landing Page</label>
            <img class="img-preview img-fluid" style="width: 20%;">
            <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
            @error('img')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status Tampilan</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="tampilkan" value="tampilkan" >
                <label class="form-check-label" for="tampilkan">
                    Tampilkan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="sembunyikan" value="sembunyikan" checked>
                <label class="form-check-label" for="sembunyikan">
                    Sembunyikan
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
    <script>
        function previewImage() {
            const preview = document.querySelector('.img-preview');
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
@endsection
