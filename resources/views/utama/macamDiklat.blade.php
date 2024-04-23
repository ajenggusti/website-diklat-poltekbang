@extends('layout/mainUser')
@section('container')
<html>
    <head>
        <link href="/css/detailDiklat.css" rel="stylesheet">
            {{-- <script src="/js/landing.js"></script> --}}
        {{-- Boostrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        {{-- Font Poppins --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <div class="content-body">
            <h2>Jenis Diklat</h2>
            <div class="card-container2">
                @foreach ($diklat as $perdiklat)
                <div class="card-img">
                    {{-- <img src="{{ asset('img/jenis.png') }}" alt="Macam Diklat">
                    <br>
                    <p>
                        <span>{{ $perdiklat -> nama_diklat }}</span><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Odio laudantium sequi perspiciatis officiis quo adipisci.
                    </p> --}}
                    @if ($perdiklat->gambar)
                        <img src="{{ asset('storage/' . $perdiklat->gambar) }}" alt="" style="width: 30%;">
                    @else
                        @php $foundDefault = false; @endphp
                        @foreach ($allDiklat as $data)
                            @if ($data->default == 'ya')
                                <img src="{{ asset('storage/' . $data->gambar) }}" alt="Default Image" style="width: 30%;">
                                @php $foundDefault = true; @endphp
                                @break
                            @endif
                        @endforeach
                        @if (!$foundDefault)
                            <img src="{{ asset('img/123.png') }}" alt="Default Image" style="width: 30%;">
                        @endif
                    @endif
                    <div class="card-content2">
                        <button class="button-link" onclick="window.location.href='/utama/detailDiklat/{{ $perdiklat -> id}}'">
                            Lihat Detail
                        </button>
                    </div>
                </div>
                    <br>
                @endforeach   
                
            </div>     
            <a href="/" class="btn btn-info">Kembali</a>
        </div>
    </body>
    </html>
@endsection