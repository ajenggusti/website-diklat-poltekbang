@extends('layout.mainAdmin')
@section('container')
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
            <th scope="col">Gambar</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
        <tr tr @if ($data->default == 'ya') style="background-color: #89CFF0;" @endif>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->kategori_diklat }}</td>
            <td>
                @if ($data->gambar)
                    <img src="{{ asset('storage/' . $data->gambar) }}" alt="" style="width: 30%;">
                @else
                    @php $foundDefault = false; @endphp
                    @foreach ($datas2 as $datas)
                        @if ($datas->default == 'ya')
                            <img src="{{ asset('storage/' . $datas->gambar) }}" alt="Default Image" style="width: 30%;">
                            @php $foundDefault = true; @endphp
                            @break
                        @endif
                    @endforeach
                    @if (!$foundDefault)
                        <img src="{{ asset('img/123.png') }}" alt="Default Image" style="width: 30%;">
                    @endif
                @endif
            </td>
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

