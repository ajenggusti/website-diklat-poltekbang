@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Testimoni</title>
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
    <div class="content-staff">
        <h2>Tabel Testimoni</h2>
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
            <tr>
                <th scope="col" style="width: 90px">No 
                    <i class="bi bi-arrow-up" onclick="sortTable(0, 'asc')"></i>
                    <i class="bi bi-arrow-down" onclick="sortTable(0, 'desc')"></i>
                </th>
                <th scope="col">Promo untuk 
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
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->pendaftaran->diklat->nama_diklat}}</td>
                <td>{{ $data->pendaftaran->nama_lengkap}}</td>
                <td>{{ $data->profesi }}</td>
                <td>{{ $data->testimoni }}</td>
                <td>{{ $data->tampil }}</td>

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
</body>
</html>
@endsection

