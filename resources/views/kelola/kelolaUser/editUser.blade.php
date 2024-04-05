@extends('layout.mainAdmin')
@section('container')
    <h2>Form Mengubah Level User</h2>
    
    <form method="POST" action="/register/{{ $data->id }}" >
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="namaPengguna">nama pengguna</label>
            <input name="namaPengguna" type="text" class="form-control @error('namaPengguna') is-invalid @enderror" id="namaPengguna" value="{{ old('namaPengguna')?? $data->name }}" disabled>
            @error('namaPengguna')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email">Email address</label>
            <input name="email" value="{{ old('email')?? $data->email }}" type="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Email address" disabled>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <select name="id_level" class="form-select" aria-label="Default select example">
            <option selected disabled>Pilih level untuk user</option>
            @foreach ($getLevel as $level)
                <option value="{{ $level->id }}" {{ old('id_level', $data->id_level) == $level->id ? 'selected' : '' }}>
                    {{ $level->level }}
                </option>
            @endforeach
        </select>              
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>  
@endsection

