@extends('layout/mainUser')
@section('title', $detailDiklat->nama_diklat)
@section('container')
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <link href="/css/detailDiklat.css" rel="stylesheet">

        <div class="content-header">
            <div class="headTitle">
                <h1 class="outlined-text">{{ $detailDiklat->nama_diklat }}</h1>
            </div>
            
            <div class="img-container">
                <img src="{{ asset('img/detail.png') }}" alt="">
            </div>
        </div>
        <hr>
        <div class="content-body2">
            <div class="card-content3 row">
                <p class="harga-detail">
                    <img src="{{ asset('img/money-detail.png') }}" alt="money">
                    <span>Harga Diklat : {{ 'Rp ' . number_format($detailDiklat->harga, 0, ',', '.') }}</span>
                </p>
                
                <p class="harga-detail">
                    <img src="{{ asset('img/add-detail.png') }}" alt="jumlah pendaftar">
                    <span>Jumlah Pendaftar Saat Ini :
                    {{ $detailDiklat->jumlah_pendaftar }}</span>
                </p>
                
                <p class="harga-detail">
                    <img src="{{ asset('img/status-detail.png') }}" alt="status pendaftar">
                    <span>Kuota Pendaftaran :
                    {{ $detailDiklat->status }}</span>
                </p>
                
            </div>
            <br>
            <div class="des-detail">
                {!! $detailDiklat->deskripsi !!}
                <div class="btn-regDiklat d-flex justify-content-center">
                    @guest
                    @if ($dobelDiklat==null)
                        <div class=" btn-container">
                            <button class="btn btn-primary" type="button" onclick="window.location.href = '/login';">Login untuk mendaftar!</button>
                        </div>
                        @endif
                    @endguest
                    @auth
                        @if($detailDiklat->status== "full")
                            <div class="alert alert-danger detail-one" role="alert">
                                Mohon maaf, diklat ini sudah penuh.<a href="/" class="btn "> Lihat diklat yang lain?</a>
                            </div>
                        @elseif($dobelDiklat)
                            <div class="alert alert-warning detail-two" role="alert" >
                                Ups, kamu sudah mendaftar diklat ini.<a href="/riwayat" class="btn"> Lihat riwayat?</a>
                            </div>
                        @elseif($user->status!= "Diverifikasi")
                            <div class="alert alert-info detail-three" role="alert">
                                Ups, data pribadimu belum Diverifikasi.<a href="/editProfil" class="btn"> Lengkapi data disini?</a>
                            </div>
                        @else
                            <div class="button-detail">
                                <a href="{{ route('kelPendaftaran.create', ['id' => $detailDiklat->id]) }}" class="btn btn-primary">Daftarkan dirimu</a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
@endsection
