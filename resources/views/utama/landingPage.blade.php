@extends('layout/mainUser')
@section('container')
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <!-- *******  Font Awesome Icons Link  ******* -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <!-- *******  Owl Carousel Links  ******* -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>

    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    {{-- <link href="/css/landing.css" rel="stylesheet"> --}}
    <link href="/css/landTestimoni.css" rel="stylesheet">
    <link href="/css/landKatDiklat.css" rel="stylesheet">

    <link href="/css/landingPage.css" rel="stylesheet">
    <script src="/js/landing.js"></script>

    <div class="landing">
        <div class="landOne">
            <h1>
                Selamat Datang Di Website 
                Pendaftaran Diklat Politeknik Penerbangan Surabaya <br>
                @if ($currentUser == null)
                <a href="/login" class="btn">Daftarkan Dirimu !!</a>
                @else
                    <p><i style="color: white" class="bi bi-quote"></i>{{ $currentUser->name }}<i style="color: white; transform: scaleX(-1);" class="bi bi-quote"></i></p>
                @endif
                
            </h1>
            <img src="{{ asset('img/Artboard.png') }}" alt="">
        </div>


        <div class="land">
            <div class="landBlank"></div>
            <div class="landTwo">
                {{-- lnadTwo -> wrapper --}}
                <div class="card-animasi" >
                    {{-- card-animasi => container --}}
                    <i class="fas fa-users"></i>
                    <span class="num-animasi" data-val="{{ $totalPendaftar }}">0</span>
                    <span class="text-animasi">Total Seluruh Pendaftar</span>
                </div>
                <div class="card-animasi" >
                    <i class="fas fa-user-plus"></i>
                    <span class="num-animasi" data-val="{{ $jmlPendaftarBelumTerlaksana }}">0</span>
                    <span class="text-animasi">Pendaftar Periode Ini</span>
                </div>
                <div class="card-animasi" >
                    <i class="fas fa-user-graduate"></i>
                    <span class="num-animasi" data-val="{{ $alumni }}">0</span>
                    <span class="text-animasi">Total Lulusan Diklat </span>
                </div>
                <div class="card-animasi" >
                    <i class="fas fa-book"></i>
                    <span class="num-animasi" data-val="{{ $jmlDiklat }}">0</span>
                    <span class="text-animasi">Total diklat saat ini</span>
                </div>
            </div>

            {{-- <div class="landBlank"></div> --}}

            <div class="landThree">
                <div class="promo-land">
                    @if ($countPromo!=0)
                        <h3 id="promo">Promo</h3>
                        <p>Temukan promo yang bisa kamu dapatkan disini.. </p>
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
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="color: rgba(0, 0, 0, 0.656);"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="color: rgba(0, 0, 0, 0.777);"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="landFour">
                <div class="kat-land swiper">
                    <h3 id="katDiklat">Kategori Diklat</h3>
                    <p class="p-kat">Klik button untuk melihat lebih banyak diklat </p>
                    <div class="slide-content">
                        <div class="card-wrapper swiper-wrapper">
                            @foreach ($katDiklat as $kategori)
                                <div class="card swiper-slide">
                                    <div class="image-content">
                                        <div class="card-image">
                                            @if ($kategori->gambar)
                                                <img src="{{ asset('storage/' . $kategori->gambar) }}" alt="" class="card-img">
                                            @else
                                                @php $foundDefault = false; @endphp
                                                @foreach ($katDiklat as $data)
                                                    @if ($data->default == 'ya')
                                                        <img src="{{ asset('storage/' . $data->gambar) }}" alt="Default Image" class="card-img">
                                                        @php $foundDefault = true; @endphp
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if (!$foundDefault)
                                                    <img src="{{ asset('img/123.png') }}" alt="Default Image" class="card-img">
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <h2 class="name">{{ $kategori->kategori_diklat }}</h2>
                                        <button class="button" onclick="window.location.href='/utama/macamDiklat/{{ $kategori->id }}'">Selengkapnya</button>
                                    </div>
                                </div>   
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-next swiper-navBtn"></div>
                    <div class="swiper-button-prev swiper-navBtn"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="testi-header">
                <h2 id="testimoni">Testimoni</h2>
                <p class="p-testi">Simak apa kata mereka...</p>
            </div>
            <div class="landFive">
                <div class="testi-land">
                    @if ($countTestimoni != 0)
                        <div class="owl-carousel owl-theme testimonials-container">
                            @foreach ($testimonis as $testimoni)
                                <div class="item testimonial-card">
                                    <main class="test-card-body">
                                        @if ($testimoni->id_pendaftaran)
                                            <div class="quote">
                                                <i class="fa fa-quote-left"></i>
                                                <h4>{{ $testimoni->nama_dummy ?? 'Testimoni' }} <small> - {{ $testimoni->profesi }}</small></h4>
                                            </div>
                                            <p>{{ $testimoni->testimoni }}</p>
                                            <div class="bottom-b">
                                                <b>Alumni diklat {{ $testimoni->pendaftaran->diklat->nama_diklat }}</b>
                                            </div>
                                        @else
                                            <div class="quote">
                                                <i class="fa fa-quote-left"></i>
                                                <h4>{{ $testimoni->nama_dummy ?? 'Testimoni' }} <small> - {{ $testimoni->profesi }}</small></h4>
                                            </div>
                                            <p>{{ $testimoni->testimoni }}</p>
                                            <div class="bottom-b">
                                                <b>Alumni diklat {{ $testimoni->diklat->nama_diklat }}</b>
                                            </div>
                                        @endif
                                    </main>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
                
            <div class="landSix">
                <div class="faq-land">
                {{-- <hr> --}}
                    <h3 id="faq">FAQ</h3>
                    <p>Pertanyaan yang banyak ditanyakan...</p>
                    <div class="bg-acc">
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
                                        <ul>Persyaratan Administratif
                                            <li>Pendaftaran: Pastikan Anda memahami proses pendaftaran dan mengumpulkan semua dokumen yang diperlukan seperti formulir pendaftaran, fotokopi ijazah, dan pas foto.</li>
                                            <li>Dokumen Identitas: Siapkan KTP, kartu pelajar, atau identitas lainnya yang mungkin diperlukan.</li>
                                            <li>Biaya: Pastikan Anda mengetahui biaya pendaftaran dan biaya diklat serta mempersiapkan dana yang diperlukan.</li>
                                        </ul>
                                        <ul>Persyaratan Akademis
                                            <li>Latar Belakang Pendidikan: Biasanya, diklat penerbangan membutuhkan latar belakang pendidikan tertentu. Pastikan Anda memenuhi persyaratan ini.</li>
                                            <li>Tes Masuk: Beberapa program mungkin memiliki tes masuk yang menguji kemampuan akademis, bahasa Inggris, dan pengetahuan teknis dasar. Persiapkan diri Anda dengan belajar materi terkait.</li>
                                        </ul>
                                        <ul>Persyaratan Kesehatan
                                            <li>Tes Kesehatan: Diklat penerbangan sering kali mengharuskan peserta menjalani tes kesehatan. Pastikan Anda dalam kondisi kesehatan yang baik dan mempersiapkan diri untuk pemeriksaan medis.</li>
                                            <li>Sertifikat Kesehatan: Beberapa program mungkin memerlukan sertifikat kesehatan dari dokter.</li>
                                        </ul>
                                        <ul>Persyaratan Fisik
                                            <li>Kebugaran Fisik: Diklat penerbangan mungkin melibatkan aktivitas fisik. Mulailah program kebugaran untuk memastikan Anda dalam kondisi fisik yang prima.</li>
                                            <li>Pelatihan Kebugaran: Beberapa program mungkin menyediakan panduan kebugaran yang harus diikuti sebelum memulai diklat.</li>
                                        </ul>
                                        <ul>Persiapan Mental dan Psikologis
                                            <li>Kesiapan Mental: Diklat penerbangan bisa sangat menuntut. Persiapkan diri Anda secara mental untuk menghadapi tekanan dan tantangan yang mungkin muncul.</li>
                                            <li>Tes Psikologis: Beberapa program mungkin termasuk tes psikologis untuk memastikan kesiapan mental peserta.</li>
                                        </ul>
                                        <ul>Materi dan Peralatan Belajar
                                            <li>Buku dan Materi Pelajaran: Dapatkan informasi tentang buku dan materi pelajaran yang akan digunakan dan pastikan Anda mempersiapkan semuanya sebelum diklat dimulai.</li>
                                            <li>Peralatan: Siapkan peralatan yang diperlukan seperti seragam, alat tulis, laptop, atau alat khusus lainnya sesuai dengan kebutuhan program.</li>
                                        </ul>
                                        <ul>Informasi Tentang Program
                                            <li>Jadwal dan Kurikulum: Pahami jadwal dan kurikulum diklat untuk mengetahui apa yang akan diajarkan dan kapan.</li>
                                            <li>Instruktur: Kenali siapa instruktur atau pengajar di program diklat tersebut dan cari informasi mengenai pengalaman dan latar belakang mereka.</li>
                                        </ul>
                                        <ul>Persiapan Keuangan
                                            <li>Anggaran: Selain biaya diklat, perhitungkan biaya tambahan seperti transportasi, akomodasi, makan, dan kebutuhan sehari-hari lainnya.</li>
                                            <li>Beasiswa: Cari informasi mengenai beasiswa atau bantuan keuangan yang mungkin tersedia untuk membantu meringankan biaya.</li>
                                        </ul>
                                        <ul>Persiapan Teknis
                                            <li>Keterampilan Teknis: Jika diklat tersebut memerlukan keterampilan teknis tertentu (misalnya, pemahaman dasar tentang penerbangan atau teknik tertentu), pastikan Anda sudah memiliki dasar pengetahuan tersebut.</li>
                                            <li>Simulasi dan Latihan: Jika ada kesempatan untuk mengikuti simulasi atau latihan sebelumnya, manfaatkan kesempatan tersebut untuk lebih siap.</li>
                                        </ul>
                                        <ul>Persiapan Logistik
                                            <li>Transportasi: Rencanakan transportasi ke lokasi diklat, apakah menggunakan kendaraan pribadi, transportasi umum, atau yang lainnya.</li>
                                            <li>Akomodasi: Jika diperlukan, cari tempat tinggal yang dekat dengan lokasi diklat atau tempat tinggal sementara.</li>
                                        </ul>
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
                                        Pendaftar yang ingin membatalkan pendaftaran diklatnya, bisa menghubungi admin. Pembayaran diklat yang sudah
                                        dilakukan tidak bisa dibatalkan, dengan kata lain tidak ada pengembalian dana.
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
                                        Sertifikat untuk diklat akan diserahkan secara offline dan ada di Website
                                        jika pendaftar telah melaksanakan diklat dan tuntas.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="bi bi-chevron-double-up"></i>
    </button>


        {{-- SCRIPT --}}
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
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
            document.addEventListener("DOMContentLoaded", function() {
                var totalPendaftarElement = document.getElementById("totalPendaftar");
                var jmlPendaftarBelumTerlaksanaElement = document.getElementById("jmlPendaftarBelumTerlaksana");
                var alumniElement = document.getElementById("alumni");
                var jmlDiklatElement = document.getElementById("jmlDiklat");
        
            // Fungsi untuk menghasilkan angka acak antara min dan max
            function getRandomNumber(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }
        
            // Fungsi untuk menampilkan animasi angka acak selama beberapa detik
            function animateRandomNumber(element, initialValue, finalValue) {
                var currentValue = initialValue;
                var interval = setInterval(function () {
                    var nextValue = getRandomNumber(currentValue, finalValue);
                        element.textContent = nextValue;
                        currentValue = nextValue;
                        if (currentValue === finalValue) {
                            clearInterval(interval);
                        }

                }, 100); // Perbarui angka setiap 100ms
            }
        
            // Jalankan animasi untuk pendaftar dan diklat
            animateRandomNumber(totalPendaftarElement, 0, {{ $totalPendaftar }});
            animateRandomNumber(jmlPendaftarBelumTerlaksanaElement, 0, {{ $jmlPendaftarBelumTerlaksana }});
            animateRandomNumber(alumniElement, 0, {{ $alumni }});
            animateRandomNumber(jmlDiklatElement, 0, {{ $jmlDiklat }});
        });
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


        {{-- Script Animasi --}}
        {{-- <script>

            let valueDisplays = document.querySelectorAll(".num-animasi");
            let interval = 4000;
        
            valueDisplays.forEach((valueDisplay) => {
                let startValue = 0;
                let endValue = parseInt(valueDisplay.getAttribute("data-val"));
                if (endValue === 0) {
                    valueDisplay.textContent = "0";
                    return;
                }
        
                let duration = Math.floor(interval / endValue);
                let counter = setInterval(function () {
                    startValue += 1;
                    valueDisplay.textContent = startValue;
                    if (startValue === endValue) {
                        clearInterval(counter);
                    }
                }, duration);
            });
        </script> --}}


            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Fungsi untuk menghasilkan angka acak antara min dan max
                    function getRandomNumber(min, max) {
                        return Math.floor(Math.random() * (max - min + 1)) + min;
                    }

                    // Fungsi untuk menampilkan animasi angka acak selama beberapa detik
                    function animateRandomNumber(element, finalValue) {
                        if (!element) {
                            console.error("Element not found!");
                            return; // Pastikan elemen tidak null
                        }

                        if (finalValue === 0) {
                            console.log("Skipping element with final value 0");
                            element.textContent = "-"; // Set the element's textContent to "-" instead of 0
                            return; // Skip animasi jika nilai akhirnya 0
                        }

                        var currentValue = 0;

                        var interval = setInterval(function () {
                            var nextValue = getRandomNumber(currentValue, finalValue);
                            element.textContent = nextValue;
                            currentValue = nextValue;
                            if (currentValue >= finalValue) {
                                clearInterval(interval);
                                element.textContent = finalValue; // Pastikan nilai akhir di set
                            }
                        }, 50); // Perbarui angka setiap 50ms untuk kecepatan animasi yang lebih cepat
                    }

                    // Ambil semua elemen dengan kelas num-animasi
                    var numAnimasiElements = document.querySelectorAll(".num-animasi");

                    // Jalankan animasi untuk setiap elemen num-animasi jika nilai lebih dari 0
                    numAnimasiElements.forEach(function(element) {
                        var finalValue = parseInt(element.getAttribute("data-val"), 10);
                        animateRandomNumber(element, finalValue);
                    });
                });


            </script>

        {{-- Script Slider Kategori Diklat --}}
        <!-- Swiper JS -->
        <script src="js/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".slide-content", {
                slidesPerView: 3,
                spaceBetween: 25,
                loop: true,
                centerSlide: 'true',
                fade: 'true',
                grabCursor: 'true',
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },

                breakpoints:{
                    0: {
                        slidesPerView: 1,
                    },
                    520: {
                        slidesPerView: 2,
                    },
                    950: {
                        slidesPerView: 3,
                    },
                },
            });
        </script>

        {{-- Script Testimoni --}}
        <script>
            $('.testimonials-container').owlCarousel({
                loop:true,
                autoplay:true,
                autoplayTimeout:6000,
                margin:10,
                nav:true,
                // navText:["<i class='fa-solid fa-arrow-left'></i>",
                //         "<i class='fa-solid fa-arrow-right'></i>"],
                responsive:{
                    0:{
                        items:1,
                        nav:false
                    },
                    600:{
                        items:1,
                        nav:true
                    },
                    768:{
                        items:2
                    },
                }
            });

        //     $('.testimonials-container').owlCarousel({
        //         loop: false,
        //         autoplay: false,
        //         margin: 10,
        //         nav: true,
        //         navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
        //         responsive: {
        //             0: {
        //                 items: 1,
        //                 nav: false
        //             },
        //             600: {
        //                 items: 1,
        //                 nav: true
        //             },
        //             768: {
        //                 items: 2,
        //                 nav: true
        //             }
        //         }
        //     });
        // </script>
@endsection