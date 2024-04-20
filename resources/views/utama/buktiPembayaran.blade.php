@extends('layout/mainUser')

@section('container')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Jenis Pembayaran</th>
                    <th>status</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayarans as $pembayaran)
                    <tr>
                        <td>{{ $pembayaran->jenis_pembayaran }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
