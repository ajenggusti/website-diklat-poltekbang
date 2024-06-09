@extends('layout.mainAdmin')
@section('container')
    {{-- Head --}}
    <link href="/css/staff.css" rel="stylesheet">
    
    {{-- Body --}}
    {{-- ================ini adalah chart dpuk========================= --}}
    <div class="container px-4 mx-auto">

      <form method="GET" action="{{ url('/dbDpuk') }}" class="form-container">
          <label for="year">Select Year:</label>
          <select name="year" id="year" onchange="this.form.submit()">
              @for($y = date('Y'); $y >= 2000; $y--)
                  <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
              @endfor
          </select>
      </form>
  
      <div class="p-6 m-20 bg-white rounded shadow">
          {!! $DpukPendaftarChart->container() !!}
      </div>
    </div>

    <hr>
    <div class="rows text">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $totalSemua }}</h3>

              <p>Jumlah seluruh pendaftar diklat</p>
            </div>
            <div class="icon">
              <i class="bi bi-person"></i>
            </div>
            <a href="/kelPendaftaran" class="small-box-footer">More info <i class="bi bi-arrow-right-circle-fill"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $sertifikat }}</h3>

              <p>Jumlah peserta yang memerlukan sertifikat</p>
            </div>
            <div class="icon">
                <i class="bi bi-award"></i>
            </div>
            <a href="/perluSertifikat" class="small-box-footer">More info <i class="bi bi-arrow-right-circle-fill"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $alumni }}</h3>

              <p>Jumlah Seluruh Lulusan Diklat</p>
            </div>
            <div class="icon">
                <i class="bi bi-mortarboard"></i>
            </div>
            <a href="/PendaftaranTerlaksana" class="small-box-footer">More info <i class="bi bi-arrow-right-circle-fill"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $jumlahBelumTerlaksana }}</h3>

              <p>Jumlah pendaftaran yang belum terlaksana</p>
            </div>
            <div class="icon">
              <i class="bi bi-person-dash"></i>
            </div>
            <a href="/PendaftaranBelumTerlaksana" class="small-box-footer">More info <i class="bi bi-arrow-right-circle-fill"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        @foreach($pendaftarans as $pendaftaran)
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $pendaftaran->total_pendaftar }}</h3>
    
                    <p>Jumlah pendaftar diklat {{ $pendaftaran->diklat->nama_diklat }}</p>
                </div>
                <div class="icon">
                  <i class="bi bi-clipboard-data"></i>
                </div>
                <a href="/PendaftaranBelumTerlaksana" class="small-box-footer">More info <i class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
        @endforeach
          <!-- ./col -->
    </div>

    

    <script src="{{ $DpukPendaftarChart->cdn() }}"></script>

    {{ $DpukPendaftarChart->script() }}
@endsection
