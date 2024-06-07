<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- Boostrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">
    <script src="/js/signin.js"></script>
  </head>
  <body>
    <main class="form-signin text-center">
      <div class="topCenter">
        <img src="{{ asset('img/poltek.png') }}" alt="" >
        <h5>POLTEKBANG SURABAYA</h5>
      </div>
        <form method="POST" action="/register" class="form-content">
          @csrf
          <h3>Daftar Akun</h3>
          <div class="form-floating">
              <input name="namaPengguna" type="text" class="form-control @error('namaPengguna') is-invalid @enderror" id="namaPengguna" placeholder="Enter Username" value="">
              <label for="namaPengguna">Username</label>
              @error('namaPengguna')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
          <div class="form-floating">
              <input name="email" type="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Enter Email" value="">
              <label for="email">Email Address</label>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
          <div class="form-floating">
              <input name="password" type="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Enter Password" value="">
              <button class="btn" type="button" id="togglePassword">
                <i class="bi bi-eye-slash" id="eye-icon"></i>
              </button>
              <label for="password">Password</label>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
          <button class="w-100 btn btn-lg btn-secondary" type="submit">Register</button>
          <br> <br>
          <div class="p-login">
            <p>Sudah punya akun? <a href="/login" class="btn">Login disini</a></p>
          </div>
        </form>
      {{-- </div> --}}
      <div class="bottomCenter">
        <p>@poltekbang sby</p>
      </div>
    </main>
  </body>
</html>
