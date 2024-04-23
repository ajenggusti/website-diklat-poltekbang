@extends('layout.mainAdmin')
@section('container')
{{-- Font Poppins --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="/css/actor.css" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

</style>
    <h2>Kelola tabel kategori diklat</h2>

    @if (session('success') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <a href="/kelKatDiklat/create" class="btn btn-primary">Tambah Data</a>
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kategori Diklat</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->kategori_diklat }}</td>
            <td>
                <a href="/kelKatDiklat/{{ $data->id }}/edit" class="btn btn-warning">Edit</a>
                <form action="/kelKatDiklat/{{ $data->id }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
                
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection

