@extends('layout.mainAdmin')
@section('container')
    {{-- Head --}}
    <link href="/css/actor.css" rel="stylesheet">
    <script src="/js/actor.js"></script>
    
    {{-- Body --}}
    <div class="content-staff">
        <h2>Tabel User</h2>
        <hr>
        @if (session('success') )
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

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
                        <th scope="col" style="">
                            No 
                            <i class="bi bi-arrow-up" onclick="sortTable(0, 'asc')" style="font-size: 15px;"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(0, 'desc')" style="font-size: 15px;"></i>
                        </th>
                        <th scope="col" style="word-spacing: 5px;">
                            Nama Lengkap
                            <i class="bi bi-arrow-up" onclick="sortTable(1, 'asc')" style="font-size: 15px;"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(1, 'desc')" style="font-size: 15px;"></i>    
                        </th>
                        <th scope="col" style="word-spacing: 5px;">
                            Level 
                            <i class="bi bi-arrow-up" onclick="sortTable(2, 'asc')" style="font-size: 15px;"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(2, 'desc')" style="font-size: 15px;"></i>    
                        </th>
                        <th scope="col" style="word-spacing: 5px;">
                            Email  
                            <i class="bi bi-arrow-up" onclick="sortTable(3, 'asc')" style="font-size: 15px;"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(3, 'desc')" style="font-size: 15px;"></i>    
                        </th>
                        <th scope="col" style="word-spacing: 5px;">
                            Status 
                            <i class="bi bi-arrow-up" onclick="sortTable(4, 'asc')" style="font-size: 15px;"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(4, 'desc')" style="font-size: 15px;"></i>    
                        </th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td>
                                @if ($data->level->level=="Member")
                                        <span class="badge rounded-pill text-bg-secondary">{{ $data->level->level }}</span>
                                    @elseif($data->level->level=="DPUK")
                                        <span class="badge rounded-pill text-bg-info">{{ $data->level->level }}</span>
                                    @elseif($data->level->level=="Keuangan")
                                        <span class="badge rounded-pill text-bg-warning">{{ $data->level->level }}</span>
                                    @elseif($data->level->level=="Super Admin")
                                        <span class="badge rounded-pill text-bg-success">{{ $data->level->level }}</span>
                                @endif
                            </td>
                            <td>{{ $data->email }}</td>
                            <td>
                                @if ($data->status=='Perlu dilengkapi')
                                    <span class="badge rounded-pill text-bg-danger">{{ $data->status }}</span>
                                @elseif ($data->status=='Sedang diverifikasi')
                                    <span class="badge rounded-pill text-bg-info">{{ $data->status }}</span>
                                @elseif ($data->status=='Diverifikasi')
                                    <span class="badge rounded-pill text-bg-success">{{ $data->status }}</span>
                                @elseif ($data->status=='Perlu pembaharuan')
                                    <span class="badge rounded-pill text-bg-warning">{{ $data->status }}</span>
                                @elseif ($data->status=='Memohon perubahan')
                                    <span class="badge rounded-pill text-bg-secondary">{{ $data->status }}</span>
                                @elseif ($data->status=='Permohonan perubahan disetujui')
                                    <span class="badge rounded-pill text-bg-primary">{{ $data->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/register/{{ $data->id }}" class="btn btn-info"><i class="bi bi-eye"></i> Detail</a>
                                    <a href="/register/{{ $data->id }}/edit" class="btn btn-success"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <form action="/register/{{ $data->id }}" method="POST">
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

