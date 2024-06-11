@extends('layout.mainUser')
@section('title', 'Staff | Form Kelola Pembayaran')
@section('container')
    <link href="/css/actor.css" rel="stylesheet">
    <script src="/js/actor.js"></script>

    <div class="content-form">
        <form action="/kelPendaftaran" method="post" enctype="multipart/form-data" id="formPendaftaran">
            @csrf
            <h2>Form Kelola Pembayaran</h2>
            <hr>
            <h2 style="color: chocolate">Informasi Pembayaran</h2>
            <div class="mb-3">
                <label for="img" class="form-label">Bukti Pembayaran</label><br>
                <img src="{{ asset('storage/' . $kelPembayaran->bukti_pembayaran) }}" class="img-preview img-fluid" style="width: 20%;">
            </div>
            <br>
            <div class="mb-3">
                <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-select" disabled>
                    <option value="" disabled>Pilih Jenis Pembayaran</option>
                    <option value="diklat" {{ $kelPembayaran->jenis_pembayaran == 'diklat' ? 'selected' : '' }}>Diklat</option>
                    <option value="pendaftaran" {{ $kelPembayaran->jenis_pembayaran == 'pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                </select>
                <input type="hidden" name="jenis_pembayaran_value" value="{{ $kelPembayaran->jenis_pembayaran }}">
            </div>
            
            <br>
            
            <div class="mb-3">
                <label for="harga" class="form-label is">Harga Diklat</label>
                <input type="hidden" name="harga" value="{{ isset($harga) ? $harga : $kelPembayaran->pendaftaran->diklat->harga }}">
                <input type="text" class="form-control" id="harga_diklat" value="Rp {{ isset($harga) ? number_format($harga) : number_format($kelPembayaran->pendaftaran->harga_diklat) }}" disabled>
            </div>
            
            <div class="mb-3">
                <label for="status_pembayaran_daftar">Status Pembayaran Diklat</label>
                <select name="status_pembayaran_diklat" id="status_pembayaran_diklat" class="form-select" required>
                    <option value="" disabled selected>Pilih Status Pembayaran Diklat</option>
                    <option value="Lunas" {{ ($kelPembayaran->pendaftaran && $kelPembayaran->pendaftaran->status_pembayaran_diklat == 'Lunas') ? 'selected' : '' }}>Lunas</option>
                    <option value="Belum dibayar" {{ ($kelPembayaran->pendaftaran && $kelPembayaran->pendaftaran->status_pembayaran_diklat == 'Belum dibayar') ? 'selected' : '' }}>Belum dibayar</option>
                    <option value="Dicek" {{ ($kelPembayaran->pendaftaran && $kelPembayaran->pendaftaran->status_pembayaran_diklat == 'Dicek') ? 'selected' : '' }}>Dicek</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="harga" class="form-label is">Harga Pendaftaran</label>
                <input type="text" class="form-control" id="harga_pendaftaran" value="Rp 150.000" disabled>
            </div>
            
            <div class="mb-3">
                <label for="status_pembayaran_daftar">Status Pembayaran Penndaftaran</label>
                <select name="status_pembayaran_daftar" id="status_pembayaran_daftar" class="form-select" required>
                    <option value="" disabled selected>Pilih Status Pembayaran Pendaftaran</option>
                    <option value="Lunas" {{ ($kelPembayaran->pendaftaran && $kelPembayaran->pendaftaran->status_pembayaran_daftar == 'Lunas') ? 'selected' : '' }}>Lunas</option>
                    <option value="Belum dibayar" {{ ($kelPembayaran->pendaftaran && $kelPembayaran->pendaftaran->status_pembayaran_daftar == 'Belum dibayar') ? 'selected' : '' }}>Belum dibayar</option>
                    <option value="Dicek" {{ ($kelPembayaran->pendaftaran && $kelPembayaran->pendaftaran->status_pembayaran_daftar == 'Dicek') ? 'selected' : '' }}>Dicek</option>
                </select>
            </div>
            
            
            <br>
            <div class="mb-3">
                <label for="file" class="form-label is">Upload sertifikat disini</label>
                <input name="img" class="form-control @error('img') is-invalid @enderror" type="file" id="file" >
                <small class="text-muted">Upload file sertifikat peserta (PDF, DOC, DOCX).</small>
                @error('img')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <br>
            {{-- -------------------------------informasi pendaftaran--------------------------------------------------- --}}
            <h2 style="color: chocolate">Informasi pendaftaran</h2>
            <div class="mb-3">
                <label for="diklat">Diklat yang dipilih</p>
                <select name="diklat" class="form-select" aria-label="Default select example" disabled>
                    <option selected disabled>Pilih Diklat</option>
                    @foreach ($dtDiklats as $diklats)
                        <option value="{{ $diklats->id }}" {{ old('diklat', $kelPembayaran->pendaftaran->diklat->id) == $diklats->id ? 'selected' : '' }}>
                            {{ $diklats->nama_diklat }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="diklat" value="{{ old('diklat',  $kelPembayaran->pendaftaran->diklat->id) }}">
            </div>
            <br>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="hidden" name="email" value="{{ old('email') ?:$kelPembayaran->pendaftaran->email }}">
                <input type="text" class="form-control" value="{{ old('email') ?:$kelPembayaran->pendaftaran->email }}" disabled>
            </div>
            
            <br>
            
            <div class="mb-3">
                <label for="kode" class="form-label">Kode Promo (Opsional)</label>
                <input type="hidden" name="kode" value="{{$kelPembayaran->pendaftaran->promo ?$kelPembayaran->pendaftaran->promo->kode : 'Tidak ada promo yang diambil' }}">
                <input type="text" class="form-control" value="{{$kelPembayaran->pendaftaran->promo ?$kelPembayaran->pendaftaran->promo->kode : 'Tidak ada promo yang diambil' }}" disabled>
                <small class="text-muted">Kode promo yang sudah dimasukkan tidak dapat diubah.</small>
            </div>
            
            <br>
            
            <div class="mb-3">
                <label for="nama_depan" class="form-label is">Nama Depan</label>
                <input type="hidden" name="nama_depan" value="{{ old('nama_depan') ?:$kelPembayaran->pendaftaran->nama_depan }}">
                <input type="text" class="form-control" value="{{ old('nama_depan') ?:$kelPembayaran->pendaftaran->nama_depan }}" disabled>
            </div>
            
            <div class="mb-3">
                <label for="nama_belakang" class="form-label is">Nama belakang</label>
                <input type="hidden" name="nama_belakang" value="{{ old('nama_belakang') ?:$kelPembayaran->pendaftaran->nama_belakang }}">
                <input type="text" class="form-control" value="{{ old('nama_belakang') ?:$kelPembayaran->pendaftaran->nama_belakang }}" disabled>
            </div>
            
            <br>
            <br>
            
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat lahir</label>
                <input type="hidden" name="tempat_lahir" value="{{ old('tempat_lahir') ?:$kelPembayaran->pendaftaran->tempat_lahir }}">
                <input type="text" class="form-control" value="{{ old('tempat_lahir') ?:$kelPembayaran->pendaftaran->tempat_lahir }}" disabled>
            </div>
            
            <div class="form-group mb-3"> <!-- Date input -->
                <label class="control-label" for="tgl_awal">Tanggal Lahir </label>
                <input type="hidden" name="tgl_awal" value="{{ old('tgl_awal') ?:$kelPembayaran->pendaftaran->tanggal_lahir }}">
                <input class="form-control" value="{{ old('tgl_awal') ?:$kelPembayaran->pendaftaran->tanggal_lahir }}" disabled>
            </div>
            
            <br>
            
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="hidden" name="alamat" value="{{ old('alamat') ?:$kelPembayaran->pendaftaran->alamat }}">
                <textarea class="form-control" rows="4" disabled>{{ old('alamat') ?:$kelPembayaran->pendaftaran->alamat }}</textarea>
            </div>
            
            
            <div class="mb-3">
                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                <input type="hidden" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir') ?:$kelPembayaran->pendaftaran->pendidikan_terakhir }}">
                <input type="text" class="form-control" value="{{ old('pendidikan_terakhir') ?:$kelPembayaran->pendaftaran->pendidikan_terakhir }}" disabled>
            </div>
            
            <br>
            
            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="hidden" name="no_hp" value="{{ old('no_hp') ?:$kelPembayaran->pendaftaran->no_hp }}">
                <input type="text" class="form-control" value="{{ old('no_hp') ?:$kelPembayaran->pendaftaran->no_hp }}" disabled>
            </div>

            
            <div class="submit-button"></div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const jenis_pembayaran = document.getElementById('jenis_pembayaran');
            const status_pembayaran_diklat = document.getElementById('status_pembayaran_diklat');
            const status_pembayaran_daftar = document.getElementById('status_pembayaran_daftar');
            const harga_diklat = document.getElementById('harga_diklat');
            const harga_pendaftaran = document.getElementById('harga_pendaftaran');
            function updateStatus() {
                if (jenis_pembayaran.value === 'diklat') {
                    status_pembayaran_daftar.disabled = true;
                    status_pembayaran_diklat.disabled = false;
                } else if (jenis_pembayaran.value === 'pendaftaran') {
                    status_pembayaran_diklat.disabled = true;
                    status_pembayaran_daftar.disabled = false;
                }
            }
            jenis_pembayaran.addEventListener('change', updateStatus);

            updateStatus();
        });
    </script>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Include jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

@endsection

    

