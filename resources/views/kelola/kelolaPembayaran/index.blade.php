@extends('layout.mainAdmin')
@section('container')
    <h2>Kelola Pembayaran</h2>

    @if (session('success') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <a href="/kelPembayaran/create" class="btn btn-primary">Tambah Data</a>
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama User</th>
            <th scope="col">Nama Diklat</th>
            <th scope="col">Harga</th>
            <th scope="col">Jenis Pembayaran</th>
            <th scope="col">Status pembayaran diklat</th>
            <th scope="col">Bukti Pembayaran</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($pembayarans as $pembayaran)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pembayaran->pendaftaran->user->name }}</td>
            <td>{{ $pembayaran->pendaftaran->diklat->nama_diklat }}</td>
            <td>Rp {{ number_format($pembayaran->pendaftaran->harga_diklat, 0, ',', '.') }}</td>
            <td>{{ $pembayaran->jenis_pembayaran }}</td>
            <td>{{ $pembayaran->pendaftaran->status_pembayaran_diklat }}</td>
            <td><img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="bukti pembayaran" style="width: 30%;"></td>
            <td>
                <a href="/kelPembayaran/{{ $pembayaran->id }}/edit" class="btn btn-warning">Edit</a>
                <form action="/kelPembayaran/{{ $pembayaran->id }}" method="POST">
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

{{-- @foreach ($pembayarans as $pembayaran)
    <p>ID Pembayaran: {{ $pembayaran->id }}</p>
    <p>Jenis Pembayaran: {{ $pembayaran->jenis_pembayaran }}</p>
    <p>Bukti Pembayaran: {{ $pembayaran->bukti_pembayaran }}</p>
    
    <!-- Mengakses data pendaftaran yang terkait -->
    <p>ID Pendaftaran: {{ $pembayaran->pendaftaran->id }}</p>
    <p>ID Diklat: {{ $pembayaran->pendaftaran->id_diklat }}</p>
    <p>ID User: {{ $pembayaran->pendaftaran->id_user }}</p>
    <p>Harga Diklat: {{ $pembayaran->pendaftaran->harga_diklat }}</p>
    <p>Status Pembayaran Diklat: {{ $pembayaran->pendaftaran->status_pembayaran_diklat }}</p>

    <!-- Mengakses data dari tabel 'diklat' melalui relasi -->
    <p>Nama Diklat: {{ $pembayaran->pendaftaran->diklat->nama_diklat }}</p>
    <p>Harga Diklat: {{ $pembayaran->pendaftaran->diklat->harga }}</p>
    <p>Kuota Minimal: {{ $pembayaran->pendaftaran->diklat->kuota_minimal }}</p>

    <!-- Mengakses data dari tabel 'promos' melalui relasi -->
    @if($pembayaran->pendaftaran->id_promo)
        <p>Kode Promo: {{ $pembayaran->pendaftaran->promo->kode }}</p>
        <p>Potongan Harga Promo: {{ $pembayaran->pendaftaran->promo->potongan }}</p>
    @endif

    <!-- Mengakses data dari tabel 'users' melalui relasi -->
    <p>Nama User: {{ $pembayaran->pendaftaran->user->name }}</p>
    <p>Email User: {{ $pembayaran->pendaftaran->user->email }}</p>
    
    <hr>
@endforeach --}}
