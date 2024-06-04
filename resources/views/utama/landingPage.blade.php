@extends('layout/mainUser')
@section('container')
    <link href="/css/landing.css" rel="stylesheet">
    <link href="/css/landTestimoni.css" rel="stylesheet">
    <link href="/css/landKatDiklat.css" rel="stylesheet">
    <script src="/js/landing.js"></script>

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
        <br>
        
        <div class="content-land">
            <div class="land-width">
                <div class="bg-land">
                    <div class="card-group">
                        <div class="animated-card">
                                <div class="card-body" >
                                    <img src="{{ asset('img/poltek.png') }}" alt="">
                                </div>
                                <div class="card-body" >
                                    <span class="card-title animated-text" id="totalPendaftar">{{ $totalPendaftar }}</span><br>
                                    <span class="card-text animated-text">Total Seluruh Pendaftar</span>
                                    <br>
                                    <span class="card-title animated-text" id="jmlPendaftarBelumTerlaksana">{{ $jmlPendaftarBelumTerlaksana }}</span><br>
                                    <span class="card-text animated-text">Pendaftar Periode Ini</span>
                                    <br>
                                </div>
                                <div class="card-body" >
                                    <span class="card-title animated-text" id="alumni">{{ $alumni }}</span><br>
                                    <span class="card-text animated-text">Total Lulusan Diklat </span>
                                    <br>
                                    <span class="card-title animated-text" id="jmlDiklat">{{ $jmlDiklat }}</span><br>
                                    <span class="card-text animated-text">Total diklat saat ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="land-width">
                    <hr>
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
                    
                    
                    <hr>
                    <h3 id="katDiklat">Kategori Diklat</h3>
                    <p>Klik button untuk melihat lebih banyak diklat </p>
                    <div class="cards-container" >
                        @foreach ($katDiklat as $kategori)
                            <div class="card-jenis" style="background-color: rgb(255, 255, 255)">
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
                                <div class="card-content">
                                    <p>
                                        <span class="tittleKat">{{ $kategori->kategori_diklat }}</span><br>
                                    
                                        <br>
                                        <button class="button-link" onclick="window.location.href='/utama/macamDiklat/{{ $kategori->id }}'">
                                            Selengkapnya
                                        </button>
                                    </p>
                                </div>
                            </div>    
                        @endforeach
                    </div>

                
                    <hr>
                    @if ($countTestimoni!=0)
                        <h3 id="testimoni">Testimoni</h3>
                        <p>Simak apa kata mereka...</p>
                        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                            <div class="card-testi">
                                
                                <div class="carousel-inner">
                                    @foreach ($testimonis->chunk(3) as $index => $testimoniChunk)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <div class="d-flex justify-content-center flex-wrap">
                                                @foreach ($testimoniChunk as $testimoni)
                                                    <div class="card-testi2">
                                                        <div class="card-testiContent">
                                                            @if ($testimoni->id_pendaftaran)
                                                                <b class="author">{{ $testimoni->nama_dummy }}</b>
                                                                <b class="author">{{ $testimoni->profesi }}</b>
                                                                <p class="author">Alumni diklat {{ $testimoni->pendaftaran->diklat->nama_diklat }}</p>
                                                                <q>{{ $testimoni->testimoni }}</q>
                                                            @else
                                                                <b class="author">{{ $testimoni->nama_dummy }}</b>
                                                                <b class="author">{{ $testimoni->profesi }}</b>
                                                                <p class="author">Alumni diklat {{ $testimoni->diklat->nama_diklat }}</p>
                                                                <q>{{ $testimoni->testimoni }}</q>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @for ($i = $testimoniChunk->count(); $i < 3; $i++)
                                                    <div class="card-testi2 placeholder"></div>
                                                @endfor
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="color: black;"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="color: black;"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @endif
                    

                    <hr>
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

                            {{-- <div class="accordion-item">
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
                            </div> --}}

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                        Bagaimana kebijakan pembatalan atau pengembalian dana?
                                    </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        Pendaftar yang ingin membatalkan pendaftaran diklatnya dan
                                        sudah membayar, bisa menghubungi admin.
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



                    <hr>
                    <h3 id="profile">Profile</h3>
                    <p>Kepoin kita disini yukk...</p>
                    <div class="card-contact">
                        <iframe src="https://www.youtube.com/embed/SbMdkBNQoO8" class="responsive-iframe"></iframe>
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
@endsection