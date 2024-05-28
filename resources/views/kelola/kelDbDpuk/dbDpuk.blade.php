@extends('layout.mainAdmin')
@section('container')
    {{-- Head --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="/css/dashboard.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

    </style>
    {{-- Body --}}
    <div class="container-admin">
        <div class="dashAdmin">
            <a href="/kelPendaftaran">
                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #BC4F00;">
                    <div class="dashItemContent">
                        Jumlah seluruh pendaftar diklat
                    </div>
                    <div class="dashItemNumber">{{ $totalSemua }}</div>
                </div>
            </a>
            <a href="/perluSertifikat">
                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #BC4F00;">
                
                    <div class="dashItemContent">
                        Jumlah peserta yang memerlukan sertifikat
                    </div>
                    <div class="dashItemNumber">{{ $sertifikat }}</div>
                </div>
            </a>
            <a href="/PendaftaranTerlaksana">
                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #BC4F00;">
                    <div class="dashItemContent">
                        Jumlah Lulusan Diklat
                    </div>
                    <div class="dashItemNumber">{{ $alumni }}</div>
                </div>
            </a>
            <a href="/PendaftaranBelumTerlaksana">
                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #BC4F00;">
                    <div class="dashItemContent">
                        Jumlah pendaftaran yang belum terlaksana
                    </div>
                    <div class="dashItemNumber">{{ $jumlahBelumTerlaksana }}</div>
                </div>
            </a>
            @foreach($pendaftarans as $pendaftaran)
                @php
                    $levelColors = [
                        'DPUK' => '#B90000', 
                        'Keuangan' => '#D6C211',
                        'Member' => '#307C1E', 
                        'Super Admin' => '#84A6FF'
                    ];

                    $bgColor = $levelColors[$pendaftaran->level] ?? '#FFFFFF';
                @endphp
                <a href="/PendaftaranByDiklat/{{ $pendaftaran->diklat->id }}">
                    <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid {{ $bgColor }};">
                        <div class="dashItemContent">
                            <p>Jumlah pendaftar diklat {{ $pendaftaran->diklat->nama_diklat }}</p> 
                        </div>
                        <div class="dashItemNumber">
                            {{ $pendaftaran->total_pendaftar }}
                        </div>
                    </div>
                </a>


            @endforeach
        </div>
    </div>
@endsection
