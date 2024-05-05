@extends('layout.mainAdmin')
@section('container')
    <h1>Detail Pendaftaran</h1>
    <a href="/kelPromo/{{ $kelPromo->id }}/edit" class="btn btn-warning">Edit</a>
    <table class="table">
        
        @if ($kelPromo->id_diklat != null)
            <tr>
                <th>Promo untuk?</th>
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
            <td><img src="{{ asset('storage/' . $kelPromo->gambar) }}" alt="Nama Gambar"></td>
        </tr>
        <tr>
            <th>potongan </th>
            <td>{{ $kelPromo->potongan }}</td>
        </tr>
        <tr>
            <th>kode </th>
            <td>{{ $kelPromo->kode }}</td>
        </tr>
        <tr>
            <th>status tmpil </th>
            <td>{{ $kelPromo->tampil }}</td>
        </tr>
        <tr>
            <th>deskripsi </th>
            <td>{{ $kelPromo->deskripsi }}</td>
        </tr>
        <tr>
            <th>Tanggal awal </th>
            <td>{{ date('d F Y', strtotime($kelPromo->tgl_awal)) }}</td>
        </tr>
        <tr>
            <th>Tanggal akhir </th>
            <td>{{ date('d F Y', strtotime($kelPromo->tgl_akhir)) }}</td>
        </tr>
        @if ($kelPromo->pakai_kuota != null)  
            <tr>
                <th>pakai Kuota </th>
                <td>{{ $kelPromo->pakai_kuota }}</td>
            </tr>
            <tr>
                <th>kuota </th>
                <td>{{ $kelPromo->kuota }}</td>
            </tr>
        @endif


    </table>
    <a href="{{ route('kelPendaftaran.index') }}" class="btn btn-primary">Kembali</a>
@endsection
