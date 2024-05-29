@extends('layout.mainAdmin')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">
    <script src="/js/actor.js"></script>

    <div class="content-staff">
        <h2>Tabel Diklat</h2>
        <hr>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <a href="/kelDiklat/create" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> Tambah Data</a>
            <br> <br>
            {{-- Entries --}}
            <div class=" justify-content-between align-items-center filter">
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
                            <th style="width: 90px;">No 
                                <i class="bi bi-arrow-up" onclick="sortTable(0, 'asc')"></i>
                                <i class="bi bi-arrow-down" onclick="sortTable(0, 'desc')"></i>
                            </th>
                            <th style="width: 160px;">Nama Diklat
                                <i class="bi bi-arrow-up" onclick="sortTable(1, 'asc')" style="font-size: 15px;"></i>
                                <i class="bi bi-arrow-down" onclick="sortTable(1, 'desc')" style="font-size: 15px;"></i>    
                            </th>
                            <th>Gambar sampul</th>
                            <th style="width: 180px;">Kategori Diklat 
                                <i class="bi bi-arrow-up" onclick="sortTable(2, 'asc')" style="font-size: 15px;"></i>
                                <i class="bi bi-arrow-down" onclick="sortTable(2, 'desc')" style="font-size: 15px;"></i>  
                            </th>
                            {{-- <th>Kuota Minimal 
                                <i class="bi bi-arrow-up" onclick="sortTable(3, 'asc')" style="font-size: 15px;"></i>
                                <i class="bi bi-arrow-down" onclick="sortTable(3, 'desc')" style="font-size: 15px;"></i>  
                            </th>
                            <th>Jumlah Pendaftar 
                                <i class="bi bi-arrow-up" onclick="sortTable(4, 'asc')" style="font-size: 15px;"></i>
                                <i class="bi bi-arrow-down" onclick="sortTable(4, 'desc')" style="font-size: 15px;"></i>  
                            </th> --}}
                            <th>Gambar default?
                                <i class="bi bi-arrow-up" onclick="sortTable(3, 'asc')" style="font-size: 15px;"></i>
                                <i class="bi bi-arrow-down" onclick="sortTable(3, 'desc')" style="font-size: 15px;"></i>  
                            </th>
                            <th>Status
                                <i class="bi bi-arrow-up" onclick="sortTable(4, 'asc')" style="font-size: 15px;"></i>
                                <i class="bi bi-arrow-down" onclick="sortTable(4, 'desc')" style="font-size: 15px;"></i>  
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_diklat }}</td>
                                <td>
                                    @if ($data->gambar)
                                        <img src="{{ asset('storage/' . $data->gambar) }}" alt="" style="width:300px;">
                                    @else
                                        @php $foundDefault = false; @endphp
                                        @foreach ($diklats as $diklat)
                                            @if ($diklat->default == 'ya')
                                                <img src="{{ asset('storage/' . $diklat->gambar) }}" alt="Default Image" style="width:300px;">
                                                @php $foundDefault = true; @endphp
                                                @break
                                            @endif
                                        @endforeach
                                        @if (!$foundDefault)
                                            <img src="{{ asset('img/123.png') }}" alt="Default Image" style="width:300px;">
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $data->kategori_diklat }}</td>
                                <td>
                                    @if ($data->default=="ya")
                                        <span class="badge rounded-pill text-bg-primary">ya</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">tidak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status=="full")
                                        <span class="badge rounded-pill text-bg-primary">{{ $data->status }}</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">{{ $data->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="/kelDiklat/{{ $data->id }}" class="btn btn-info"><i class="bi bi-eye"></i> Detail</a>
                                        <a href="/kelDiklat/{{ $data->id }}/edit" class="btn btn-success"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <form action="/kelDiklat/{{ $data->id }}" method="POST">
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
