<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- Boostrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">
    <script src="/js/signin.js"></script>
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form method="POST" action="{{ route('login') }}" class="form-content">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Login</h1>
        <p>
          Selamat datang di website diklat Politeknik
          Penerbangan. Silahkan login untuk bisa mendaftar
          diklat.
        </p>
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
          <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Email" value="">
          <label for="email">Email address</label>
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-floating">
          <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Enter Password" value="">
          <button class="btn" type="button" id="togglePassword2">
            <i class="bi bi-eye-slash" id="eye-icon"></i>
          </button>
          <label for="floatingPassword">Password</label>
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        <br> <br>
        <small>Belum punya akun? <a href="/register">Register now</a></small>
      </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
