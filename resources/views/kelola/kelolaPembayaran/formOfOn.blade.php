@extends('layout.mainUser')
@section('container')
<html>
    <head>
        <!-- Custom styles for this template -->
        <link href="/css/actor.css" rel="stylesheet">
        {{-- Boostrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        {{-- Font Poppins --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
            

        </style>
    </head>
    <body>
      <div class="content">
        <div class="bg-nota">
          
          <div class="edit-user">
            {{-- OLD 
              <h1>Form Pembayaran Diklat</h1>
              <a href="{{ route('kelPembayaranDiklat.saveDiklat', ['id' => $pendaftaran->id]) }}" class="btn btn-secondary">Pembayaran Online</a>
              <br>
              <small class="text-muted">Klik "pembayaran online" jika kamu ingin membayarnya secara online.</small>
              <br> --}}
              <h2>Metode Pembayaran Diklat</h2>
              <hr>
              <span>Silahkan pilih metode pembayaran:</span><br>
              
              {{-- button pembayaran online --}}
              <div class="metode-bayar">
                  <form id="hiddenFormDiklat" method="POST" action="{{ route('kelPembayaranDiklat.saveDiklat') }}">
                      @csrf
                      <input type="hidden" name="id" value="{{ $pendaftaran->id }}">
                  </form>
                  <a href="#" onclick="submitForm()" class="btn btn-secondary" style="width: 200px; background-color:#4CAF50;">Pembayaran Online</a>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="width: 200px; background-color:#008CBA;">
                      Pembayaran Offline
                  </button>
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif
                  <br>
              </div>
              <span class="text-muted" style="color: red;">Klik "pembayaran online" jika kamu ingin membayarnya secara online.</span>
              <p class="text-muted">Pembayaran Offline hanya bisa dilakukan jika sudah menemui Admin</p>
            

              <!-- Modal -->
              <div class="modal-pop">
                  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Pembayaran Offline</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <small>Silahkan datang untuk melakukan pembayaran offline dengan admin keuangan!</small>
                          <form action="/kelPembayaranDiklat-store/{{ $pendaftaran->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                              <img class="img-preview img-fluid" style="width: 550px;">
                              <br> <br>
                              <input name="bukti_pembayaran" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
                              <small>Masukkan bukti pembayaran yang telah disepakati dengan admin keuangan.</small>
                              @error('img')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                        </div>
                              
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                      </form>
                      </div>
                      <br>
                    </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
        
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>
  function submitForm() {
      document.getElementById('hiddenFormDiklat').submit();
  }
</script>
@endsection
