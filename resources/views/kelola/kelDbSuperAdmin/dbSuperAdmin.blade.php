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
            <div class="dashAdmin">
                <a href="/allUser">
                    <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #BC4F00;">
                        <div class="dashItemContent">
                            Total Seluruh Pengguna
                        </div>
                        <div class="dashItemNumber">{{ $count }}</div>
                    </div>
                </a>
        
        @foreach($userCounts as $userCount)
            {{-- @php
                $levelColors = [
                    'DPUK' => '#B90000', 
                    'Keuangan' => '#D6C211',
                    'Member' => '#307C1E', 
                    'Super Admin' => '#84A6FF'
                ];

                $bgColor = $levelColors[$userCount->level] ?? '#FFFFFF';
            @endphp --}}
            <a href="/byLevel/{{ $userCount->level->id }}">
                <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid ;">
                    <div class="dashItemContent">
                        <p>Level {{ $userCount->level->level }}</p> 
                    </div>
                    <div class="dashItemNumber">
                        {{ $userCount->total_user }} 
                    </div>
                    <span>pengguna</span>
                </div>
            </a>
            {{-- <div>
                <a href="/byLevel/{{ $userCount->level->id }}"><p>Level {{ $userCount->level->level }}: {{ $userCount->total_user }} pengguna</p></a>
            </div> --}}
        @endforeach

    </body>
</html>
@endsection



