@extends('layout.mainAdmin')
@section('container')
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="/css/dashboard.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container-admin">
        <div class="p-6 m-20 bg-white rounded shadow">
            <label for="yearSelect">Select Year:</label>
            <select id="yearSelect" onchange="updateChart()">
                @for($y = date('Y'); $y >= 2000; $y--)
                    <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
            <div id="chart-container">
                {!! $KeuanganChart->container() !!}
            </div>
        </div>
        <div class="dashAdmin">
            <a href="/dbDetailPembayaranDiklat">
                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #BC4F00;">
                    <div class="dashItemContent">Pelunasan diklat</div>
                    <div class="dashItemNumber">{{ $getBayarDiklat }}</div>
                </div>
            </a>
            <a href="/dbDetailPembayaranDaftar">
                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #B90000;">
                    <div class="dashItemContent">Pelunasan pendaftaran</div>
                    <div class="dashItemNumber">{{ $getBayarPendaftaran }}</div>
                </div>
            </a>
            <a href="/pembayaranBelumVerifikasi">
                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #D6C211;">
                    <div class="dashItemContent">Pembayaran Diklat Belum Terkonfirmasi</div>
                    <div class="dashItemNumber">{{ $hitungPembayaranDiklatDicek }}</div>
                </div>
            </a>
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
</body>
</html>
@endsection
