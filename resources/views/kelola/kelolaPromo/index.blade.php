@extends('layout.mainAdmin')
@section('container')
    <h2>Kelola Promo</h2>
    @if (session('success') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <a href="/kelPromo/create" class="btn btn-primary">Tambah</a>
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Potongan</th>
            <th scope="col">Kode Promo</th>
            <th scope="col">Tanggal Mulai</th>
            <th scope="col">Tanggak Berakhir</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->potongan }}</td>
                    <td>{{ $data->kode }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tgl_awal)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tgl_akhir)->format('d-m-Y') }}</td>
                    <td>
                        <a href="kelPromo/{{ $data->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="kelPromo/{{ $data->id }}" method="POST">
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
