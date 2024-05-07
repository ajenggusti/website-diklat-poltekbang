<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Boostrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/navbar.css" rel="stylesheet">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    {{-- <script type="text/javascript"
    src="https://app.stg.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script> --}}
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="/js/landing.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Diklat POLTEKBANG</title>

    <style>
      body {
          font-family: 'Poppins', sans-serif;
      }
  
    </style>
  </head>
  <body>
    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> --}}
        <div class="container">
            
            {{-- <div class="collapse navbar-collapse" id="navbarTogglerDemo01"> --}}
                <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between ">
                    <div class="col-md-3 mb-2 mb-md-0">
                        <a class="navbar-brand d-inline-flex link-body-emphasis text-decoration-none" href="/">
                            <img src="{{ asset('img/poltek.png') }}" alt="politeknik" width="60px">
                        </a>
                    </div>
                    {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button> --}}
                    <div class="topnav" id="navbarSupportedContent">
                        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                            <li class="nav-item">
                                <a class="nav-link px-2 justify-content-center" aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2 justify-content-center" href="#promo">Promo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2 justify-content-center" href="#katDiklat">Diklat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2 justify-content-center" href="#testimoni">Testimoni</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2 justify-content-center" href="#faq">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2 justify-content-center" href="#profile">Profile</a>
                            </li>
                            
                        </ul>
                    </div>
                    
                        @auth
                            
                            <div class="dropdown text-end">
                                <a href="#" class="d-block link-body-emphasis text-decoration-non" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                                    <span style="pointer-events: none; color:rgb(132, 132, 132);"> {{ auth()->user()->name }}</span>
                                    <i class="bi bi-person-circle" style="font-size: 25px; color: #FF6900"></i>
                                </a>
                                <ul class="dropdown-menu text-small">
                                    <li><a class="dropdown-item" href="/riwayat"><i class="bi bi-clock-history"></i> Riwayat</a></li>
                                        {{-- <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0"> --}}
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
                                        {{-- </ul> --}}
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="/logout" method="POST">
                                            @csrf
                                            <a href="" class="dropdown-item"> <button type="submit" style="border: none; background-color:rgb(255, 255, 255);"><i class="bi bi-box-arrow-right"></i> Logout</button></a>
                                        </form>
                                        @else
                                            <div class="topnav-right">
                                                <a href="/login"><button type="button" class="button button-log">Masuk</button></a>
                                                <a href="/register"><button type="button" class="button button-sign">Daftar</button></a>
                                            </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        @endauth
                </header>  
        </div>    
        {{-- </div> --}}
    {{-- </nav> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  </body>    
</html>