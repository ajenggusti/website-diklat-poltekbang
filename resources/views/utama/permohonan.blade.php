@extends('layout.mainUser')
@section('container')
<html>
    <head>
        <!-- Custom styles for this template -->
        <link href="/css/actor.css" rel="stylesheet">
        {{-- Boostrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        {{-- Font Poppins --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
            

        </style>
    </head>
    <body>
        <div class="content">
            <div class="bg-nota">
                <div class="content-mohon">
                    
                    <h2>Permohonan mengganti berkas</h2>
                    
                    <form method="POST" action="/updatePermohonan/{{ $id }}" enctype="multipart/form-data" >
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="permohonan_ubah" class="form-label is">Tuliskan alasan permohonan perubahan data : </label>
                            <input type="text" class="form-control  @error('permohonan_ubah') is-invalid @enderror" id="permohonan_ubah" name= "permohonan_ubah">
                            @error('permohonan_ubah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="btn-mohon">
                            <button type="submit" class="btn btn-primary">  Kirim   </button>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </body>
</html>


@endsection