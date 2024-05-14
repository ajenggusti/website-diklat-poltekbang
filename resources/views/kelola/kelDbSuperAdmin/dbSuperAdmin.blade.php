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
        <p>
            <a href="/allUser">Total Seluruh Pengguna : {{ $count }}</a>
        </p>
        @foreach($userCounts as $userCount)
            <div>
                <a href="/byLevel/{{ $userCount->level->id }}"><p>Level {{ $userCount->level->level }}: {{ $userCount->total_user }} pengguna</p></a>
            </div>
        @endforeach











        {{-- <div class="container-admin">
            <div class="dashAdmin">
                    <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid #BC4F00;">
                        <div class="dashItemContent">Total Seluruh Pengguna </div>
                        <div class="dashItemNumber">{{ $count }}</div>
                    </div>

                @foreach($userCounts as $userCount)
                    @php
                        $levelColors = [
                            'DPUK' => '#B90000', 
                            'Keuangan' => '#D6C211',
                            'Member' => '#307C1E', 
                            'Super Admin' => '#84A6FF'
                        ];

                        $bgColor = $levelColors[$userCount->level] ?? '#FFFFFF';
                    @endphp
                    <div class="dashItem" style="background-color: #f1f3ff; border: 3px solid {{ $bgColor }};">
                        <div class="dashItemContent">
                            <p>Total Actor {{ $userCount->level }}</p> 
                        </div>
                        <div class="dashItemNumber">
                            {{ $userCount->total_users }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}
    </body>
</html>
@endsection
