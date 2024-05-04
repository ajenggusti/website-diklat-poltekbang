@extends('layout.mainAdmin')
@section('container')
    <h2>Kelola Testimoni</h2>
    @if (session('success') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <a href="{{ route('testimoniAdmin.create') }}" class="btn btn-primary">Tambah</a>
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Diklat</th>
            <th scope="col">Nama</th>
            <th scope="col">Profesi</th>
            <th scope="col">Testimoni</th>
            <th scope="col">Tampil?</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            @if ($data->id_pendaftaran)
                <td>{{ $data->pendaftaran->diklat->nama_diklat}}</td>
            @else
                <td>{{ $data->diklat->nama_diklat}}</td>
            @endif
            {{-- ============== --}}
            @if ($data->id_pendaftaran)
                <td>{{ $data->pendaftaran->nama_lengkap}}</td>
            @else
                <td>{{ $data->nama_dummy}}</td>
            @endif
            
            <td>{{ $data->profesi }}</td>
            <td>{{ $data->testimoni }}</td>
            <td>{{ $data->tampil }}</td>

            <td>
                <a href="/kelTestimoni/{{ $data->id }}/edit " class="btn btn-warning">Edit</a>
                <form action="/kelTestimoni/{{ $data->id }}" method="POST">
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

