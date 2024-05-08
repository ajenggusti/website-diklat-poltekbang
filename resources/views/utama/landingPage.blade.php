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
            <div class="container-land">
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
                        <h2>Website Pendaftaran Diklat</h2>
                    </div>
                </div>
                <br> <br>
                
                <div class="content-land">
                    {{-- <div class="card-landing mb-3" >
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="card-one">
                                    <h5 class="card-title" id="pendaftar">{{ $jmlPendaftar }}</h5>
                                    <p class="card-text">Pendaftar</p>
                                </div>
                                <div class="card-two">
                                    <h5 class="card-title" id="diklat">{{ $jmlDiklat }}</h5>
                                    <p class="card-text">Diklat</p>
                                </div>
                            </div>
                        </div> --}}

                        <div class="card-group">
                            {{-- <div class="animasi-card"> --}}
                                <div class="card animated-card rainbow-bg">
                                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title animated-text" id="pendaftar">{{ $jmlPendaftar }}</h5>
                                    <p class="card-text animated-text">Pendaftar</p>
                                </div>
                                </div>
                                <div class="card animated-card rainbow-bg">
                                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title animated-text" id="diklat">{{ $jmlDiklat }}</h5>
                                    <p class="card-text animated-text">Diklat</p>
                                </div>
                            </div>
                        </div>
            
                    <hr>
                    @if ($countPromo!=0)
                        <h3 id="promo">Promo</h3>
                        <p style="color: #FF6900;">Temukan promo yang bisa kamu dapatkan disini.. </p>
                        <div id="carouselExampleIndicators" class="carousel slide img-promo" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach ($promos as $key => $promo)
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($promos as $key => $promo)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/'.$promo->gambar) }}" class="d-block w-100" alt="Promo Image">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @endif
                    
                    
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
                                <br>
                                <div class="card-content">
                                    <p>
                                        <span>{{ $kategori->kategori_diklat }}</span><br>
                                    </p>
                                    <br><br>
                                    <button class="button-link" onclick="window.location.href='/utama/macamDiklat/{{ $kategori->id }}'">
                                        Selengkapnya
                                    </button>
                                </div>
                            </div>    
                        @endforeach
                    </div>

                    {{-- <hr>
                    @if ($countTestimoni!=0)
                        <h3 id="testimoni">Testimoni</h3>
                            
                        <p style="color: #FF6900;">Simak apa kata mereka...</p>
                        <div class="slide-testimoni">
                            @foreach ($testimonis as $index => $testimoni)
                                <div class="card-slides{{ $index === 0 ? ' active' : '' }}">
                                    @if ($testimoni->id_pendaftaran)
                                        <b class="author">{{ $testimoni->pendaftaran->nama_lengkap }}</b><br><br>
                                        <span class="author">- {{ $testimoni->profesi }} -</span><br><br>
                                        <p class="author">Alumni diklat {{ $testimoni->pendaftaran->diklat->nama_diklat }}</p>
                                        <q>{{ $testimoni->testimoni }}</q>
                                    @else
                                        <b class="author">{{ $testimoni->nama_dummy }}</b><br><br>
                                        <span class="author">- {{ $testimoni->profesi }} -</span><br><br>
                                        <p class="author">Alumni diklat {{ $testimoni->diklat->nama_diklat }}</p>
                                        <q>{{ $testimoni->testimoni }}</q>
                                    @endif
                                </div>
                                <br> <br>
                            @endforeach
                            <a class="sblm" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="ssdh" onclick="plusSlides(1)">&#10095;</a>
                        </div>
                    @endif --}}
                    <hr>
                    @if ($countTestimoni!=0)
                    <h3 id="testimoni">Testimoni</h3>
                    <p style="color: #FF6900;">Simak apa kata mereka...</p>
                    <div class="slide-testimoni">
                        @foreach ($testimonis as $key => $testimoni)
                        <div class="card-slides">
                            <b class="author">{{ $testimoni->pendaftaran->nama_lengkap }}</b><br><br>
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
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Apa syarat-syarat yang diperlukan untuk mendaftar?
                            </button>
                          </h2>
                          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Semua persyaratan beserta informasi seputar diklat
                                sudah dituliskan di halaman tiap diklat.
                            </div>
                          </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Bagaimana cara mendaftar diklat?
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul>
                                        <li>
                                            Mendaftarkan akun terlebih dahulu.
                                            Jika sudah mendaftar, maka bisa langsung login
                                        </li>
                                        <li>
                                            Mengisi data pendaftaran di form pendaftaran
                                            melalui halaman tiap diklat.
                                        </li>
                                        <li>
                                            Data pendaftaran bisa dilihat, diedit, atau dibatalkan
                                            di halaman riwayat.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Apa yang harus dipersiapkan untuk mengikuti diklat?
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, 
                                    consectetur adipisicing elit, 
                                    sed do eiusmod tempor incididunt 
                                    ut labore et dolore magna aliqua.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    Apakah tersedia beasiswa atau bantuan keuangan?
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, 
                                    consectetur adipisicing elit, 
                                    sed do eiusmod tempor incididunt 
                                    ut labore et dolore magna aliqua.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                    Bagaimana kebijakan pembatalan atau pengembalian dana?
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, 
                                    consectetur adipisicing elit, 
                                    sed do eiusmod tempor incididunt 
                                    ut labore et dolore magna aliqua.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                    Sertifikat setelah pelaksanaan diklat bisa diambil dimana?
                                </button>
                            </h2>
                            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, 
                                    consectetur adipisicing elit, 
                                    sed do eiusmod tempor incididunt 
                                    ut labore et dolore magna aliqua.
                                </div>
                            </div>
                        </div>
                    </div>



                    <hr>
                    <h3 id="profile">Profile</h3>
                    <p style="color: #FF6900;">Kepoin kita disini yukk...</p>
                    <div class="card-contact">
                        <iframe src="https://www.youtube.com/embed/SbMdkBNQoO8" class="responsive-iframe"></iframe>
                    </div>
                    
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

            {{-- Animasi jumlah pendaftar --}}
            <script>
                // Mendapatkan elemen pendaftar dan diklat
                var pendaftarElement = document.getElementById("pendaftar");
                var diklatElement = document.getElementById("diklat");
            
                // Fungsi untuk menghasilkan angka acak antara min dan max
                function getRandomNumber(min, max) {
                    return Math.floor(Math.random() * (max - min + 1)) + min;
                }
            
                // Fungsi untuk menampilkan animasi angka acak selama beberapa detik
                function animateRandomNumber(element, initialValue, finalValue) {
                    var currentValue = initialValue;
                    var interval = setInterval(function () {
                        currentValue = getRandomNumber(currentValue, finalValue);
                        element.textContent = currentValue;
                        if (currentValue === finalValue) {
                            clearInterval(interval);
                        }
                    }, 100); // Perbarui angka setiap 100ms
                }
            
                // Jalankan animasi untuk pendaftar dan diklat
                animateRandomNumber(pendaftarElement, 0, {{ $jmlPendaftar }});
                animateRandomNumber(diklatElement, 0, {{ $jmlDiklat }});
            </script>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let slideIndex = 0;

                    function showSlides() {
                        let slides = document.getElementsByClassName("card-slides");

                        // Sembunyikan semua slide
                        for (let i = 0; i < slides.length; i++) {
                            slides[i].classList.remove("active");
                        }

                        slideIndex++;
                        if (slideIndex > slides.length) {slideIndex = 1}

                        // Tampilkan slide aktif
                        slides[slideIndex - 1].classList.add("active");

                        setTimeout(showSlides, 3000);
                    }

                    function plusSlides(n) {
                        slideIndex += n;
                        let slides = document.getElementsByClassName("card-slides");
                        if (slideIndex > slides.length) {slideIndex = 1}
                        else if (slideIndex < 1) {slideIndex = slides.length}

                        // Tampilkan slide yang sesuai
                        for (let i = 0; i < slides.length; i++) {
                            slides[i].classList.remove("active");
                        }
                        slides[slideIndex - 1].classList.add("active");
                    }

                    // Tambahkan event listener untuk tombol "Sebelumnya" dan "Selanjutnya"
                    let prevButton = document.querySelector(".sblm");
                    let nextButton = document.querySelector(".ssdh");
                    prevButton.addEventListener("click", function() {
                        plusSlides(-1);
                    });
                    nextButton.addEventListener("click", function() {
                        plusSlides(1);
                    });

                    showSlides();
                });
            </script>
        </body>
    </html>
@endsection