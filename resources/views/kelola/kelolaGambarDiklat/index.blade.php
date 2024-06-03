@extends('layout.mainAdmin')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">
    <script src="/js/actor.js"></script>

    <div class="content-staff">
        <h2>Tabel Gambar Diklat</h2>
        <hr>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <a href="/kelGambarDiklat/create" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> Tambah Data</a>
        <br> <br>
        {{-- Entries --}}
        <div class=" justify-content-between align-items-center filter">
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
                        <th style="width: 90px;">No 
                            <i class="bi bi-arrow-up" onclick="sortTable(0, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(0, 'desc')"></i>
                        </th>
                        <th>Gambar</th>
                        <th style="width: 400px;">Gambar tampil di 
                            <i class="bi bi-arrow-up" onclick="sortTable(1, 'asc')" style="font-size: 15px;"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(1, 'desc')" style="font-size: 15px;"></i>    
                        </th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="image-container">
                                <img src="{{ asset('storage/' . $data->gambar_navbar) }}" alt="">
                            </td>
                            <td>
                                @if ($data->id_diklat==null)
                                    <span class="badge rounded-pill text-bg-danger">Semua diklat</span>
                                @else
                                    <span class="badge rounded-pill text-bg-primary">{{ $data->diklat->nama_diklat }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/kelGambarDiklat/{{ $data->id }}/edit" class="btn btn-success"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <form action="/kelGambarDiklat/{{ $data->id }}" method="POST">
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
