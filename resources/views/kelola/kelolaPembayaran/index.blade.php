@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
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
            <form id="tanggalForm">
                    <input type="text" class="datepicker" id="datepicker1" placeholder="Pilih tanggal">
                    <input type="text" class="datepicker" id="datepicker2" placeholder="Pilih tanggal">
                <a href="#" id="exportExcel" class="btn btn-primary"><i class="bi bi-filetype-xlsx"></i> Export by tanggal</a>
            </form>
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
                            <td>
                                @if ( $pembayaran->jenis_pembayaran=="pendaftaran")
                                    <span class="badge badge-pill badge-secondary">{{ $pembayaran->jenis_pembayaran }}</span>
                                @else
                                    <span class="badge badge-pill badge-success">{{ $pembayaran->jenis_pembayaran }}</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($pembayaran->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge badge-pill badge-primary">{{ $pembayaran->status }}</span>
                            </td>
                            <td>
                                <a href="/kelPembayaran/{{ $pembayaran->id }}" class="btn btn-info"><i class="bi bi-eye"></i></a>
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
        <p>Total Pemasuakan sesuai tanggal : <strong><span id="totalSum">Rp 0</span></strong></p>
        <p>Total pemasukan keseluruhan: <strong>{{ $formattedPemasukan }} <a class="btn btn-primary" href="/allLaporanExport"><i class="bi bi-filetype-xlsx"></i> All</a> </strong></p>

        {{-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                var rows = document.querySelectorAll("tbody tr");
                rows.forEach(function(row, index) {
                    var jenis_pembayaran = row.cells[3].textContent;
                    if (jenis_pembayaran === 'diklat') {
                        row.cells[6].style.display = "none";
                        row.cells[7].style.display = "none";
                    } else if (jenis_pembayaran === 'pendaftaran') {
                        row.cells[4].style.display = "none";
                        row.cells[5].style.display = "none";
                    }
                });
            });
        </script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        {{-- datepicker --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                orientation: "bottom right"
            });

            $('#exportExcel').on('click', function(event) {
                event.preventDefault();

                const tanggal1 = $('#datepicker1').val();
                const tanggal2 = $('#datepicker2').val();

                if (!tanggal1 || !tanggal2) {
                    alert('Silakan pilih kedua tanggal sebelum mengekspor.');
                    return;
                }

                const url = `/laporanExport/${encodeURIComponent(tanggal1)}.${encodeURIComponent(tanggal2)}`;
                window.location.href = url;
            });

            // Datepickers change event
            $('#datepicker1, #datepicker2').change(function() {
                filterData();
            });
// ============================================================
            function filterData() {
                const date1 = $('#datepicker1').val();
                const date2 = $('#datepicker2').val();

                console.log('Date 1:', date1);
                console.log('Date 2:', date2);

                if (date1 && date2) {
                    $.ajax({
                        url: '/filterPembayaran',
                        method: 'GET',
                        data: {
                            date1: date1,
                            date2: date2
                        },
                        success: function(response) {
                            if (response.error) {
                                alert(response.error);
                            } else {
                                $('#totalSum').text(response.totalSum);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            console.error('Response:', xhr.responseText);
                            alert('An error occurred: ' + xhr.status + ' ' + error);
                        }
                    });
                }
            }

        });

    </script>
</body>
</html>
@endsection
