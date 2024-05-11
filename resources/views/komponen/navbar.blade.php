<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    {{-- <script type="text/javascript"
    src="https://app.stg.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script> --}}
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

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
 
    <title>Hello, world!</title>
  </head>
  <body>
      {{-- navbar ini hanya kerangka --}}
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="/">poltekbang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Diklat</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Jadwal</a>
                </li>
              @auth
              <li class="nav-item">
                <a class="nav-link" href="/editProfil">Profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/riwayat">Riwayat</a>
              </li>
              @can('superAdmin')
              <li class="nav-item">
                <a class="nav-link" href="/dbSuperAdmin">Dashboard Super Admin</a>
              </li>
              @endcan

              @can('dpuk')
              <li class="nav-item">
                <a class="nav-link" href="/dbDpuk">Dashboard DPUK</a>
              </li>
              @endcan

              @can('keuangan')
              <li class="nav-item">
                <a class="nav-link" href="/dbKeuangan">Dashboard Keuangan</a>
              </li>
              @endcan

            </ul>
            <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="btn btn-outline-primary">Logout</button>
            </form>
              
              @else    
              <a href="/login"><button type="button" class="btn btn-outline-primary">masuk</button></a>
              <a href="/register"><button type="button" class="btn btn-outline-primary">daftar</button></a>
              @endauth
              
              
            </div>
          </div>
      </nav>
      
