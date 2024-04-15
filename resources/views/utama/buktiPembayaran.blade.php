@extends('layout/mainUser')

@section('container')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Jenis Pembayaran</th>
                    <th>Bukti Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayarans as $pembayaran)
                    <tr>
                        <td>{{ $pembayaran->jenis_pembayaran }}</td>
                        <td><img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" style="max-width: 200px;"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
