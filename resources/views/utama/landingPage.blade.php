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
            <div class="land-satu">
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
                </div>
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
                @if ($countPromo!=0)
                    
                @endif
                <hr style="color: #ffffff">
                <h3 id="promo">Promo</h3>
                <p style="color: #FF6900;">Temukan promo yang bisa kamu dapatkan disini.. </p>
                <div class="img-promo">
                    {{-- <img src="{{ asset('img/diskon.png') }}" alt="promo" style="height: 300px; width: 1200px;"> --}}
                    @foreach ($promos as $promo)
                    {{-- {{ $promo->id }} --}}
                    <img src="{{ asset('storage/'.$promo->gambar) }}" alt="Promo Image">
                        
                    @endforeach
                </div>
                
                <hr>
                <h3 id="katDiklat">Kategori Diklat</h3>
                <p style="color: #FF6900;">Klik button untuk melihat lebih banyak diklat </p>
                <div class="cards-container">
                    @foreach ($katDiklat as $kategori)
                        
                        <div class="card-jenis">
                            @if ($kategori->gambar)
                                <img src="{{ asset('storage/' . $kategori->gambar) }}" alt="" >
                            @else
                                @php $foundDefault = false; @endphp
                                @foreach ($katDiklat as $data)
                                    @if ($data->default == 'ya')
                                        <img src="{{ asset('storage/' . $data->gambar) }}" alt="Default Image" >
                                        @php $foundDefault = true; @endphp
                                        @break
                                    @endif
                                @endforeach
                                @if (!$foundDefault)
                                    <img src="{{ asset('img/123.png') }}" alt="Default Image" >
                                @endif
                            @endif
                            {{-- <img src="img/jenis.png" alt="Jenis Diklat"> --}}
                            <br>
                            <div class="card-content">
                                <p>
                                    <span>Kategori "{{ $kategori->kategori_diklat }}"</span><br>
                                </p>
                                <button class="button-link" onclick="window.location.href='/utama/macamDiklat/{{ $kategori->id }}'">
                                    {{ $kategori->kategori_diklat }}
                                </button>
                            </div>
                        </div>    
                    @endforeach
                </div>
                <hr>
                @if ($countTestimoni!=0)
                <h3 id="testimoni">Testimoni</h3>
                    
                <p style="color: #FF6900;">Simak apa kata mereka...</p>
                <div class="slide-testimoni">
                    @foreach ($testimonis as $testimoni)
                        <div class="card-slides">
                            <p class="author">{{ $testimoni->nama_depan }}</p>
                            <b class="author">{{ $testimoni->profesi }}</b><br><br>
                            <p class="author">Alumni diklat {{ $testimoni->pendaftaran->diklat->nama_diklat }}</p>
                            <q>{{ $testimoni->testimoni }}</q>
                        </div>
                    <br> <br>
                    
                    @endforeach
                    <div class="dots-container"></div>
                    <!-- Next and previous buttons -->
                    <a class="sblm" onclick="plusSlides(-1)"></a>
                    <a class="ssdh" onclick="plusSlides(1)"></a>
                </div>
                @endif
                
                <hr>
                <h3 id="faq">FAQ</h3>
                <p style="color: #FF6900;">Pertanyaan yang banyak ditanyakan...</p>
                <button class="accordion">Apa syarat-syarat yang diperlukan untuk mendaftar?</button>
                <div class="panel">
                    <p>
                        Semua persyaratan beserta informasi seputar diklat
                         sudah dituliskan di halaman tiap diklat.
                    </p>
                </div>
                
                <button class="accordion">Bagaimana cara mendaftar diklat?</button>
                <div class="panel">
                    <ul style="list-style: none;"></ul>
                        <li>Mendaftarkan akun terlebih dahulu.
                        Jika sudah mendaftar, maka bisa langsung login</li>
                        <li>Mengisi data pendaftaran di form pendaftaran
                            melalui halaman tiap diklat.
                        </li>
                        <li>Data pendaftaran bisa dilihat, diedit, atau dibatalkan
                            di halaman riwayat.
                        </li>
                    </p>
                </div>
                <button class="accordion">Apa yang harus dipersiapkan untuk mengikuti diklat?</button>
                <div class="panel">
                    <p>
                        Lorem ipsum dolor sit amet, 
                        consectetur adipisicing elit, 
                        sed do eiusmod tempor incididunt 
                        ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud 
                        exercitation ullamco laboris nisi ut 
                        aliquip ex ea commodo consequat.
                    </p>
                </div>
                <button class="accordion">Apakah tersedia beasiswa atau bantuan keuangan?</button>
                <div class="panel">
                    <p>
                        Lorem ipsum dolor sit amet, 
                        consectetur adipisicing elit, 
                        sed do eiusmod tempor incididunt 
                        ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud 
                        exercitation ullamco laboris nisi ut 
                        aliquip ex ea commodo consequat.
                    </p>
                </div>
                <button class="accordion">Bagaimana kebijakan pembatalan atau pengembalian dana?</button>
                <div class="panel">
                    <p>
                        Lorem ipsum dolor sit amet, 
                        consectetur adipisicing elit, 
                        sed do eiusmod tempor incididunt 
                        ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud 
                        exercitation ullamco laboris nisi ut 
                        aliquip ex ea commodo consequat.
                    </p>
                </div>
                <button class="accordion">Sertifikat setelah pelaksanaan diklat bisa diambil dimana?</button>
                <div class="panel">
                    <p>
                        Lorem ipsum dolor sit amet, 
                        consectetur adipisicing elit, 
                        sed do eiusmod tempor incididunt 
                        ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud 
                        exercitation ullamco laboris nisi ut 
                        aliquip ex ea commodo consequat.
                    </p>
                </div>

                <hr>
                <h3 id="profile">Profile</h3>
                <p style="color: #FF6900;">Kepoin kita disini yukk...</p>
                <div class="card-contact">
                    <iframe src="https://www.youtube.com/embed/SbMdkBNQoO8" class="responsive-iframe"></iframe>
                </div>
                
            </div>
            <button onclick="topFunction()" id="myBtn" title="Go to top">
                <i class="bi bi-chevron-double-up"></i>
            </button>
            {{-- Script sementara untuk FAQ --}}
            <script>
                var acc = document.getElementsByClassName("accordion");
                var i;
                
                for (i = 0; i < acc.length; i++) {
                  acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                      panel.style.maxHeight = null;
                    } else {
                      panel.style.maxHeight = panel.scrollHeight + "px";
                    } 
                  });
                }
            </script>
        </body>
    </html>
@endsection