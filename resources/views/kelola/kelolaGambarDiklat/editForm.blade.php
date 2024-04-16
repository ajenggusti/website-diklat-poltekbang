@extends('layout.mainAdmin')
@section('container')
    <h1>Tambah data</h1>
    <form action="/kelGambarDiklat/{{ $kelGambarDiklat->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf      
        {{-- <div class="mb-3">
            <label for="img" class="form-label">Gambar sebelumnya</label><br>
            <img src="{{ asset('storage/' . $kelPromo->gambar) }}" class="img-preview img-fluid" style="width: 20%;">
        </div> --}}
        <div class="mb-3">
            <label for="img" class="form-label">Masukkan gambar</label>
            <img class="img-preview img-fluid" style="width: 20%;" src="{{ asset('storage/'.$kelGambarDiklat->gambar_navbar) }}" alt="Preview Gambar">
            <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
            @error('img')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <select name="diklat" class="form-select @error('diklat') is-invalid @enderror" aria-label="Default select example">
            <option value="" selected disabled>Gambar ini untuk diklat yang mana?</option>
            <option value="null" style="color:red;" {{ old('diklat', $kelGambarDiklat->id_diklat) == 'null' ? 'selected' : '' }}>Untuk semua diklat</option>
            @foreach ($diklats as $diklat)
                <option value="{{ $diklat->id }}" {{ old('diklat', $kelGambarDiklat->id_diklat) == $diklat->id ? 'selected' : '' }}>
                    {{ $diklat->nama_diklat }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('diklat'))
            <div class="invalid-feedback">
                {{ $errors->first('diklat') }}
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
@endsection