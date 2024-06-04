@extends('layout/mainUser')
@section('container')
    <link href="/css/detailDiklat.css" rel="stylesheet">

    {{-- <div class="container-fluid"> --}}
        <div class="content-body">
            {{-- <div class="content-land"> --}}
            {{-- BREADCRUMBS --}}
            {{-- <br>
            <nav aria-label="breadcrumb" style="background-color: #FFFFFF !important;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="/">HOME</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="/macamDiklat">{{ $diklatOne->kategori_diklat }}</a>
                    </li>
                </ol>
            </nav> --}}
            
            @if (count($diklat) != 0 )
                <a href="/" class="btn btn-info" style="margin-top: 40px;">Kembali</a>
                {{-- <br> --}}
                <h2>PROGRAM {{ $diklatOne->kategori_diklat }}</h2>
                <div class="card-container2">
                    @foreach ($diklat as $perdiklat)
                        <div class="card-img">
                            @if ($perdiklat->gambar)
                                <img src="{{ asset('storage/' . $perdiklat->gambar) }}" alt="">
                            @else
                                @php $foundDefault = false; @endphp
                                @foreach ($allDiklat as $data)
                                    @if ($data->default == 'ya')
                                        <img src="{{ asset('storage/' . $data->gambar) }}" alt="Default Image">
                                        @php $foundDefault = true; @endphp
                                        @break
                                    @endif
                                @endforeach
                                @if (!$foundDefault)
                                    <img src="{{ asset('img/123.png') }}" alt="Default Image">
                                @endif
                            @endif
                            <div class="card-content2">
                                <hr style="color:rgb(255, 255, 255)">
                                <h6 style="text-align: center">{{ $perdiklat->nama_diklat }}</h6>
                                <hr>
                                <p>
                                    <i class="bi bi-person-fill-add"></i>
                                    <span>Kuota  : {{ $perdiklat->kuota_minimal }}</span><br>
                                    
                                    @if ($perdiklat->status == 'full')
                                        <i class="bi bi-person-check" ></i>
                                    @else
                                        <i class="bi bi-person-x"></i>
                                    @endif
                                    <span>Status :  {{ $perdiklat->status }}</span><br>

                                    <i class="bi bi-currency-dollar"></i>
                                    <span>Biaya : {{ 'Rp ' . number_format($perdiklat->harga, 0, ',', '.') }}</span>
                                </p>
                                <button class="button-link" onclick="window.location.href='/utama/detailDiklat/{{ $perdiklat -> id}}'">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                        <br>
                    @endforeach   
                </div>  
            @else
                <div class="text-center no-found">
                    
                    <img src="{{ asset('img/search.png') }}" alt="data not found">
                    <h2>Ups!!Tidak ada program yang tersedia</h2>
                    <a href="/">Back to previous</a>
                </div>
            @endif   
        </div>
    {{-- </div> --}}
@endsection