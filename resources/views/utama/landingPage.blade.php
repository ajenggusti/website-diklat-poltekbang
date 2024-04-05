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
                @foreach ($gbrSlide as $slide)
                    <div class="mySlides">
                        <img src="{{ asset('storage/' . $slide->gambar_navbar) }}" alt="Gambar Slide">
                    </div>
                    @endforeach

            </div>

            <br> <br>
            <div class="hero-text">
                <h2>Lorem, ipsum dolor!</h2>
                <br>
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <br> <br>
            
            <div class="content-land">
                <div class="column">
                    <div class="column left">
                        <h1>Jumlah Pendaftar
                        <br>
                        {{ $jmlPendaftar }}</h1>
                    </div>
                    <div class="column middle">
                        
                    </div>
                    <div class="column right">
                        <h1>Jumlah Diklat
                        <br>
                        {{ $jmlDiklat }}</h1>
                    </div>
                    <br><br>
                </div>


                <hr style="color: #ffffff">
                <h3 id="promo">Promo</h3>
                <p style="color: #FF6900;">Temukan promo yang bisa kamu dapatkan disini.. </p>
                <div class="img-promo">
                    <img src="{{ asset('img/banner.png') }}" alt="promo">
                </div>
                
                <hr>
                <h3 id="katDiklat">Kategori Diklat</h3>
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
                <h3 id="testimoni">Testimoni</h3>
                <p style="color: #FF6900;">Simak apa kata mereka...</p>
                <div class="slide-testimoni">
                    @foreach ($testimonis as $key => $testimoni)
                    <div class="card-slides">
                        <p class="author">{{ $testimoni->nama_depan }}</p>
                        <b class="author">{{ $testimoni->profesi }}</b><br><br>
                        <q>{{ $testimoni->testimoni }}</q>
                    </div>
                    <br> <br>
                    
                    @endforeach
                    <div class="dots-container"></div>
                    <!-- Next and previous buttons -->
                    <a class="sblm" onclick="plusSlides(-1)"></a>
                    <a class="ssdh" onclick="plusSlides(1)"></a>
                </div>
                <br><br>
                <h3 id="faq">FAQ</h3>
            </div>

            <button onclick="topFunction()" id="myBtn" title="Go to top">
                <i class="bi bi-chevron-double-up"></i>
            </button>
            <script>
                // Get the button
                let mybutton = document.getElementById("myBtn");
                
                // When the user scrolls down 20px from the top of the document, show the button
                window.onscroll = function() {scrollFunction()};
                
                function scrollFunction() {
                  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                  } else {
                    mybutton.style.display = "none";
                  }
                }
                
                // When the user clicks on the button, scroll to the top of the document
                function topFunction() {
                  document.body.scrollTop = 0;
                  document.documentElement.scrollTop = 0;
                }
            </script>
                
        </body>
    </html>
@endsection