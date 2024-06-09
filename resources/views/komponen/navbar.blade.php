<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    {{-- Boostrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    {{-- <script type="text/javascript"
    src="https://app.stg.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script> --}}
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- select2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    {{-- Script Js --}}
    <script src="/js/landing.js"></script>
    <!-- Bootstrap CSS -->

    {{-- Landing BOOTSTRAP --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    {{--  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    {{-- <link rel="icon" type="image/png" href="{{ asset('img/poltek.png') }}"> --}}
    <title>
      PENDAFTARAN DIKLAT POLTEKBANG
    </title>

    <style>
        * {
            box-sizing: border-box;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .content-wrapper {
            flex: 1;
            padding-top: 100px;
        }

        .content-nav {
            background-color: rgb(248, 100, 20);
            height: 100px;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1000;
            transition: background-color 0.3s, color 0.3s;
        }
        .content-nav .topnav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding-top: 20px;
        }
        
        .navbar-toggler {
            font-size: 24px; 
            font-weight: bold;
            /* background-color: #ff964a; */
            color: rgb(0, 18, 183);
        }

        .content-nav .navbar-brand img {
            width: 85px;
            margin-left: 110px;
            padding-bottom: 2px;
            transition: filter 0.3s;
        }

        .content-nav .navbar-nav.centerNav {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content-nav .text-end {
            margin-right: 50px;
        }

        .content-nav .navbar-nav .nav-item {
            margin: 0 10px;
        }

        .content-nav .navbar-nav .nav-item .nav-link {
            padding-right: 15px;
            padding-top: 5px;
            color: #ffffff;
            font-weight: bolder;
            transition: color 0.3s;
        }

        .content-nav .navbar-nav .nav-item .nav-link:hover {
            color: rgb(0,27,180);
        }

        .content-nav .navbar-nav.ms-auto.rightNav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-right: 100px;
        }

        .content-nav .rightNav .buttonRight {
            top: 0;
        }

        .button-nav {
            border: none;
            text-decoration: none;
            cursor: pointer;
            background-color: #dfdddd00;
        }

        .button-nav:hover {
            border: none;
            text-decoration: none;
            background-color:rgba(255, 255, 255, 0);
        }

        .button-log {
            background-color: rgb(0,27,180); 
            color: #ffffff; 
            padding: 6px 16px;
            text-align: center;
            text-decoration: none;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .button-log:hover {
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.6);
            color: rgb(255, 255, 255);
        }
        
        .sticky {
            background-color: rgba(255, 255, 255, 0.901) !important;
            color: rgb(0,27,180) !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .sticky .navbar-nav .nav-link {
            color: rgb(0,27,180) !important;
        }

        .sticky .navbar-nav .nav-link:hover {
            color: rgb(0,27,180) !important;
        }


        @media (max-width: 480px) {
            .content-nav .navbar-brand img {
                width: 60px;
                margin-left: 20px;
                padding-bottom: 2px;
                transition: filter 0.3s;
            }
            .content-nav .navbar-collapse {
                background-color: rgba(255, 221, 202, 0.812);
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 1000;
                display: none;
            }
            .navbar-toggler i{
                font-size: 30px;
            }
            .content-nav .navbar-collapse.show {
                display: block;
            }
            .content-nav .navbar-nav {
                display: block !important;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            .content-nav .navbar-nav .nav-item {
                margin: 0;
                text-align: center;
            }
            .content-nav .navbar-nav .nav-item .nav-link {
                padding: 10px 15px;
                color: #FF6900;
            }

            .content-nav .navbar-nav .nav-item .nav-link:hover {
                color: rgb(0,27,180);
            }
        }

        /* Layar untuk 481px - 900px */
        @media screen and (min-width: 481px) and (max-width: 900px) {
            .content-nav .navbar-brand img {
                width: 80px;
                margin-left: 40px;
                padding-bottom: 2px;
                transition: filter 0.3s;
            }
            .content-nav .navbar-collapse {
                background-color: rgba(255, 221, 202, 0.812);
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 1000;
                display: none;
            }
            .navbar-toggler i{
                font-size: 40px;
                margin-right: 40px;
            }
            .content-nav .navbar-collapse.show {
                display: block;
            }
            .content-nav .navbar-nav {
                display: block !important;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            .content-nav .navbar-nav .nav-item {
                margin: 0;
                text-align: center;
            }
            .content-nav .navbar-nav .nav-item .nav-link {
                padding: 10px 15px;
                color: #FF6900;
            }

            .content-nav .navbar-nav .nav-item .nav-link:hover {
                color: rgb(0,27,180);
            }
        }
  
    </style>
  </head>
  <body>
    
        <div class="content-nav" id="navbar">
            <nav class="navbar navbar-expand-lg topnav" >
                <a href="/" class="navbar-brand">
                    <img src="{{ asset('img/poltek.png') }}" alt="politeknik">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown" >
                    <ul class="navbar-nav me-auto centerNav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#promo">Promo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#katDiklat">Diklat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#testimoni">Testimoni</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#faq">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="eventsUser">Jadwal</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto rightNav">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="d-block link-body-emphasis text-decoration-non nav-link" href="#" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                                    <i class="bi bi-person-circle">
                                        <span style="pointer-events: none;">    {{ auth()->user()->name }}</span>
                                    </i>
                                </a>
                                <ul class="dropdown-menu text-small">
                                    <li><a class="dropdown-item" href="/editProfil"><i class="bi bi-people"></i> Profil</a></li>
                                    <li><a class="dropdown-item" href="/riwayat"><i class="bi bi-clock-history"></i> Riwayat</a></li>
                                    <li>
                                        @can('superAdmin')
                                            <a href="/dbSuperAdmin" class="dropdown-item"><i class="bi bi-speedometer2"></i> Dashboard</a>
                                        @endcan
                                        @can('dpuk')
                                            <a href="/dbDpuk" class="dropdown-item"><i class="bi bi-speedometer2"></i> Dashboard</a>
                                        @endcan
                                        @can('keuangan')
                                            <a href="/dbKeuangan" class="dropdown-item"><i class="bi bi-speedometer2"></i> Dashboard</a>
                                        @endcan
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="/logout" method="POST">
                                            @csrf
                                            <a href="" class="dropdown-item"> <button class="button-nav" type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button></a>
                                        </form>
                                        @else
                                            <div class="buttonRight">
                                                <a href="/login"><button type="button" class="button-log">Masuk</button></a>
                                            </div>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div> 
        <script>
            window.onscroll = function() {
                myFunction();
            };

            function myFunction() {
                var navbar = document.getElementById("navbar");
                if (window.pageYOffset > 50) {
                    navbar.classList.add("sticky");
                } else {
                    navbar.classList.remove("sticky");
                }
            }
        </script>
        <script>
            const body = document.querySelector("body"),
                nav = document.querySelector("nav"),
                modeToggle = document.querySelector(".dark-light"),
                searchToggle = document.querySelector(".searchToggle"),
                sidebarOpen = document.querySelector(".sidebarOpen"),
                siderbarClose = document.querySelector(".siderbarClose");
                        //   js code to toggle sidebar
                    sidebarOpen.addEventListener("click" , () =>{
                        nav.classList.add("active");
                    });

                    body.addEventListener("click" , e =>{
                        let clickedElm = e.target;

                        if(!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("navbar-collapse")){
                            nav.classList.remove("active");
                        }
                    });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
        {{-- <div class="page-container"> --}}
            <div class="content-wrapper">