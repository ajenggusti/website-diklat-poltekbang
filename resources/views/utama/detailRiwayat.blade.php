@extends('layout.mainUser')
@section('container')
<h1>INVOICE (belum ditambahkan fitur cetak)</h1>
    <p>nama diklat : {{ $data->diklat->nama_diklat }}</p>
    <br>
    <p>nama depan : {{ $data->nama_depan }}</p>
    <br>
    <p>nama belakang : {{ $data->nama_belakang }}</p>
    <br>
    <p>tempat lahir : {{ $data->tempat_lahir }}</p>
    <br>
    {{-- jangan lupa kasih format --}}
    <p>tanggal Lahir : {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</p>
    <br>
    <p>Alamat : {{ $data->alamat }}</p>
    <br>
    <p>email : {{ $data->email }}</p>
    <br>
    <p>no hp : {{ $data->no_hp }}</p>
    <br>
    <p>pendidikan terakhir : {{ $data->pendidikan_terakhir }}</p>
    <br>
    <p>waktu pendaftaran : {{ \Carbon\Carbon::parse($data->waktu_pendaftaran)->format('H:i:s | d-m-Y') }}</p>
    <br>
    @if($data->promo)
        <p>kode promo : {{ $data->promo->kode }}</p>
    @else
        <p>kode promo : Tidak ada promo yang diambil</p>
    @endif

    <br>
    <p>biaya pendaftaran : Rp 150.000</p>
    <br>
    <p>status pembayaran pendaftaran : {{ $data->status_pembayaran_daftar }}</p>
    <br>
    <p>harga diklat : Rp. {{ number_format($data->diklat->harga, 0, ',', '.') }}</p>
    <br>
    <!-- Displaying Discount -->
    @if($data->promo)
            <p>Diskon: - Rp. {{ number_format($data->promo->potongan, 0, ',', '.') }}</p>
        @else
            <p>Diskon: - Rp. 0</p> 
        @endif
    <br>
    <p>Total Biaya : Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</p>
    <br>
    <p>status pembayaran biaya diklat : {{ $data->status_pembayaran_diklat }}</p>
    <br>
    <p>Join Grup whatsapp: <a href="{{ $data->diklat->whatsapp }}">Klik untuk join!</a></p>
    <br>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    <a href="/kelPendaftaran/{{ $data->id }}/edit" class="btn btn-warning">Edit</a>
@endsection