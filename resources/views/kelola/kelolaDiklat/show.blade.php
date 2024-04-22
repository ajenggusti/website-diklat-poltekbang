@extends('layout.mainAdmin')
@section('container')
    <h1>Detail Diklat</h1>
    <a href="/kelDiklat/{{ $diklatData->id}}/edit" class="btn btn-warning">Edit</a>
    <table class="table">
        
        <tr>
            <th>Gambar Sampul</th>
            <td>
                @if ($diklatData->gambar)
                    <!-- Tampilkan gambar dari database jika ada -->
                    <img src="{{ asset('storage/' . $diklatData->gambar) }}" alt="" style="width: 30%;">
                @else
                    @php $foundDefault = false; @endphp
                    @foreach ($allDiklatData as $data)
                        @if ($data->default == 'ya')
                            <img src="{{ asset('storage/' . $data->gambar) }}" alt="Default Image" style="width: 30%;">
                            @php $foundDefault = true; @endphp
                            @break
                        @endif
                    @endforeach
                    @if (!$foundDefault)
                        <!-- Jika tidak ditemukan data dengan default 'ya', gunakan gambar default umum -->
                        <img src="{{ asset('img/123.png') }}" alt="Default Image" style="width: 30%;">
                    @endif
                @endif
            </td>
        </tr>
        
        
        
        <tr>
            <th>Nama Diklat</th>
            <td>{{ $diklatData->nama_diklat }}</td>
        </tr>
        <tr>
            <th>Kategori Diklat</th>
            <td>{{ $diklatData->kategori_diklat }}</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>Rp {{ number_format($diklatData->harga, 0, ',', '.') }}</td>
        </tr>        
        <tr>
            <th>kuota_minimal</th>
            <td>{{ $diklatData->kuota_minimal }}</td>
        </tr>
        <tr>
            <th>jumlah_pendaftar</th>
            <td>{{ $diklatData->jumlah_pendaftar}}</td>
        </tr>
        <tr>
            <th>status</th>
            <td>{{ $diklatData->status }}</td>
        </tr>
        <tr>
            <th>deskripsi</th>
            <td>{!! $diklatData->deskripsi !!}</td>
        </tr>
        <tr>
            <th>Link whatsapp</th>
            <td><a href="{{ $diklatData->whatsapp }}">{{ $diklatData->whatsapp }}</a></td>
        </tr>
    </table>
    <a href="{{ route('kelDiklat.index') }}" class="btn btn-primary">Kembali</a>
@endsection
