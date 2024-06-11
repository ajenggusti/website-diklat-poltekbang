<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <title>Registrasi | Courses List Poltekbang Surabaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="/css/signin.css" rel="stylesheet">
    <script src="/js/signin.js"></script>
</head>
<body>
<main class="form-signin text-center">
    <div class="topCenter">
        <img src="{{ asset('img/poltek.png') }}" alt="">
        <h5>POLTEKBANG SURABAYA</h5>
    </div>
    <form method="POST" action="/register" class="form-content">
        @csrf
        <h3>Registrasi</h3>
        <div class="form-floating">
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Email" value="">
            <label for="email">Email Address</label>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter Password" value="">
            <button class="btn eye" type="button" id="togglePassword">
                <i class="bi bi-eye-slash eye-icon"></i>
            </button>
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-floating">
            <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Verify Password" value="">
            <button class="btn eye" type="button" id="togglePasswordConfirm">
                <i class="bi bi-eye-slash eye-icon"></i>
            </button>
            <label for="password_confirmation">Verify Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-secondary" type="submit">Register</button>
        <br> <br>
        <div class="p-login">
            <p>Sudah punya akun? <a href="/login" class="btn">Login disini</a></p>
        </div>
    </form>
    <div class="bottomCenter">
        <p>@poltekbang sby</p>
    </div>
</main>
</body>
</html>
