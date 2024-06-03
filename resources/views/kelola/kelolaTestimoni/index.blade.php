@extends('layout.mainAdmin')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">
    <script src="/js/actor.js"></script>

    <div class="content-staff">
        <h2>Tabel Testimoni</h2>
        <hr>
        @if (session('success') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a href="{{ route('testimoniAdmin.create') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> Tambah Data</a>
        <br> <br>

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
                        <th scope="col" style="width: 90px">No 
                            <i class="bi bi-arrow-up" onclick="sortTable(0, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(0, 'desc')"></i>
                        </th>
                        <th scope="col">Diklat
                            <i class="bi bi-arrow-up" onclick="sortTable(1, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(1, 'desc')"></i>
                        </th>
                        <th scope="col">Nama 
                            <i class="bi bi-arrow-up" onclick="sortTable(2, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(2, 'desc')"></i>
                        </th>
                        <th scope="col">Profesi 
                            <i class="bi bi-arrow-up" onclick="sortTable(3, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(3, 'desc')"></i>
                        </th>
                        <th scope="col" style="width: 300px">Testimoni 
                            <i class="bi bi-arrow-up" onclick="sortTable(4, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(4, 'desc')"></i>
                        </th>
                        <th scope="col">Tampil? 
                            <i class="bi bi-arrow-up" onclick="sortTable(5, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(5, 'desc')"></i>
                        </th>
                        <th scope="col">Penulis? 
                            <i class="bi bi-arrow-up" onclick="sortTable(6, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(6, 'desc')"></i>
                        </th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($data->id_pendaftaran)
                                    {{ $data->pendaftaran->diklat->nama_diklat}}
                                @else
                                    {{ $data->diklat->nama_diklat}}
                                @endif
                            </td>
                            <td>
                                @if ($data->id_pendaftaran)
                                    {{-- {{ $data->pendaftaran->nama_dummy}} --}}
                                    {{ $data->nama_dummy}}
                                @else
                                    {{ $data->nama_dummy}}
                                @endif
                            </td>
                            <td>{{ $data->profesi }}</td>
                            <td>{{ $data->testimoni }}</td>
                            <td>
                                @if ($data->tampil=="iya")
                                    <span class="badge rounded-pill text-bg-primary">{{ $data->tampil }}</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">{{ $data->tampil }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->id_pendaftaran==null)
                                    <span class="badge rounded-pill text-bg-primary"> Admin</span>
                                @else
                                    <span class="badge rounded-pill text-bg-warning"> User</span>
                                @endif
                            </td>

                            <td>
                                <div class="action-buttons">
                                    <a href="/kelTestimoni/{{ $data->id }}/edit " class="btn btn-success"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <form action="/kelTestimoni/{{ $data->id }}" method="POST">
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

