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

    <script src="/js/landing.js"></script>
    <!-- Bootstrap CSS -->

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Diklat POLTEKBANG</title>

    <style>
      body {
          font-family: 'Poppins', sans-serif;
      }
  
    </style>
  </head>
  <body>
        <div class="content-nav">
            <header class="d-flex flex-wrap align-items-center justify-content-between ">
                <div class="col-md-3 mb-2 mb-md-0">
                    <a class="navbar-brand d-inline-flex link-body-emphasis text-decoration-none" href="/">
                        <img src="{{ asset('img/poltek.png') }}" alt="politeknik" style="width: 60px;">
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list" style="color: aqua"></i>
                </button>

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
                            <i class="bi bi-person-circle" style="font-size: 25px; color: #FF6900">
                                <span style="pointer-events: none;"> {{ auth()->user()->name }}</span>
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
    <script>
        window.onscroll = function() {myFunction()};
    
        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;
    
        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  </body>    
</html>
