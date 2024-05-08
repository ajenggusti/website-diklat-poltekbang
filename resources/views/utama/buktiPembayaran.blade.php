@extends('layout/mainUser')
@section('container')
<html>
    <head>
            <!-- Custom styles for this template -->
        <link href="/css/landing.css" rel="stylesheet">
        <script src="/js/landing.js"></script>
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
        <div class="content-land">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Jenis Pembayaran</th>
                            <th>Metode Pembayaran</th>
                            <th>Total harga</th>
                            <th>status</th>
                            <th>Dibuat</th>
                            <th>Diupdate</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayarans as $pembayaran)
                            <tr>
                                <td>{{ $pembayaran->jenis_pembayaran }}</td>
                                <td>{{ $pembayaran->metode_pembayaran }}</td>
                                <td>Rp {{ number_format($pembayaran->total_harga, 0, ',', '.') }}</td>
                                <td>{{ $pembayaran->status }}</td>
                                <td>{{ $pembayaran->created_at->format('d F Y \j\a\m H:i:s') }}</td>
                                <td>{{ $pembayaran->updated_at->format('d F Y \j\a\m H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
@endsection
