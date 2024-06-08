<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    {{-- <link rel="icon" type="image/png" href="{{ asset('img/poltek.png') }}"> --}}
    <title>
      Dashboard Staff
    </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- select2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    {{-- fulcalendar --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Boostrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- DASHBOARD STAFF WITH ADMINLTE --}}
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    {{-- Navbar --}}
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
      .container {
        /* padding-bottom: 50px;
        padding-top: 50px; */
      }
    </style>
    
    <script src="/js/dashboard.js"></script>
    <link href="/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="sidebar close">
      <header>
        <div class="image-text">
          <span class="image">
            <a href="/">
              <img src="{{ asset('img/poltek.png') }}" alt="Logo poltekbang">
            </a>
          </span>

          <div class="text header-text">
            <span class="name">POLTEKBANG</span>
          </div>
        </div>
        <i class="fas fa-greater-than toggle"></i>
      </header>

      <div class="menu-bar">
        <div class="menu">

          <ul class="menu-links">
            @can('superAdmin')
            <li class="nav-link">
                <a href="/dbSuperAdmin">
                  <i class="fas fa-house-user icon"></i>
                  <span class="text nav-text">Dashboard</span>
                </a>
            </li>
            @endcan

            @can('dpuk')
            <li class="nav-link">
              <a href="/dbDpuk">
                <i class="fas fa-house-user icon"></i>
                <span class="text nav-text">Dashboard</span>
              </a>
            </li>
            @endcan
                        
            @can('keuangan')
            <li class="nav-link">
              <a href="/dbKeuangan">
                <i class="fas fa-house-user icon"></i>
                <span class="text nav-text">Dashboard</span>
              </a>
            </li>
            @endcan
                     
            <li class="nav-link">
              <a href="/indexKelolaUser">
                <i class="fas fa-users icon"></i>
                <span class="text nav-text">User</span>
              </a>
            </li>

            <li class="nav-link">
              <a href="/kelPromo">
                <i class="fas fa-tags icon"></i>
                <span class="text nav-text">Promo</span>
              </a>
            </li>
                        
            <li class="nav-link">
              <a href="/kelTestimoni">
                <i class="fas fa-envelope-open-text icon"></i>
                <span class="text nav-text">Testimoni</span>
              </a>
            </li>

            <li class="nav-link">
              <a href="/kelKatDiklat">
                <i class="fas fa-envelope-open-text icon"></i>
                <span class="text nav-text">Kategori Diklat</span>
              </a>
            </li>
                       
            <li class="nav-link">
              <a href="/kelDiklat">
                <i class="fas fa-envelope-open-text icon"></i>
                <span class="text nav-text">Diklat</span>
              </a>
            </li>
                    
            <li class="nav-link">
              <a href="/kelPendaftaran">
                <i class="fas fa-envelope-open-text icon"></i>
                <span class="text nav-text">Pendaftaran(dpuk)</span>
              </a>
            </li>
                       
            <li class="nav-link">
              <a href="/kelPendaftaranKeuangan">
                <i class="fas fa-envelope-open-text icon"></i>
                <span class="text nav-text">Pendaftaran(keuangan)</span>
              </a>
            </li>
                       
            <li class="nav-link">
              <a href="/events">
                <i class="fas fa-calendar-week icon"></i>
                <span class="text nav-text">Kalender</span>
              </a>
            </li>     
            
            <li class="nav-link">
              <a href="/kelPembayaran">
                <i class="fas fa-file-invoice icon"></i>
                <span class="text nav-text">Laporan</span>
              </a>
            </li> 
                        
            <li class="nav-link">
              <a href="/logActivity">
                <i class="fas fa-clipboard-list icon"></i>
                <span class="text nav-text">Log activity</span>
              </a>
            </li>      
          </ul>
        </div>
      
      
        <div class="bottom-content">
          <li class="nav-link2">
            <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="btn" style="border: none; text-decoration: none;">
                <i class="bi bi-box-arrow-right icons"></i>
                <span class="text nav-text">Logout</span>
              </button>
            </form>
          </li>
          
        </div>
      </div>
    </nav>

   
    <script>
      const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");


      toggle.addEventListener("click" , () =>{
          sidebar.classList.toggle("close");
      })

      searchBtn.addEventListener("click" , () =>{
          sidebar.classList.remove("close");
      })

      modeSwitch.addEventListener("click" , () =>{
          body.classList.toggle("dark");
          
          if(body.classList.contains("dark")){
              modeText.innerText = "Light mode";
          }else{
              modeText.innerText = "Dark mode";
              
          }
      });
    </script>


    {{-- <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> --}}
      {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom container-fluid">
        
      </div> --}}
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      {{-- OLD --}}
      <script>
        $(document).ready(function() {
          var path = window.location.pathname;
        
          $('#sidebarMenu .nav-link').each(function () {
            var href = $(this).attr('href');
            // console.log("path:", path);
            // console.log("href:", href);
            if (path === href) {
              $(this).addClass('active');
            }
          });
        });
      </script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
          $(document).ready(function() {
              var path = window.location.pathname;
              $('.nav-link').each(function () {
                  var href = $(this).attr('href');
                  // console.log("path:", path);
                  // console.log("href:", href);
                  if (path.includes(href)) {
                      $(this).addClass('active');
                  }
              });
          });
      </script>
      
      {{-- <div class="container home"> --}}
        
    <section class="home">
      <div class="container text">
