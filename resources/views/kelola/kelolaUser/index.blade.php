@extends('layout.mainAdmin')
@section('container')
    <h2>Kelola User</h2>
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
            <th scope="col">Level</th>
            <th scope="col">username</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($getLevel as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->userLevel }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>

            <td>
                <a href="register/{{ $data->id }}/edit" class="btn btn-warning">Edit</a>
                <form action="/register/{{ $data->id }}" method="POST">
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

