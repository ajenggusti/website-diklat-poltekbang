<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    {{-- <link rel="icon" type="image/png" href="{{ asset('img/poltek.png') }}"> --}}
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- Boostrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/login.css" rel="stylesheet">
    <script src="/js/signin.js"></script>
  </head>
  <body>
    <br><br>
    {{-- <img src="{{ asset('img/poltek.png') }}" style="width: 30px; height: 20px;"> --}}
    <main class="form-signin text-center">
      <div class="topCenter">
        <img src="{{ asset('img/poltek.png') }}" alt="" >
        <h6>POLTEKBANG SURABAYA</h6>
      </div>
      <form method="POST" action="{{ route('login') }}" class="form-content">
        @csrf
        <h3>Login</h3>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif        
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif        
        <div class="form-floating">
          <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address" value="">
          <label for="email">Email Address</label>
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-floating">
          <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" value="">
          <button class="btn eye" type="button" id="togglePassword2">
            <i class="bi bi-eye-slash" id="eye-icon"></i>
          </button>
          <label for="floatingPassword">Password</label>
          <span class="forget-pw">Lupa password?<a href="/forgot-password" class="btn lupa-pw2">Klik disini</a></span>
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        <div class="divider">
          <span>atau</span>
        </div>
        <a class="w-100 btn btn-lg btn-secondary" href="/google/redirect"><i class="bi bi-google"></i> Login dengan google</a>
        <br> <br>
        <div class="p-login">
          <p style="text-align: center; margin-bottom: 0;">Belum punya akun?<a href="/register" class="btn"> Daftar sekarang</a></p>
          
        </div>
        
        
        
      </form>
      <div class="bottomCenter">
        <p>@poltekbang sby</p>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
