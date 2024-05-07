@extends('layout.mainUser')
@section('container')

hai {{ $user->name }}, Lengkapi datamu!

<br>
<h1>Kelengkapan Profil</h1>
    <form action="{{ route('updateProfil.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data" id="formPendaftaran">
        @method('put')
        @csrf

        <br>
        <div class="mb-3">
            <label for="jenis_berkas" class="form-label">Pilih jenis berkas:</label>
            <select name="jenis_berkas" id="jenis_berkas" class="form-select">
                <option value="ktp">KTP</option>
                <option value="paspor">Paspor</option>
            </select>
        </div>
        <br>
        <small class="text-muted">Jika kamu mengubah jenis berkas dari data yang kamu gunakan sebelumnya, data yang tersimpan akan terhapus. Dan admin akan memverifikasi ulang.</small>
        @error('jenis_berkas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <br>
        <div class="mb-3">
            <label for="img" class="form-label">Masukkan foto ktp/paspor</label>
            <img class="img-preview img-fluid" style="width: 20%;">
            <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
            @error('img')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div class="mb-3">
            <label for="name" class="form-label is">Nama Lengkap</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name= "name" value="{{ old('name') ?: $user->name}}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label is">Email</label>
            <input type="text" class="form-control  @error('email') is-invalid @enderror" id="email" name= "email" value="{{ old('email') ?: $user->email}}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nik" class="form-label is">NIK</label>
            <input type="text" class="form-control  @error('nik') is-invalid @enderror" id="nik" name= "nik" value="{{ old('nik') ?: $user->nik}}">
            @error('nik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div class="mb-3">
            <label for="no_paspor" class="form-label is">Nomor Paspor</label>
            <input type="text" class="form-control  @error('no_paspor') is-invalid @enderror" id="no_paspor" name= "no_paspor" value="{{ old('no_paspor') ?: $user->no_paspor}}">
            @error('no_paspor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
      <br>

        {{-- alamat --}}
        <label for="provinsi">Provinsi:</label>
        <select class="form-select single-select-field" name="id_provinsi" id="provinsi" data-placeholder="Pilih provinsi">
            <option></option>
            @foreach ($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
            @endforeach
        </select>
        
        <label for="kabupaten">Kabupaten:</label>
        <select class="form-select single-select-field" name="id_kabupaten" id="kabupaten" data-placeholder="Pilih Kabupaten">
            <option></option>
        </select>
        <label for="kecamatan">Kecamatan:</label>
        <select class="form-select single-select-field" name="id_kecamatan" id="kecamatan" data-placeholder="Pilih kecamatan">
            <option></option>
        </select>
        <label for="kelurahan">kelurahan:</label>
        <select class="form-select single-select-field" name="id_kelurahan" id="kelurahan" data-placeholder="Pilih kelurahan">
            <option></option>
        </select>
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label is">tempat lahir</label>
            <input type="text" class="form-control  @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name= "tempat_lahir" value="{{ old('tempat_lahir') ?: $user->tempat_lahir}}">
            @error('tempat_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Pilih jenis kelamin:</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                <option value="" selected disabled>Pilih jenis kelamin</option>
                <option value="p">Laki-laki</option>
                <option value="l">Perempuan</option>
            </select>
        </div>
        <br>             
        <div class="form-group mb-3">
            <label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
            <input class="form-control datepicker @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') ?? ($user->tgl_lahir ? \Carbon\Carbon::parse($user->tgl_lahir)->format('d-m-Y') : '') }}" id="tgl_lahir" name="tgl_lahir" placeholder="dd-mm-yyyy" type="text"/>
            @error('tgl_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label class="control-label" for="tgl_exp_paspor">Tanggal expired paspor</label>
            <input class="form-control datepicker @error('tgl_exp_paspor') is-invalid @enderror" value="{{ old('tgl_exp_paspor') ?? ($user->tgl_exp_paspor ? \Carbon\Carbon::parse($user->tgl_exp_paspor)->format('d-m-Y') : '') }}" id="tgl_exp_paspor" name="tgl_exp_paspor" placeholder="dd-mm-yyyy" type="text"/>
            @error('tgl_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <label for="nationality">Nationality:</label>
        <select class="form-select single-select-field" name="id_nationality"  id="nationality" data-placeholder="Pilih nationality">
            <option></option>
            @foreach ($nationalities as $nationality)
                <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Kirim</button>
        
    </form> 

<!-- Pastikan jQuery dimuat -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        function onChangeSelect(url, id, name) {
            $.ajax({
                url: url + '/' + id,
                type: 'GET',
                success: function(data) {
                    let target = $('#' + name);
                    target.attr('disabled', false);
                    target.empty()
                    target.attr('placeholder', target.data('placeholder'))
                    target.append(`<option> ${target.data('placeholder')} </option>`)
                    $.each(data, function(key, value) {
                        target.append(`<option value="${key}">${value}</option>`)
                    });
                }
            });
        }
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            placeholder: $(this).data('placeholder'),
        });

        $('#kabupaten').prop('disabled', true);
        $('#kecamatan').prop('disabled', true);
        $('#kelurahan').prop('disabled', true);
        $('#provinsi').on('change', function() {
            var id = $(this).val();
            var url = `{{ URL::to('kabupaten-dropdown') }}`;
            $('#kabupaten').empty().prop('disabled', false);
            $('#kecamatan').empty().prop('disabled', true);
            onChangeSelect(url, id, 'kabupaten');
        });
        $('#kabupaten').on('change', function() {
            var id = $(this).val();
            var url = `{{ URL::to('kecamatan-dropdown') }}`;
            $('#kecamatan').empty().prop('disabled', false);
            $('#kelurahan').empty().prop('disabled', true);
            onChangeSelect(url, id, 'kecamatan');
        });
        $('#kecamatan').on('change', function() {
            var id = $(this).val();
            var url = `{{ URL::to('kelurahan-dropdown') }}`;
            $('#kelurahan').empty().prop('disabled', false);
            onChangeSelect(url, id, 'kelurahan');
        });
       
        $(document).ready(function() {
            var jenisBerkasSelect = $('#jenis_berkas');
            var nationalitySelect = $('#nationality');
            var provinsiSelect = $('#provinsi');
            var kabupatenSelect = $('#kabupaten');
            var kecamatanSelect = $('#kecamatan');
            var kelurahanSelect = $('#kelurahan');
            var nikInput = $('#nik');
            var noPasporInput = $('#no_paspor');
            var tglExpPasporInput = $('#tgl_exp_paspor');
            var provinsiLabel = $('label[for="provinsi"]');
            var nikLabel = $('label[for="nik"]');
            var noPasporLabel = $('label[for="no_paspor"]');
            var provinsiLabel = $('label[for="provinsi"]');
            var kabupatenLabel = $('label[for="kabupaten"]');
            var kecamatanLabel = $('label[for="kecamatan"]');
            var kelurahanLabel = $('label[for="kelurahan"]');
            var nationalityLabel = $('label[for="nationality"]');
            var tglExpPasporLabel = $('label[for="tgl_exp_paspor"]');

            // Fungsi untuk menangani perubahan jenis berkas
            function handleVisibility() {
                var selectedJenisBerkas = jenisBerkasSelect.val();
                if (selectedJenisBerkas === 'ktp') {
                    nationalitySelect.next('.select2').hide();
                    nationalityLabel.hide()
                    tglExpPasporInput.hide()
                    tglExpPasporLabel.hide()
                    noPasporInput.hide()
                    noPasporLabel.hide()
                    provinsiSelect.next('.select2').show();
                    kabupatenSelect.next('.select2').show();
                    kecamatanSelect.next('.select2').show();
                    kelurahanSelect.next('.select2').show();
                    provinsiLabel.show()
                    kabupatenLabel.show()
                    kelurahanLabel.show()
                    kecamatanLabel.show()
                    nikInput.show()
                    nikLabel.show()
                } else {
                    nationalitySelect.next('.select2').show();
                    nationalityLabel.show()
                    noPasporInput.show()
                    noPasporLabel.show()
                    tglExpPasporInput.show()
                    tglExpPasporLabel.show()
                    provinsiSelect.next('.select2').hide();
                    kabupatenSelect.next('.select2').hide();
                    kecamatanSelect.next('.select2').hide();
                    kelurahanSelect.next('.select2').hide();
                    provinsiLabel.hide()
                    kabupatenLabel.hide()
                    kelurahanLabel.hide()
                    kecamatanLabel.hide()
                    nikInput.hide()
                    nikLabel.hide()
                }
            }
            handleVisibility();
            jenisBerkasSelect.on('change', function() {
                handleVisibility();
            });
        });
    });

</script>
<!-- Muat Bootstrap dan Bootstrap Datepicker -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    
@endsection