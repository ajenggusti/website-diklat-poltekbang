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
    <title>Dashboard Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

    <style>
      html, body {
        height: 100%
      }
      * {
        margin: 0;
        padding: 0;
        font-size: 15px;
      }
      body {
        font-family: 'Poppins', sans-serif;
    }
    .navbar-toogler  {
      margin-left: -100px;
    }

    </style>

    
    <script src="/js/dashboard.js"></script>
    <link href="/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/" style="font-size: 16px;">
          POLTEKBANG
      </a>
      
      {{-- <div class="header-left"> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        {{-- <div class="navbar-nav">
          <div class="nav-item text-nowrap">
            <form action="/logout" method="POST">
              @csrf
              <button type="submit" style="color: aliceblue" class="btn btn-outline-primary border-0">Logout</button>
            </form>
          </div>
        </div> --}}
      {{-- </div> --}}
    </header>

    <div class="container-fluid">
      <div class="row">
          <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block">
              <div class="position-sticky pt-3" id="sidebar-sticky">
                  <ul class="nav flex-column">
                    {{-- sidebar --}}
                      @can('superAdmin')
                      <hr>    
                      <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/dbSuperAdmin">
                          <i class="bi bi-house-door"></i>
                            Dashboard Super Admin
                        </a>
                      </li>
                      <hr> 
                      @endcan

                      @can('dpuk')
                      <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/dbDpuk">
                          <i class="bi bi-house-door"></i>
                          Dashboard DPUK
                        </a>
                      </li>
                      @endcan

                      @can('keuangan')
                      <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/dbKeuangan">
                          <i class="bi bi-house-door"></i>
                          Dashboard Keuangan
                        </a>
                      </li>
                      @endcan
                      <li class="nav-item">
                        <a class="nav-link {{ Request::is('indexKelolaUser*') ? 'active' : '' }}" href="/indexKelolaUser">
                          <i class="bi bi-people" style="font-size: 17px;">   </i>
                          Kelola User
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ Request::is('kelPromo*') ? 'active' : '' }}" href="/kelPromo">
                          <i class="bi bi-ticket" style="font-size: 17px;">   </i>
                          Kelola Promo
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ Request::is('kelTestimoni*') ? 'active' : '' }}" href="/kelTestimoni">
                          <i class="bi bi-file-earmark-post" style="font-size: 17px;">   </i>
                          Kelola Testimoni
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ Request::is('gbrLandingPage*') ? 'active' : '' }}" href="/gbrLandingPage">
                          <i class="bi bi-tablet-landscape" style="font-size: 17px;">   </i>
                          Kelola Gambar Landing Page
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ Request::is('kelKatDiklat*') ? 'active' : '' }}" href="/kelKatDiklat">
                          <i class="bi bi-journal-richtext" style="font-size: 17px;">   </i>
                            Kelola Kategori Diklat
                        </a>
                      </li>
                      <li class="nav-item {{ Request::is('kelDiklat*') ? 'active' : '' }}">
                        <a class="nav-link" href="/kelDiklat">
                          <i class="bi bi-file-earmark-richtext" style="font-size: 17px;">   </i>
                          Kelola Diklat
                        </a>
                      </li>
                      <li class="nav-item {{ Request::is('kelGambarDiklat*') ? 'active' : '' }}">
                        <a class="nav-link" href="/kelGambarDiklat">
                          <i class="bi bi-image" style="font-size: 17px;">   </i>
                          Kelola Gambar Diklat
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ Request::is('kelPendaftaran*') ? 'active' : '' }}" href="/kelPendaftaran">
                          <i class="bi bi-basket" style="font-size: 17px;">   </i>
                          Kelola Pendaftaran
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/events">
                          <i class="bi bi-calendar-event"></i>
                          Kalender
                        </a>
                      </li>
                      <li class="nav-item {{ Request::is('kelPembayaran*') ? 'active' : '' }}">
                        <a class="nav-link" href="/kelPembayaran">
                          <i class="bi bi-cash-stack" style="font-size: 17px;">   </i>
                          Laporan
                        </a>
                      </li>
                      <hr>
                      <li class="nav-item">
                        {{-- <a class="nav-link" href="/events"> --}}
                          {{-- <span data-feather="layers"> --}}
                            <form action="/logout" method="POST">
                              @csrf
                              <button type="submit" style="color: aliceblue" class="btn nav-link">
                                <i class="bi bi-box-arrow-right"></i> Logout
                              </button>
                            </form>
                            {{-- Logout --}}
                          </span>
                        </a>
                      </li>
                      <hr>
                    {{-- </div> --}}
                  </ul>
                {{-- </div> --}}
              </div>
            
          </nav>
        
        
        {{-- isi konten ada di dalam main --}}
        
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom container-fluid">
              {{-- <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                  <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                  </div>
                  <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <span data-feather="calendar"></span>
                    This week
                  </button>
                </div> --}}
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
              $(document).ready(function() {
                // Get the current URL path
                var path = window.location.pathname;
              
                // Find the corresponding link in the sidebar and add 'active' class
                $('#sidebarMenu .nav-link').each(function () {
                  var href = $(this).attr('href');
                  console.log("path:", path); // Tambahkan ini untuk debug
                  console.log("href:", href); // Tambahkan ini untuk debug
                  if (path === href) {
                    $(this).addClass('active');
                  }
                });
              });
            </script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    // Get the current URL path
                    var path = window.location.pathname;
                  
                    // Find the corresponding link in the navbar and add 'active' class
                    $('.nav-link').each(function () {
                        var href = $(this).attr('href');
                        console.log("path:", path); // Tambahkan ini untuk debug
                        console.log("href:", href); // Tambahkan ini untuk debug
                        if (path.includes(href)) {
                            $(this).addClass('active');
                        }
                    });
                });
            </script>

