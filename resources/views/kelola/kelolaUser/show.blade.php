@extends('layout.mainAdmin')
@section('container')
    <h1>Detail User</h1>
    <table class="table">
        <a href="/register/{{ $user->id }}/edit" class="btn btn-warning">Edit</a>
        @if ($user->jenis_berkas =="paspor")
            <tr>
                <th>Role level</th>
                <td>{{ $user->level->level }}</td>
            </tr>
            <tr>
                <th>Kewarganegaraan</th>
                <td>{{ $user->nationality->name }}</td>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Berkas Pendukung</th>
                <td><img style="height: 50px" src="{{ asset('storage/' . $user->berkas_pendukung) }}" alt="Nama Gambar"></td>
            </tr>
            <tr>
                <th>Jenis Kelamin </th>
                <td>{{ $user->jenis_kelamin }}</td>
            </tr>
            <tr>
                <th>Jenis Berkas </th>
                <td>{{ $user->jenis_berkas }}</td>
            </tr>
            <tr>
                <th>Nomor Paspor </th>
                <td>{{ $user->no_paspor }}</td>
            </tr>
            <tr>
                <th>Tanggal Expired Paspor</th>
                <td>{{ \Carbon\Carbon::parse($user->tgl_exp_paspor)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>{{ \Carbon\Carbon::parse($user->tgl_lahir)->translatedFormat('d F Y') }}</td>
            </tr>
            
            <tr>
                <th>status</th>
                <td>{{ $user->status }}</td>
            </tr>
        @else
            
        @endif


    </table>
@endsection
