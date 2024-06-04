@extends('layout.mainAdmin')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">

    <div class="content-show">
        <h2>Detail Promo</h2>
        <a href="/kelPromo/{{ $kelPromo->id }}/edit" class="btn btn-success">Edit</a>
        <a href="{{ route('kelPromo.index') }}" class="btn btn-primary">Kembali</a>
        {{-- <a href="{{ route('kelPendaftaran.index') }}" class="btn btn-primary">Kembali</a> --}}
        <br> <br>
        <div class="table-responsive">
            <table class="table table-sm show-user">
            
                @if ($kelPromo->id_diklat != null)
                    <tr>
                        <th>Promo untuk diklat mana?</th>
                        <td>{{ $kelPromo->diklat->nama_diklat }}</td>
                    </tr>
                @else
                    <tr>
                        <th>Promo untuk?</th>
                        <td>Semua diklat</td>
                    </tr>
                @endif
                <tr>
                    <th>Gambar</th>
                    <td><img src="{{ asset('storage/' . $kelPromo->gambar) }}" alt="Nama Gambar" style="width: 350px; height: 200px;"></td>
                </tr>
                <tr>
                    <th>Potongan </th>
                    <td>{{ $kelPromo->potongan }}</td>
                </tr>
                <tr>
                    <th>Kode</th>
                    <td>{{ $kelPromo->kode }}</td>
                </tr>
                <tr>
                    <th>Status Tampil </th>
                    <td>
                        @if ($kelPromo->tampil=="ya")
                            <span class="badge rounded-pill text-bg-primary">{{ $kelPromo->tampil }}</span>
                        @else
                            <span class="badge rounded-pill text-bg-danger">{{ $kelPromo->tampil }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $kelPromo->deskripsi }}</td>
                </tr>
                <tr>
                    <th>Tanggal Awal</th>
                    <td>{{ date('d F Y', strtotime($kelPromo->tgl_awal)) }}</td>
                </tr>
                <tr>
                    <th>Tanggal Akhir</th>
                    <td>{{ date('d F Y', strtotime($kelPromo->tgl_akhir)) }}</td>
                </tr>
                @if ($kelPromo->pakai_kuota != null)  
                    <tr>
                        <th>Pakai Kuota </th>
                        <td>
                            @if ($kelPromo->pakai_kuota=="iya")
                                <span class="badge rounded-pill text-bg-primary">{{ $kelPromo->pakai_kuota }}</span>
                            @else
                                <span class="badge rounded-pill text-bg-danger">{{ $kelPromo->pakai_kuota }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Kuota </th>
                        <td>{{ $kelPromo->kuota }}</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@endsection
