@extends('layout.mainAdmin')
@section('container')
{{-- Font Poppins --}}
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
            <div class="dashAdmin">
                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #BC4F00;">
                    <div class="dashItemContent">Total Seluruh Pengguna </div>
                    <div class="dashItemNumber">{{ $count }}</div>
                </div>

                @foreach($userCounts as $userCount)
                    @php
                        $levelColors = [
                            'DPUK' => '#B90000', // Merah
                            'Keuangan' => '#D6C211', // Kuning
                            'Member' => '#307C1E', // Hijau
                            'Super Admin' => '#84A6FF' // Biru
                        ];

                        $bgColor = $levelColors[$userCount->level] ?? '#FFFFFF'; // Default putih
                    @endphp
                    <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid {{ $bgColor }};">
                        <div class="dashItemContent">
                            <p>Total Actor {{ $userCount->level }}</p> <!-- Tulisan di sisi kiri -->
                        </div>
                        <div class="dashItemNumber">
                            {{ $userCount->total_users }} <!-- Angka di sisi kanan -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
@endsection
