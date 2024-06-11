@extends('layout.mainAdmin')
@section('title', 'DPUK | Edit Pendaftaran User')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">

    <div class="content-form">
        <div class="form-column-left">
            <form action="{{ route('pendaftaranAsAdmin.update', ['id' => $kelPendaftaran->id]) }}" method="POST" enctype="multipart/form-data" id="formPendaftaran">
            {{-- <form action="{{ route('pendaftaranAsAdmin.update', ['id' => $kelPendaftaran->id]) }}" method="POST" enctype="multipart/form-data" id="formPendaftaran" > --}}
                @method('PUT')
                @csrf
                <h2>Identitas Pendaftar</h2>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <th>Jenis berkas</th>
                            <td>{{ $kelPendaftaran->user->jenis_berkas}}</td>
                        </tr>
                        <tr>
                            <th>Nama User</th>
                            <td>{{ $kelPendaftaran->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Pendidikan Terakhir</th>
                            <td>{{ $kelPendaftaran->pendidikan_terakhir}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $kelPendaftaran->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Nomor telepon</th>
                            <td>{{ $kelPendaftaran->no_hp }}</td>
                        </tr>
                        @if ($kelPendaftaran->user->jenis_berkas == "paspor")
                            <tr>
                                <th>Nomor paspor</th>
                                <td>{{ $kelPendaftaran->user->no_paspor }}</td>
                            </tr>
                            <tr>
                                <th>Nationality</th>
                                <td>{{ $kelPendaftaran->user->Nationality->name }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ \Carbon\Carbon::parse($kelPendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</td>
                            </tr>
                        @else
                            <tr>
                                <th>NIK</th>
                                <td>{{ $kelPendaftaran->user->nik }}</td>
                            </tr>
                            <tr>
                                <th>Tempat | Tanggal Lahir</th>
                                <td>{{ $kelPendaftaran->user->tempat_lahir }} | {{ \Carbon\Carbon::parse($kelPendaftaran->user->tanggal_lahir)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>Kelurahan {{ $kelPendaftaran->user->kelurahan->name }}, Kecamatan {{ $kelPendaftaran->user->kecamatan->name }}, Kabupaten {{ $kelPendaftaran->user->kabupaten->name }}, Provinsi {{ $kelPendaftaran->user->provinsi->name }}</td>
                            </tr>
                        @endif
                        {{-- data diklat --}}
                        <tr>
                            <th>Nama diklat</th>
                            <td>{{ $kelPendaftaran->diklat->nama_diklat }}</td>
                        </tr>
                        <tr>
                            <th>Harga pendaftaran</th>
                            <td>Rp 150.000</td>
                        </tr>
                        <tr>
                            <th>Status Pembayaran Daftar</th>
                            @if ($kelPendaftaran->status_pembayaran_daftar=="Lunas")
                                <td><span class="badge badge-pill badge-success">{{ $kelPendaftaran->status_pembayaran_daftar }}</span></td>
                            @elseif($kelPendaftaran->status_pembayaran_daftar=="Menunggu verifikasi")
                                <td><span class="badge badge-pill badge-warning">{{ $kelPendaftaran->status_pembayaran_daftar }}</span></td>
                            @elseif($kelPendaftaran->status_pembayaran_daftar=="kadaluarsa")
                                <td><span class="badge badge-pill badge-dark">{{ $kelPendaftaran->status_pembayaran_daftar }}</span></td>
                            @else
                                <td><span class="badge badge-pill badge-danger">{{ $kelPendaftaran->status_pembayaran_daftar }}</span></td>
                            @endif
                        </tr>
                        <tr>
                            <th>Harga diklat : </th>
                            <td>Rp {{ number_format($kelPendaftaran->harga_asli_diklat, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Kode Promo</th>
                            @if ($kelPendaftaran->id_promo)
                                <td>{{ $kelPendaftaran->promo->kode }}</td>
                            @else
                                <td>Tidak mengambil promo.</td>
                            @endif
                            
                        </tr>
                        <tr>
                            <th>Diskon promo : </th>
                            <td>-Rp {{ number_format($kelPendaftaran->potongan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Diskon admin : </th>
                            <td>-Rp {{ number_format($kelPendaftaran->potongan_admin, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Total harga diklat : </th>
                            <td>Rp {{ number_format($kelPendaftaran->harga_diklat, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Status Pembayaran Diklat</th>
                            @if ($kelPendaftaran->status_pembayaran_diklat=="Lunas")
                                <td><span class="badge badge-pill badge-success">{{ $kelPendaftaran->status_pembayaran_diklat }}</span></td>
                            @elseif($kelPendaftaran->status_pembayaran_diklat=="Menunggu verifikasi")
                                <td><span class="badge badge-pill badge-warning">{{ $kelPendaftaran->status_pembayaran_diklat }}</span></td>
                            @elseif($kelPendaftaran->status_pembayaran_diklat=="kadaluarsa")
                                <td><span class="badge badge-pill badge-dark">{{ $kelPendaftaran->status_pembayaran_diklat }}</span></td>
                            @else
                                <td><span class="badge badge-pill badge-danger">{{ $kelPendaftaran->status_pembayaran_diklat }}</span></td>
                            @endif
                        </tr>
                        
                        {{-- ==================================================================== --}}
                        @if ($kelPendaftaran->bukti_pembayaran)
                            <tr>
                                <th>Bukti pembayaran</th>
                                <td><img class="img-preview img-fluid" src="{{ asset('storage/' . $kelPendaftaran->bukti_pembayaran) }}" alt=""></td>
                            </tr>
                        @endif
                    
                    </table>
                </div>
            {{-- </form> --}}
        </div>
            <div class="form-column-right">
                    {{-- <form action="" class="edit-user"> --}}
                    <div class="edit-user">
                        <h2>Form Edit Pendaftaran Admin</h2>
                        <hr>
                        {{-- <div class="mb-3">
                            <label for="status_pembayaran_diklat" class="form-label">Status Pembayaran Diklat</label>
                            <select class="form-select" id="status_pembayaran_diklat" name="status_pembayaran_diklat">
                                <option value="Lunas" {{ old('status_pembayaran_diklat', $kelPendaftaran->status_pembayaran_diklat) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="Menunggu pembayaran" {{ old('status_pembayaran_diklat', $kelPendaftaran->status_pembayaran_diklat) == 'Menunggu pembayaran' ? 'selected' : '' }}>Menunggu pembayaran</option>
                                <option value="Menunggu verifikasi" {{ old('status_pembayaran_diklat', $kelPendaftaran->status_pembayaran_diklat) == 'Menunggu verifikasi' ? 'selected' : '' }}>Menunggu verifikasi</option>
                                <option value="Ditolak" {{ old('status_pembayaran_diklat', $kelPendaftaran->status_pembayaran_diklat) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="potongan" class="form-label is">Potongan untuk Diklat dari Admin</label>
                            <input type="text" class="form-control @error('potongan') is-invalid @enderror" id="potongan" name="potongan" value="{{ old('potongan') }}">
                            @error('potongan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="total_harga" class="form-label is">Total Harga untuk Diklat</label>
                            <input type="text" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga" name="total_harga" value="{{ old('total_harga', 'Rp ' . number_format($kelPendaftaran->harga_diklat, 0, ',', '.')) }}" readonly>
                            @error('total_harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}


                        {{-- ========================================================================== --}}
                        <div class="mb-3">
                            <label for="metode_sertif" class="form-label">Metode Pengiriman Sertifikat</label>
                            <select class="form-select" id="metode_sertif" name="metode_sertif">
                                <option value="gambar" {{ old('metode_sertif', $kelPendaftaran->metode_sertif) == 'gambar' ? 'selected' : '' }}>Gambar</option>
                                <option value="link" {{ old('metode_sertif', $kelPendaftaran->metode_sertif) == 'link' ? 'selected' : '' }}>Link</option>
                                <option value="dokumen" {{ old('metode_sertif', $kelPendaftaran->metode_sertif) == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                            </select>
                        </div>
                        
                        
                        <div class="mb-3">
                            <label for="s_link" class="form-label">Upload Sertifikat Peserta menggunakan Link</label>
                            <input type="text" class="form-control @error('s_link') is-invalid @enderror" id="s_link" name="s_link" value="{{ old('s_link', $kelPendaftaran->s_link) }}">
                            @error('s_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="s_gambar" class="form-label">Upload Sertifikat Peserta menggunakan Gambar</label>
                            <img src="{{ asset('storage/' . $kelPendaftaran->s_gambar) }}" class="img-preview img-fluid">
                            <input name="s_gambar" onchange="previewImage()" class="form-control @error('s_gambar') is-invalid @enderror" type="file" id="s_gambar">
                            <small style="color: rgb(16, 126, 190)">Ukuran maksimal gambar 2 MB</small>
                            @error('s_gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Input untuk s_doc -->
                        <div class="mb-3">
                            <label for="s_doc" class="form-label">Upload Sertifikat Peserta menggunakan Dokumen</label>
                            <input name="s_doc" onchange="previewImage()" class="form-control @error('s_doc') is-invalid @enderror" type="file" id="s_doc">
                            <small style="color: rgb(16, 126, 190)">Dokumen berupa file PDF, DOC, DOCX</small>
                            @error('s_doc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                <div id="file-sebelumnya">
                                    <p>File sebelumnya: <a href="{{ asset('storage/' . $kelPendaftaran->s_doc) }}">Klik untuk Melihat File!</a></p>
                                </div>
                        </div>
                        <div class="submit-button">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
            </form>  
            </div>
    </div>
            <script>
                var potonganInput = document.getElementById('potongan');
                var totalHargaInput = document.getElementById('total_harga');
                potonganInput.addEventListener('input', function() {
                    var potonganValue = this.value.replace(/\D/g, '');
                    var hargaDiklat = {{ $kelPendaftaran->harga_diklat }};
                    var totalBiayaDipotong = hargaDiklat - parseInt(potonganValue);
                    totalHargaInput.value = formatCurrency(totalBiayaDipotong);
                });
                function formatCurrency(amount) {
                    var numberString = amount.toString();
                    var formattedAmount = numberString.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    return 'Rp ' + formattedAmount;
                }
            </script>
            
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var metodeSelect = document.getElementById('metode_sertif');
                    var linkInput = document.getElementById('s_link');
                    var gambarInput = document.getElementById('s_gambar');
                    var dokumenInput = document.getElementById('s_doc');
                    var linkLabel = document.querySelector('label[for="s_link"]');
                    var gambarLabel = document.querySelector('label[for="s_gambar"]');
                    var dokumenLabel = document.querySelector('label[for="s_doc"]');
                    var imgPreview = document.querySelector('.img-preview');
                    var tampilFile = document.getElementById('file-sebelumnya');
        
                    metodeSelect.addEventListener('change', function() {
                        linkInput.style.display = 'none';
                        gambarInput.style.display = 'none';
                        dokumenInput.style.display = 'none';
                        linkLabel.style.display = 'none';
                        gambarLabel.style.display = 'none';
                        dokumenLabel.style.display = 'none';
                        imgPreview.style.display = 'none';
                        tampilFile.style.display = 'none';
            
                        var selectedValue = this.value;
                        if (selectedValue === 'link') {
                            linkInput.style.display = 'block';
                            linkLabel.style.display = 'block';
                        } else if (selectedValue === 'gambar') {
                            gambarInput.style.display = 'block';
                            gambarLabel.style.display = 'block';
                            imgPreview.style.display = 'block';
                        } else if (selectedValue === 'dokumen') {
                            dokumenInput.style.display = 'block';
                            dokumenLabel.style.display = 'block';
                            tampilFile.style.display = 'block';
                        }
                    });
            
                    // Memanggil event change pada saat halaman dimuat untuk memastikan bahwa input field ditampilkan sesuai dengan pilihan default
                    metodeSelect.dispatchEvent(new Event('change'));
                });
            </script>
            
            
            
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            
            <!-- Include jQuery -->
            <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        
            <!-- Include Date Range Picker -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
        </div>
@endsection

    

