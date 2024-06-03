@extends('layout.mainAdmin')
@section('container')
    <link href="/css/dashboard.css" rel="stylesheet">

    <div class="container-admin">
        <div class="row">
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $getBayarDiklat }}</h3>

                    <p>Pelunasan Biaya Diklat</p>
                </div>
                <div class="icon">
                    <i class="bi bi-card-checklist"></i>
                </div>
                <a href="/dbDetailPembayaranDiklat" class="small-box-footer">More info <i class="bi bi-arrow-right-circle-fill"></i></a>
            </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $getBayarPendaftaran }}</h3>
        
                        <p>Pelunasan Biaya Pendaftaran</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-card-checklist"></i>
                    </div>
                    <a href="/dbDetailPembayaranDaftar" class="small-box-footer">More info <i class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $hitungPembayaranDiklatDicek }}</h3>
    
                    <p>Pembayaran Diklat Belum Terkonfirmasi</p>
                </div>
                <div class="icon">
                    <i class="bi bi-card-list"></i>
                </div>
                <a href="/pembayaranBelumVerifikasi" class="small-box-footer">More info <i class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="p-6 m-20 bg-white rounded shadow">
        <label for="yearSelect">Select Year:</label>
        <select id="yearSelect" onchange="updateChart()">
            @for ($year = 2020; $year <= date('Y'); $year++)
                <option value="{{ $year }}">{{ $year }}</option>
            @endfor
        </select>
        <div id="chart-container">
            {!! $KeuanganChart->container() !!}
        </div>
    </div>

    <script src="{{ $KeuanganChart->cdn() }}"></script>
    {{ $KeuanganChart->script() }}

    <script>
        function updateChart() {
            var year = document.getElementById('yearSelect').value;
            window.location.href = `/dbKeuangan?year=${year}`;
        }
    </script>
@endsection
