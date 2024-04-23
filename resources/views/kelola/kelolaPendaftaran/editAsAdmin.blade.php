@extends('layout.mainAdmin')
@section('container')
    <h1>Identitas Pendaftar</h1>
    <form action="{{ route('pendaftaranAsAdmin.update', ['id' => $kelPendaftaran->id]) }}" method="POST" enctype="multipart/form-data" id="formPendaftaran">
        @method('PUT')
        @csrf
        <table class="table">
            <tr>
                <th>Diklat yang dipilih</th>
                <td>{{ $kelPendaftaran->diklat->nama_diklat }}</td>
            </tr>
            <tr>
                <th>Harga Diklat</th>
                <td>Rp {{ isset($harga) ? number_format($harga) : number_format($kelPendaftaran->diklat->harga) }}</td>
            </tr>
            <tr>
                <th>Potongan Harga</th>
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
            
        </table>
        <h1>Form Edit Admin</h1>
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
            <img src="{{ asset('storage/' . $kelPendaftaran->s_gambar) }}" class="img-preview img-fluid" style="width: 20%;">
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

        <button type="submit" class="btn btn-primary">Kirim</button>
        
    </form>  
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mengambil elemen-elemen form
            var metodeSelect = document.getElementById('metode_sertif');
            var linkInput = document.getElementById('s_link');
            var gambarInput = document.getElementById('s_gambar');
            var dokumenInput = document.getElementById('s_doc');
            var linkLabel = document.querySelector('label[for="s_link"]');
            var gambarLabel = document.querySelector('label[for="s_gambar"]');
            var dokumenLabel = document.querySelector('label[for="s_doc"]');
            var imgPreview = document.querySelector('.img-preview');
            var tampilFile = document.getElementById('file-sebelumnya');
    
            // Menambahkan event listener pada select box
            metodeSelect.addEventListener('change', function() {
                // Menyembunyikan semua input fields dan judul
                linkInput.style.display = 'none';
                gambarInput.style.display = 'none';
                dokumenInput.style.display = 'none';
                linkLabel.style.display = 'none';
                gambarLabel.style.display = 'none';
                dokumenLabel.style.display = 'none';
                imgPreview.style.display = 'none';
                tampilFile.style.display = 'none';
    
                // Menampilkan input field dan judul yang sesuai dengan pilihan yang dipilih
                var selectedValue = this.value;
                if (selectedValue === 'link') {
                    linkInput.style.display = 'block';
                    linkLabel.style.display = 'block';
                } else if (selectedValue === 'gambar') {
                    gambarInput.style.display = 'block';
                    gambarLabel.style.display = 'block';
                    imgPreview.style.display = 'block'; // Menampilkan img preview jika pilihan adalah gambar
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

@endsection