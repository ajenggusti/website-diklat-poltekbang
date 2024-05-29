@extends('layout.mainAdmin')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">
    
    <div class="content-show">
        <h2>Detail Diklat</h2>
        <a href="/kelDiklat/{{ $diklatData->id}}/edit" class="btn btn-success">Edit</a>
        <a href="{{ route('kelDiklat.index') }}" class="btn btn-primary">Kembali</a>
        <br> <br>
        <div class="table-responsive">
            <table class="table table-sm show-user">
            
                <tr>
                    <th>Gambar Sampul</th>
                    <td>
                        @if ($diklatData->gambar)
                            <!-- Tampilkan gambar dari database jika ada -->
                            <img src="{{ asset('storage/' . $diklatData->gambar) }}" alt="" style="width: 300px;">
                        @else
                            @php $foundDefault = false; @endphp
                            @foreach ($allDiklatData as $data)
                                @if ($data->default == 'ya')
                                    <img src="{{ asset('storage/' . $data->gambar) }}" alt="Default Image" style="width: 300px;">
                                    @php $foundDefault = true; @endphp
                                    @break
                                @endif
                            @endforeach
                            @if (!$foundDefault)
                                <!-- Jika tidak ditemukan data dengan default 'ya', gunakan gambar default umum -->
                                <img src="{{ asset('img/123.png') }}" alt="Default Image" style="width: 300px;">
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
                    <th>Kuota Minimal</th>
                    <td>{{ $diklatData->kuota_minimal }}</td>
                </tr>
                <tr>
                    <th>Jumlah Pendaftar</th>
                    <td>{{ $diklatData->jumlah_pendaftar}}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if ($diklatData->status=="full")
                            <span class="badge rounded-pill text-bg-primary">{{ $diklatData->status }}</span>
                        @else
                            <span class="badge rounded-pill text-bg-danger">{{ $diklatData->status }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{!! $diklatData->deskripsi !!}</td>
                </tr>
                <tr>
                    <th>Link whatsapp</th>
                    <td><a href="{{ $diklatData->whatsapp }}">{{ $diklatData->whatsapp }}</a></td>
                </tr>
            </table>
        </div>
    </div>
@endsection
