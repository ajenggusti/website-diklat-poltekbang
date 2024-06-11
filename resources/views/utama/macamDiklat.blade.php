@extends('layout/mainUser')
@section('title', 'DIKLAT ' . $diklatOne->kategori_diklat)
@section('container')
    <link href="/css/macamDiklat.css" rel="stylesheet">

    <div class="diklat-content">
        @if (count($diklat) != 0 )
            <div class="diklat-land swiper">
                <h2>PROGRAM {{ $diklatOne->kategori_diklat }}</h2><br>
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">
                        @foreach ($diklat as $perdiklat)
                            <div class="card swiper-slide">
                                <div class="image-content">
                                    <div class="card-image">
                                        @if ($perdiklat->gambar)
                                            <img src="{{ asset('storage/' . $perdiklat->gambar) }}" alt="" class="card-img">
                                        @else
                                            @php $foundDefault = false; @endphp
                                            @foreach ($allDiklat as $data)
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
                                    <h6 class="judul-detail" style="text-align: center">{{ $perdiklat->nama_diklat }}</h6>
                                    <p style="text-align: left;">
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
                                    <button class="button" onclick="window.location.href='/utama/detailDiklat/{{ $perdiklat -> id}}'">
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div> 
                </div>
                <div class="swiper-button-next swiper-navBtn"></div>
                <div class="swiper-button-prev swiper-navBtn"></div>
                <div class="swiper-pagination"></div>
            </div>  

            <button class="button see-all" onclick="toggleAllDiklat()">See All</button>

            <div class="all-diklat-content" id="all-diklat-content" style="display: none;">
                <h2>All Programs</h2>
                <div class="all-diklat-wrapper">
                    @foreach ($diklat as $perdiklat)
                        <div class="card">
                            <div class="image-content">
                                <div class="card-image">
                                    @if ($perdiklat->gambar)
                                        <img src="{{ asset('storage/' . $perdiklat->gambar) }}" alt="" class="card-img">
                                    @else
                                        @php $foundDefault = false; @endphp
                                        @foreach ($allDiklat as $data)
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
                                <h6 class="judul-detail" style="text-align: center">{{ $perdiklat->nama_diklat }}</h6>
                                <p style="text-align: left;">
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
                                <button class="button" onclick="window.location.href='/utama/detailDiklat/{{ $perdiklat -> id}}'">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center no-found">
                <img src="{{ asset('img/search.png') }}" alt="data not found">
                <h2>Ups!!Tidak ada program yang tersedia</h2>
                <a href="/">Back to previous</a>
            </div>
        @endif 
    </div>

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

        function toggleAllDiklat() {
            var allDiklatContent = document.getElementById("all-diklat-content");
            if (allDiklatContent.style.display === "none") {
                allDiklatContent.style.display = "block";
            } else {
                allDiklatContent.style.display = "none";
            }
        }
    </script>
@endsection
