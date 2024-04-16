@extends('layout.mainUser')
@section('container')
{{-- <html>
    <head>
        <link href="/css/form.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

        </style>
    </head>
    <body>
        <div class="content-bodyForm"> --}}
            <h1>BELUM FIKS</h1>
            <h1>Form Pembayaran</h1>
            <form action="/kelPembayaran" method="post" enctype="multipart/form-data">
                @csrf
                {{ $pendaftaran->id }}
                <br>
                <div class="mb-3">
                    <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id }}">
                </div>
                <div class="mb-9 row">
                    <label for="harga" class="form-label col-auto">Nama Diklat</label>
                    <div class="col">
                        <input disabled type="text" class="form-control custom-input @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ $pendaftaran->diklat->nama_diklat }}">
                    </div>
                </div>
                <hr> 
                <div class="mb-3">
                    <label for="harga" class="form-label is">Harga Diklat</label>
                    <input disabled type="text" class="form-control custom-input @error('harga') is-invalid @enderror" id="harga" name="harga" value="Rp {{ number_format($pendaftaran->harga_diklat, 0, ',', '.') }}">
                </div>               
                <div class="mb-3">
                    <label for="harga" class="form-label is">Status Pembayaran Diklat</label>
                    <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ $pendaftaran->status_pembayaran_diklat }}">
                </div>    
                <br>    
                <div class="mb-3">
                    <label for="harga" class="form-label is">Harga Pendaftaran</label>
                    <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="Rp 150.000">
                </div>        
                <div class="mb-3">
                    <label for="harga" class="form-label is">Status Pembayaran Pendaftaran</label>
                    <input disabled type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ $pendaftaran->status_pembayaran_daftar }}">
                </div>  
                <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-select @error('jenis_pembayaran') is-invalid @enderror">
                    <option value="" disabled {{ old('jenis_pembayaran') ? '' : 'selected' }}>Pilih Jenis Pembayaran</option>
                    <option value="diklat" {{ old('jenis_pembayaran') == 'diklat' ? 'selected' : '' }}>Diklat</option>
                    <option value="pendaftaran" {{ old('jenis_pembayaran') == 'pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                </select>
                @error('jenis_pembayaran')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <hr>
                <div class="mb-3">
                    <label for="img" class="form-label">Upload bukti pembayaran</label>
                    <img class="img-preview img-fluid" style="width: 20%;">
                    <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
                    @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>  
        {{-- </div> --}}
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            
        <!-- Include jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
        

    {{-- </body>
</html> --}}
@endsection

{{-- <select name="id_level" class="form-select" aria-label="Default select example">
    <option selected disabled>Pilih level untuk user</option>
    @foreach ($getLevel as $level)
        <option value="{{ $level->id }}" {{ old('id_level', $data->id_level) == $level->id ? 'selected' : '' }}>
            {{ $level->level }}
        </option>
    @endforeach
</select>        --}}