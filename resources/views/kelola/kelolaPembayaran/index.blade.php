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
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama User</th>
                <th scope="col">Nama Diklat</th>
                <th scope="col">Jenis Pembayaran</th>
                <th scope="col">Biaya</th>
                <th scope="col">Status pembayaran</th>
                {{-- <th scope="col">Bukti Pembayaran</th> --}}
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayarans as $pembayaran)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pembayaran->pendaftaran->user->name }}</td>
                <td>{{ $pembayaran->pendaftaran->diklat->nama_diklat }}</td>
                <td>{{ $pembayaran->jenis_pembayaran }}</td>
                <td id="biaya_diklat_{{ $loop->iteration }}">Rp {{ number_format($pembayaran->pendaftaran->harga_diklat, 0, ',', '.') }}</td>
                <td id="status_pembayaran_diklat_{{ $loop->iteration }}">{{ $pembayaran->pendaftaran->status_pembayaran_diklat }}</td>
                <td id="biaya_pendaftaran_{{ $loop->iteration }}">Rp 150.000</td>
                <td id="status_pembayaran_daftar_{{ $loop->iteration }}">{{ $pembayaran->pendaftaran->status_pembayaran_daftar }}</td>
                {{-- <td><img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="bukti pembayaran" style="width: 30%;"></td> --}}
                <td>
                    {{-- <a href="/kelPembayaran/{{ $pembayaran->id }}/edit" class="btn btn-warning">Edit</a> --}}
                    <a href="/kelPembayaran/{{ $pembayaran->id }}" class="btn btn-success">Lihat</a>
                    {{-- <form action="/kelPembayaran/{{ $pembayaran->id }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var rows = document.querySelectorAll("tbody tr");
            rows.forEach(function(row, index) {
                var jenis_pembayaran = row.cells[3].textContent;
                if (jenis_pembayaran === 'diklat') {
                    // Sembunyikan kolom Biaya Pendaftaran dan Status Pembayaran Pendaftaran
                    row.cells[6].style.display = "none";
                    row.cells[7].style.display = "none";
                } else if (jenis_pembayaran === 'pendaftaran') {
                    // Sembunyikan kolom Biaya Diklat dan Status Pembayaran Diklat
                    row.cells[4].style.display = "none";
                    row.cells[5].style.display = "none";
                }
            });
        });
    </script>
@endsection
