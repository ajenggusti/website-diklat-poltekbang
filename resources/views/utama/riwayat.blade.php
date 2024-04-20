@extends('layout.mainUser')
@section('container')
    <h1>RIWAYAT DIKLAT</h1>
    @if (session('success') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @foreach ($datas as $key => $data)
        <h3>{{ $dataDiklat[$key]->nama_diklat }}</h3>
        <p>Status Diklat : {{ $dataDiklat[$key]->status }}</p>
        <p>harga diklat : Rp. {{ number_format($data->diklat->harga, 0, ',', '.') }}</p>
         <!-- Displaying Discount -->
        @if($data->promo)
            <p>Diskon: - Rp. {{ number_format($data->promo->potongan, 0, ',', '.') }}</p>
        @else
            <p>Diskon: - Rp. 0</p> 
        @endif
        <p>Total Biaya : Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</p>
        <p>Status Pembayaran Diklat : {{ $data->status_pembayaran_diklat }}</p>
        <p>Harga Pendaftaran : Rp. 150.000</p>
        <p>Status Pembayaran Pendaftaran : {{ $data->status_pembayaran_daftar }}</p>
        
        <a href="/riwayat/{{ $data->id }}" class="btn btn-success">Lihat</a>
        <a href="{{ route('kelPembayaran.create', ['id' => $data->id]) }}" class="btn btn-secondary">Lakukan Pembayaran?</a>
        <form action="/kelPendaftaran/{{ $data->id }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
        </form>
        <a href="/bukti-pembayaran/{{ $data->id }}" class="btn" style="background-color: palevioletred; color: #ffffff;">Bukti Pembayaran</a>
        
        <a href="{{ route('kelTestimoni.create', ['id' => $data->id]) }}"class="btn" style="background-color: rgb(44, 138, 192); color: #ffffff;">Sampaikan Pendapatmu</a>

        <a href="/kelPendaftaran/{{ $data->id }}/edit" class="btn btn-warning">Edit</a>
        <hr>
    @endforeach
    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
@endsection
