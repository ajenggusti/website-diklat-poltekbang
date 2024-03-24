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
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <main class="form-signin">
        <form method="POST" action="/register">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Registrasi</h1>
            <div class="form-floating">
                <input name="namaPengguna" type="text" class="form-control @error('namaPengguna') is-invalid @enderror" id="namaPengguna" placeholder="namaPengguna address">
                <label for="namaPengguna">nama pengguna</label>
                @error('namaPengguna')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating">
                <input name="email" type="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Email address">
                <label for="email">Email address</label>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control  @error('password') is-invalid @enderror"" id="password" placeholder="Password">
                <label for="password">Password</label>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">register</button>
            <small>Sudah punya akun? <a href="/login">Login disini.</a></small>
        </form>
    </main>
  </body>
</html>
