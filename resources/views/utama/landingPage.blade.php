{{-- extend merupakan inheritance dari nama file yang ingin di warisi --}}
@extends('layout/mainUser')
@section('container')
    <html>
        <head>
                <!-- Custom styles for this template -->
            <link href="/css/landing.css" rel="stylesheet">
            <script src="/js/landing.js"></script>
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
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="img/promo.jpg" style="height: 1%;">
                    <div class="text">Caption Text</div>
                </div>
                            
                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="img/promo.jpg" style="height: 1%">
                    <div class="text">Caption Text</div>
                </div>
                            
                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="img/promo.jpg" style="height: 1%">
                    <div class="text">Caption Text</div>
                </div>     
                         
                <br>
                
                <div style="text-align:center">
                  <span class="dot"></span> 
                  <span class="dot"></span> 
                  <span class="dot"></span> 
                </div>
            </div>

            <br> <br>
            <div class="hero-text">
                <h2>Lorem, ipsum dolor!</h2>
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <br> <br>
            
            <div class="content-land">
                <div class="img-promo">
                    <img src="{{ asset('img/banner.png') }}" alt="promo">
                </div>
                <br> <br>
                <div class="column">
                    <div class="column left">
                        <h1>Jumlah Pendaftar <br>{{ $jmlPendaftar }}</span></h1>
                    </div>
                    <div class="column middle">
                        
                    </div>
                    <div class="column right">
                        <h1>Jumlah Diklat <br>{{ $jmlDiklat }}</h1>
                    </div>
                </div>
                <hr>
                <h3>Kategori Diklat</h3>
                <p style="color: #FF6900;">Klik button untuk melihat lebih banyak diklat </p>
                <div class="cards-container">
                    @foreach ($katDiklat as $kategori)
                    <div class="card-jenis">
                        <img src="img/jenis.png" alt="Jenis Diklat">
                        <br>
                        <div class="card-content">
                            <p>
                                <span>Kategori "{{ $kategori->kategori_diklat }}"</span><br>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                                Sit itaque porro quasi a quod harum voluptatum alias natus 
                                doloribus eum unde.
                            </p>
                            <button class="button-link" onclick="window.location.href='/utama/macamDiklat/{{ $kategori->id }}'">
                                {{ $kategori->kategori_diklat }}
                            </button>
                        </div>
                    </div>    
                    @endforeach
                </div>

                <hr>
                <h3>Testimoni</h3>
                <p style="color: #FF6900;">Simak apa kata mereka...</p>
                <div class="slide-testimoni">
                    @foreach ($testimonis as $key => $testimoni)
                    <div class="card-slides">
                        <q>{{ $testimoni->testimoni }}</q>
                        <p class="author">{{ $testimoni->nama_depan }}</p>
                        <b class="author">{{ $testimoni->profesi }}</b>
                        <div class="numbertext">{{ $key + 1 }} / {{ count($testimonis) }}</div>
                    </div>
                    @endforeach
                
                    <!-- Next and previous buttons -->
                    <a class="sblm" onclick="plusSlides(-1)">❮</a>
                    <a class="ssdh" onclick="plusSlides(1)">❯</a>
                </div>
            </div>
        </body>
    </html>
@endsection