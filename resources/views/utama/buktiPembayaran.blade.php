@extends('layout/mainUser')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">
    <script src="/js/actor.js"></script>

        {{-- <div class="content"> --}}
            <div class="bg-bukti">
                <div class="content-form">
                    <h2>Tabel Bukti Pembayaran</h2>
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
                                    <th scope="col">Jenis Pembayaran</th>
                                    <th scope="col">Metode Pembayaran</th>
                                    <th scope="col">Total harga</th>
                                    <th scope="col">status</th>
                                    <th scope="col">Dibuat</th>
                                    <th scope="col">Diupdate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayarans as $pembayaran)
                                    <tr>
                                        <td>{{ $pembayaran->jenis_pembayaran }}</td>
                                        <td>{{ $pembayaran->metode_pembayaran }}</td>
                                        <td>Rp {{ number_format($pembayaran->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ $pembayaran->status }}</td>
                                        <td>{{ $pembayaran->created_at->format('d F Y \j\a\m H:i:s') }}</td>
                                        <td>{{ $pembayaran->updated_at->format('d F Y \j\a\m H:i:s') }}</td>
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
                </div>
            </div>
        {{-- </div> --}}
@endsection
