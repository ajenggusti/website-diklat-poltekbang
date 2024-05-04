@extends('layout/mainUser')

@section('container')
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
@endsection
