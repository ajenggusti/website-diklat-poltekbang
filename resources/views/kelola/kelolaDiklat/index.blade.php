@extends('layout.mainAdmin')
@section('container')
    <a href="/kelDiklat/create" class="btn btn-primary">Tambah Data</a>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h1>Kelola Diklat</h1>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Diklat</th>
                <th>Gambar sampul</th>
                <th>Kategori Diklat</th>
                <th>Kuota Minimal</th>
                <th>Jumlah Pendaftar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr @if ($data->default == 'ya') style="background-color: #89CFF0;" @endif>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama_diklat }}</td>
                    <td>
                        @if ($data->gambar)
                            <img src="{{ asset('storage/' . $data->gambar) }}" alt="" style="width: 30%;">
                        @else
                            @php $foundDefault = false; @endphp
                            @foreach ($diklats as $diklat)
                                @if ($diklat->default == 'ya')
                                    <img src="{{ asset('storage/' . $diklat->gambar) }}" alt="Default Image" style="width: 30%;">
                                    @php $foundDefault = true; @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$foundDefault)
                                <img src="{{ asset('img/123.png') }}" alt="Default Image" style="width: 30%;">
                            @endif
                        @endif
                    </td>
                    <td>{{ $data->kategori_diklat }}</td>
                    <td>{{ $data->kuota_minimal}}</td>
                    <td>{{ $data->jumlah_pendaftar}}</td>
                    <td>{{ $data->status }}</td>
                    <td>
                        <a href="/kelDiklat/{{ $data->id }}" class="btn btn-success">Lihat</a>
                        <a href="/kelDiklat/{{ $data->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="/kelDiklat/{{ $data->id }}" method="POST">
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
