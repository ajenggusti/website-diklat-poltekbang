@extends('layout.mainAdmin')
@section('title', 'DPUK | Tabel Pendaftaran')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">
    <script src="/js/actor.js"></script>

    <div class="content-staff">
        <h2>Tabel Pendaftaran</h2>
        <hr>
        @if (session('success'))
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
                    <option value="" disabled></option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="all">All</option>
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
                        <th style="width: 90px">No 
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(0, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(0, 'desc')" style="font-size: 13px;"></i>
                        </th>
                        <th>Nama User 
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(1, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(1, 'desc')" style="font-size: 13px;"></i>
                        </th>
                        <th>Nama Diklat 
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(2, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(2, 'desc')" style="font-size: 13px;"></i>
                        </th>
                        <th>Status Pembayaran Diklat 
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(3, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(3, 'desc')" style="font-size: 13px;"></i>
                        </th>
                        <th>Status Pembayaran Pendaftaran 
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(4, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(4, 'desc')" style="font-size: 13px;"></i>
                        </th>
                        <th>Status Pelaksanaan Diklat<br>
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(5, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(5, 'desc')" style="font-size: 13px;"></i>
                        </th>
                        {{-- <th>Tanggal<br>
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(6, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(6, 'desc')" style="font-size: 13px;"></i>
                        </th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->user->name }}</td>
                            <td>{{ $data->diklat->nama_diklat }}</td>
                            <td>
                                @if ($data->status_pembayaran_diklat=="Lunas")
                                    <span class="badge badge-pill badge-success">{{ $data->status_pembayaran_diklat }} Via {{ $data->jenis_pembayaran_diklat }}</span>
                                @elseif($data->status_pembayaran_diklat=="Menunggu verifikasi")
                                    <span class="badge badge-pill badge-warning">{{ $data->status_pembayaran_diklat }}</span>
                                @else
                                    <span class="badge badge-pill badge-danger">{{ $data->status_pembayaran_diklat }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->status_pembayaran_daftar=="Lunas")
                                    <span class="badge badge-pill badge-success">{{ $data->status_pembayaran_daftar }} Via {{ $data->jenis_pembayaran_daftar }}</span>
                                @elseif($data->status_pembayaran_daftar=="Menunggu verifikasi")
                                    <span class="badge badge-pill badge-warning">{{ $data->status_pembayaran_daftar }}</span>
                                @else
                                    <span class="badge badge-pill badge-danger">{{ $data->status_pembayaran_daftar }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->status_pelaksanaan=="Belum terlaksana")
                                    <span class="badge badge-pill badge-danger">{{ $data->status_pelaksanaan }}</span>
                                @else
                                    <span class="badge badge-pill badge-primary">{{ $data->status_pelaksanaan }}</span>
                                    
                                @endif
                            </td>
                            {{-- <td>jkjkjkj</td> --}}
                            <td>
                                <div class="action-buttons">
                                    <a href="/kelPendaftaran/{{ $data->id }}" class="btn btn-info"><i class="bi bi-eye"></i> Detail</a>
                                    <a href="/kelPendaftaran/{{ $data->id }}/editAsAdmin" class="btn btn-success"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <form action="/kelPendaftaran/{{ $data->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i> Delete</button>
                                    </form>
                                </div>
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
    </div>
@endsection
