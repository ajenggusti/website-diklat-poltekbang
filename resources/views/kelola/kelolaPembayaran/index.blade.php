@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Pembayaran</title>
    <link href="/css/actor.css" rel="stylesheet">
    <script src="/js/actor.js"></script>
    {{-- <script src="/js/landing.js"></script> --}}
    {{-- Boostrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <div class="content-form">
        <h2>Tabel Pembayaran</h2>
        <hr>
        @if (session('success') )
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class=" justify-content-between align-items-center filter">
            {{-- Entries --}}
            <div class="entries-bar ">
                <label for="entries">Show entries:</label>
                <select id="entries" onchange="changeEntries()">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            {{-- Search --}}
            <div class="search-bar">
                <label for="myInput">Search : </label>
                <input class="form-control " type="text" aria-label="Search" id="myInput" onkeyup="myFunction()">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm" id="myTable">
                <thead>
                    <tr class="header">
                        <th scope="col">No 
                            <i class="bi bi-arrow-up" onclick="sortTable(0, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(0, 'desc')"></i>
                        </th>
                        <th scope="col">Nama User 
                            <i class="bi bi-arrow-up" onclick="sortTable(1, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(1, 'desc')"></i>
                        </th>
                        <th scope="col">Nama Diklat 
                            <i class="bi bi-arrow-up" onclick="sortTable(2, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(2, 'desc')"></i>
                        </th>
                        <th scope="col">Jenis Pembayaran 
                            <i class="bi bi-arrow-up" onclick="sortTable(3, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(3, 'desc')"></i>
                        </th>
                        <th scope="col">Biaya 
                            <i class="bi bi-arrow-up" onclick="sortTable(4, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(4, 'desc')"></i>
                        </th>
                        <th scope="col">Status pembayaran 
                            <i class="bi bi-arrow-up" onclick="sortTable(5, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(5, 'desc')"></i>
                        </th>
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
                                <a href="/kelPembayaran/{{ $pembayaran->id }}" class="btn btn-info"><i class="bi bi-eye"></i> Detail</a>
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
            <div id="pagination">
                <div class="pagination-container">
                    <nav aria-label="...">
                        <ul class="ul-pagination">
                            <li class="page-item previous">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item next">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
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
    </div>
</body>
</html>
@endsection
