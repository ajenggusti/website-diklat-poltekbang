@extends('layout.mainAdmin')
@section('title', 'DPUK | Promo')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">
    <script src="/js/actor.js"></script>

    <div class="content-staff">
        <h2>Tabel Promo</h2>
        <hr>
        @if (session('success') )
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
        
        @endif
        <a href="/kelPromo/create" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> Tambah Data</a>
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

            
            {{-- <div class="status-button"> --}}
                <div class="kadaluarsa"></div><span class="status"> = Kadaluarsa</span>
                <div class="berlaku"></div><span class="status"> = Berlaku</span>

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
                        <th scope="col" style="min-width: 70px;">No <br>
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(0, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(0, 'desc')" style="font-size: 13px;"></i>
                        </th>
                        <th scope="col">Banner</th>
                        <th scope="col">Potongan 
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(1, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(1, 'desc')" style="font-size: 13px;"></i>
                        </th>
                        <th scope="col">Deskripsi
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(2, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(2, 'desc')" style="font-size: 13px;"></i>
                        </th>
                        <th scope="col">Kode Promo <br>
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(3, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(3, 'desc')" style="font-size: 13px;"></i>
                        </th>
                        <th scope="col">Tanggal Mulai 
                        </th>
                        <th scope="col">Tanggal Berakhir 
                        </th>
                        <th scope="col">Tampil?? 
                            <i class="fa-solid fa-arrow-up" onclick="sortTable(4, 'asc')" style="font-size: 13px;"></i>
                            <i class="fa-solid fa-arrow-down" onclick="sortTable(4, 'desc')" style="font-size: 13px;"></i>
                        </th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/' . $data->gambar) }}" alt="banner-promo" style="width: 350px; height: 200px;"></td>
                            <td>Rp {{ number_format($data->potongan, 0, ',', '.') }}</td>
                            <td>{{ $data->deskripsi }}</td>
                            <td>{{ $data->kode }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tgl_awal)->format('d-m-Y') }}</td>
                            <td>
                                @if (\Carbon\Carbon::parse($data->tgl_akhir)->lessThan(now()->startOfDay()))
                                    <span class="badge rounded-pill text-bg-danger">{{ \Carbon\Carbon::parse($data->tgl_akhir)->format('d-m-Y') }}</span>
                                @else
                                    <span class="badge rounded-pill text-bg-primary">{{ \Carbon\Carbon::parse($data->tgl_akhir)->format('d-m-Y') }}</span>
                                @endif
                            </td>
                            
                            <td>
                                @if ($data->tampil=="ya")
                                    <span class="badge rounded-pill text-bg-primary">{{ $data->tampil }}</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">{{ $data->tampil }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/kelPromo/{{ $data->id }}" class="btn btn-info"><i class="bi bi-eye"></i> Detail</a>
                                    <a href="kelPromo/{{ $data->id }}/edit" class="btn btn-success"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <form action="kelPromo/{{ $data->id }}" method="POST">
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
