@extends('layout.mainAdmin')
@section('container')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola User</title>
    <link href="/css/actor.css" rel="stylesheet">
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
    <div class="content-form">
        <div class="form-column-left">
            <form action="{{ route('pendaftaranAsAdmin.update', ['id' => $kelPendaftaran->id]) }}" method="POST" enctype="multipart/form-data" id="formPendaftaran" >
                @method('PUT')
                @csrf
                <h2>Identitas Pendaftar</h2>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <th>Diklat yang dipilih</th>
                            <td>{{ $kelPendaftaran->diklat->nama_diklat }}</td>
                        </tr>
                        <tr>
                            <th>Harga Diklat</th>
                            <td>Rp {{ isset($harga) ? number_format($harga) : number_format($kelPendaftaran->diklat->harga) }}</td>
                        </tr>
                        <tr>
                            <th>Kode Promo</th>
                            <td>
                                @if ($kelPendaftaran->id_promo)
                                    {{ $kelPendaftaran->promo->kode }}
                                @else
                                    Tidak ada kode promo yang diambil.
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Potongan Harga Dari Voucher</th>
                            <td>
                                @if($kelPendaftaran->id_promo && $kelPendaftaran->promo)
                                -Rp {{ $kelPendaftaran->promo->potongan }}
                                @else
                                    -0
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Total Biaya</th>
                            <td>Rp {{ isset($harga) ? number_format($harga) : number_format($kelPendaftaran->harga_diklat) }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $kelPendaftaran->email }}</td>
                        </tr>
                    
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $kelPendaftaran->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td>{{ $kelPendaftaran->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ \Carbon\Carbon::parse($kelPendaftaran->tanggal_lahir)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $kelPendaftaran->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Pendidikan Terakhir</th>
                            <td>{{ $kelPendaftaran->pendidikan_terakhir }}</td>
                        </tr>
                        <tr>
                            <th>Nomor HP</th>
                            <td>{{ $kelPendaftaran->no_hp }}</td>
                        </tr>
                        @if ($kelPendaftaran->bukti_pembayaran)
                            <tr>
                                <th>Bukti pembayaran</th>
                                <td><img style="width: 30%" src="{{ asset('storage/' . $kelPendaftaran->bukti_pembayaran) }}" alt=""></td>
                            </tr>
                        @endif
                    
                    </table>
                </div>
            </form>
        </div>
            <div class="form-column-right">
                    <form action="" class="edit-user">
                        <h2>Form Edit Pendaftaran Admin</h2>
                        <hr>
                        <div class="mb-3">
                            <label for="status_pembayaran_diklat" class="form-label">Status Pembayaran Diklat</label>
                            <select class="form-select" id="status_pembayaran_diklat" name="status_pembayaran_diklat">
                                <option value="Lunas" {{ old('status_pembayaran_diklat', $kelPendaftaran->status_pembayaran_diklat) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="Menunggu pembayaran" {{ old('status_pembayaran_diklat', $kelPendaftaran->status_pembayaran_diklat) == 'Menunggu pembayaran' ? 'selected' : '' }}>Menunggu pembayaran</option>
                                <option value="Menunggu verifikasi" {{ old('status_pembayaran_diklat', $kelPendaftaran->status_pembayaran_diklat) == 'Menunggu verifikasi' ? 'selected' : '' }}>Menunggu verifikasi</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="potongan" class="form-label is">Potongan untuk diklat dari admin</label>
                            <input type="text" class="form-control @error('potongan') is-invalid @enderror" id="potongan" name="potongan" value="{{ old('potongan') }}">
                            @error('potongan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="total_harga" class="form-label is">Total harga untuk diklat</label>
                            <input type="text" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga" name="total_harga" value="{{ old('total_harga', 'Rp ' . number_format($kelPendaftaran->harga_diklat, 0, ',', '.')) }}" readonly>
                            @error('total_harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


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
                            <label for="s_link" class="form-label">Upload sertifikat peserta menggunakan Link</label>
                            <input type="text" class="form-control @error('s_link') is-invalid @enderror" id="s_link" name="s_link" value="{{ old('s_link', $kelPendaftaran->s_link) }}">
                            @error('s_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $kelPendaftaran->s_gambar) }}" class="img-preview img-fluid" style="width: 550px;">
                            <label for="s_gambar" class="form-label">Upload sertifikat peserta menggunakan gambar</label>
                            <input name="s_gambar" onchange="previewImage()" class="form-control @error('s_gambar') is-invalid @enderror" type="file" id="s_gambar">
                            @error('s_gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Input untuk s_doc -->
                        <div class="mb-3">
                            <label for="s_doc" class="form-label">Upload sertifikat peserta menggunakan dokumen</label>
                            <input name="s_doc" onchange="previewImage()" class="form-control @error('s_doc') is-invalid @enderror" type="file" id="s_doc">
                            @error('s_doc')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="file-sebelumnya">
                                <p>File sebelumnya: <a href="{{ asset('storage/' . $kelPendaftaran->s_doc) }}">Klik untuk melihat file!</a></p>
                            </div>
                        </div>
                        <div class="submit-button">
                            <button type="submit" class="btn btn-primary">Kirim</button>
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
</body>
</html> 
@endsection

    

