@extends('layout.mainAdmin')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">
    <script src="/js/actor.js"></script>
    
    <div class="content-staff">
        <h2>Log Activity</h2>
        <hr>
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
                        <th scope="col">user
                            <i class="bi bi-arrow-up" onclick="sortTable(1, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(1, 'desc')"></i>
                        </th>
                        <th scope="col">Deskripsi
                            <i class="bi bi-arrow-up" onclick="sortTable(2, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(2, 'desc')"></i>
                        </th>
                        <th scope="col">Sebelum
                            <i class="bi bi-arrow-up" onclick="sortTable(3, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(3, 'desc')"></i>
                        </th>
                        {{-- <th scope="col">Sesudah
                            <i class="bi bi-arrow-up" onclick="sortTable(4, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(4, 'desc')"></i>
                        </th> --}}
                        <th scope="col">Waktu
                            <i class="bi bi-arrow-up" onclick="sortTable(5, 'asc')"></i>
                            <i class="bi bi-arrow-down" onclick="sortTable(5, 'desc')"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>
                                @if ($data->causer_id != null)
                                    {{ $data->user->level->level }} - {{ $data->user->name }}
                                @elseif ($data->log_name == "Tabel user" && $data->description == "created")
                                    @if (isset($data->changes['attributes']['id']))
                                        <?php
                                            $user = App\Models\User::findOrFail($data->changes['attributes']['id']);
                                        ?>
                                        {{ $user->level->level }} - {{ $user->name }}
                                    @endif
                                @elseif($data->log_name == "Tabel pembayaran")
                                    @if (isset($data->changes['attributes']['id_pendaftaran']))
                                        <?php
                                            $pendaftaran = App\Models\Pendaftaran::findOrFail($data->changes['attributes']['id_pendaftaran']);
                                        ?>
                                       {{ $pendaftaran->user->level->level }} - {{ $pendaftaran->user->name }}
                                    @endif
                                @elseif($data->log_name == "Tabel pendaftaran")
                                    @if (isset($data->changes['attributes']['id_user']))
                                        <?php
                                            $pendaftaran = App\Models\User::findOrFail($data->changes['attributes']['id_user']);
                                        ?>
                                        {{ $user->level->level }} - {{ $user->name }}
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if ($data->description=="created")
                                    <span class="badge rounded-pill bg-primary">{{ $data->description }}</span> - {{ $data->log_name }}
                                @elseif($data->description=="updated")
                                    <span class="badge rounded-pill bg-warning">{{ $data->description }}</span> - {{ $data->log_name }}
                                @elseif($data->description=="deleted")
                                    <span class="badge rounded-pill bg-danger">{{ $data->description }}</span> - {{ $data->log_name }}
                                @else
                                    <span class="badge rounded-pill bg-secondary">{{ $data->log_name }}</span> - {{ $data->description }}
                                @endif
                            </td>
                            <td>
                                @if (@is_array($data->changes['old']))
                                    @foreach ($data->changes['old'] as $key => $itemChange)
                                        @if ($key !== 'created_at' && $key !== 'updated_at' && $itemChange!==null && $key !=="password" )
                                            {{ $key }} : {{ $itemChange }} <br>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if (@is_array($data->changes['attributes']))
                                    @foreach ($data->changes['attributes'] as $key => $itemChange)
                                        @if ($key !== 'created_at' && $key !== 'updated_at' && $itemChange!==null && $key !=="password")
                                            {{ $key }} : {{ $itemChange }} <br>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $data->updated_at->format('d-m-y | h:i:s') }}</td>

                            
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

