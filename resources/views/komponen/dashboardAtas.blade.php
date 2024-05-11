<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      {{-- select2 --}}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css.dashboard.css" rel="stylesheet">
  </head>
  <body>
    
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">POLTEKBANG</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <form action="/logout" method="POST">
            @csrf
            <button type="submit" style="color: aliceblue" class="btn btn-outline-primary border-0">Logout</button>
          </form>
        </div>
      </div>
    </header>

    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column">
              {{-- sidebar --}}
              @can('superAdmin')    
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="dbSuperAdmin">
                  <span data-feather="home"></span>
                  Dashboard SuperAdmin
                </a>
              </li>
              @endcan

              @can('dpuk')
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/dbDpuk">
                  <span data-feather="home"></span>
                  Dashboard DPUK
                </a>
              </li>
              @endcan

              @can('keuangan')
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/dbKeuangan">
                  <span data-feather="home"></span>
                  Dashboard Keuangan
                </a>
              </li>
              @endcan
              <li class="nav-item">
                <a class="nav-link" href="/kelKatDiklat">
                  <span data-feather="layers"></span>
                  kelola kategori diklat
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/indexKelolaUser">
                  <span data-feather="layers"></span>
                  Kelola user
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/kelPromo">
                  <span data-feather="layers"></span>
                  Kelola Promo
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/gbrLandingPage">
                  <span data-feather="layers"></span>
                  kelola gmbr Landing Page
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/kelPembayaran">
                  <span data-feather="layers"></span>
                  kelola pembayaran
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/kelPendaftaran">
                  <span data-feather="layers"></span>
                  kelola pendaftaran
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="/kelGambarDiklat">
                  <span data-feather="layers"></span>
                  Kelola Gambar diklat
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/kelDiklat">
                  <span data-feather="layers"></span>
                  kelola diklat
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/kelTestimoni">
                  <span data-feather="layers"></span>
                  kelola testimoni
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="layers"></span>
                  Laporan
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/kelKalender">
                  <span data-feather="layers"></span>
                  Kalender
                </a>
              </li>
            </ul>
          </div>
        </nav>
        {{-- isi konten ada di dalam main --}}
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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

          
