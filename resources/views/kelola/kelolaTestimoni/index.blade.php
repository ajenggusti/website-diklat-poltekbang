@extends('layout.mainAdmin')
@section('container')
    <h2>Kelola Testimoni</h2>
    @if (session('success') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Diklat</th>
            <th scope="col">Nama</th>
            <th scope="col">Profesi</th>
            <th scope="col">Testimoni</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->nama_diklat}}</td>
            <td>{{ $data->nama_depan}}</td>
            <td>{{ $data->profesi }}</td>
            <td>{{ $data->testimoni }}</td>

            <td>
                <a href="#" class="btn btn-warning">Edit</a>
                <form action="#" method="POST">
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

