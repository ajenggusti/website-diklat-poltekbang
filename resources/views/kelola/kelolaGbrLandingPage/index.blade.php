@extends('layout.mainAdmin')
@section('container')
    <a href="/gbrLandingPage/create" class="btn btn-primary">Tambah Data</a>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h1>Kelola Gambar Landing Page</h1>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset('storage/' . $data->gambar_navbar) }}" alt="" style="width: 30%;"></td>
                    <td>{{ $data->status }}</td>
                    <td>
                        <a href="/gbrLandingPage/{{ $data->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="/gbrLandingPage/{{ $data->id }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
