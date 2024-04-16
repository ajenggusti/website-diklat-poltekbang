@extends('layout.mainAdmin')
@section('container')
    <a href="/kelGambarDiklat/create" class="btn btn-primary">Tambah Data</a>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h1>Kelola Gambar Diklat</h1>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Gambar akan tampil pada</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset('storage/' . $data->gambar_navbar) }}" alt="" style="width: 30%;"></td>
                    <td>{{ $data->diklat->nama_diklat ?? "Semua diklat" }}</td>

                    <td>
                        <a href="/kelGambarDiklat/{{ $data->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="/kelGambarDiklat/{{ $data->id }}" method="POST">
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
