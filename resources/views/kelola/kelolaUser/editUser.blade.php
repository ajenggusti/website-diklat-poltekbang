@extends('layout.mainAdmin')
@section('container')
    <h2>Form Mengubah Level User</h2>
    
    <form method="POST" action="/register/{{ $user->id }}" >
        @method('put')
        @csrf        
        {{-- editprofil --}}
        <select name="id_level" class="form-select" aria-label="Default select example">
            <option selected disabled>Ingin mengubah level user?</option>
            @foreach ($levels as $level)
                <option value="{{ $level->id }}" {{ old('id_level', $user->id_level) == $level->id ? 'selected' : '' }}>
                    {{ $level->level }}
                </option>
            @endforeach
        </select>
        
        <div class="mb-3">
            <label for="jenis_berkas" class="form-label">Jenis berkas yang dipilih user : </label>
            <select name="jenis_berkas" id="jenis_berkas" class="form-select" disabled>
                <option value="ktp" {{ old('jenis_berkas', $user->jenis_berkas) == 'ktp' ? 'selected' : '' }}>KTP</option>
                <option value="paspor" {{ old('jenis_berkas', $user->jenis_berkas) == 'paspor' ? 'selected' : '' }}>Paspor</option>
            </select>
        </div>
        <input type="hidden" name="jenis_berkas" value="{{ $user->jenis_berkas }}">
        <br>
        <div class="mb-3">
            <label for="img" class="form-label">Berkas pendukung user : </label><br>
            <img src="{{ asset('storage/' . $user->berkas_pendukung) }}" class="img-preview img-fluid" style="width: 20%;">
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

  
      <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Pilih jenis kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
            <option value="" selected disabled>Pilih jenis kelamin</option>
            <option value="p" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'p' ? 'selected' : '' }}>Perempuan</option>
            <option value="l" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'l' ? 'selected' : '' }}>Laki-laki</option>
        </select>
        @error('jenis_kelamin')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
        <br>   
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label is">tempat lahir</label>
            <input type="text" class="form-control  @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name= "tempat_lahir" value="{{ old('tempat_lahir') ?: $user->tempat_lahir}}">
            @error('tempat_lahir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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
        <select class="form-select single-select-field" name="id_nationality" id="nationality" data-placeholder="Pilih nationality">
            <option></option>
            @foreach ($nationalities as $nationality)
                <option value="{{ $nationality->id }}" @if($nationality->id == $user->id_nationality) selected @endif>{{ $nationality->name }}</option>
            @endforeach
        </select>
        @error('id_nationality')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <br>
        {{-- alamat --}}
        <label for="provinsi">Provinsi:</label>
        <select class="form-select single-select-field @error('id_provinsi') is-invalid @enderror" name="id_provinsi" id="provinsi" data-placeholder="Pilih provinsi">
            <option></option>
            @foreach ($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
            @endforeach
        </select>
        @error('id_provinsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <br>
        <label for="kabupaten">Kabupaten:</label>
        <select class="form-select single-select-field @error('id_kabupaten') is-invalid @enderror" name="id_kabupaten" id="kabupaten" data-placeholder="Pilih Kabupaten">
            <option></option>
        </select>
        @error('id_kabupaten')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <br>
        <label for="kecamatan">Kecamatan:</label>
        <select class="form-select single-select-field @error('id_kecamatan') is-invalid @enderror" name="id_kecamatan" id="kecamatan" data-placeholder="Pilih kecamatan">
            <option></option>
        </select>
        @error('id_kecamatan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <br>
        <label for="kelurahan">Kelurahan:</label>
        <select class="form-select single-select-field @error('id_kelurahan') is-invalid @enderror" name="id_kelurahan" id="kelurahan" data-placeholder="Pilih kelurahan">
            <option></option>
        </select>
        @error('id_kelurahan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if ($user->permohonan_ubah)
            Pesan permohonan perubahan data : <br>
            {{ $user->permohonan_ubah }}
        @endif
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                <option value="" selected disabled>Pilih status</option>
                <option value="Perlu dilengkapi" {{ old('status', $user->status) == 'Perlu dilengkapi' ? 'selected' : '' }}>Perlu dilengkapi</option>
                <option value="Sedang diverifikasi" {{ old('status', $user->status) == 'Sedang diverifikasi' ? 'selected' : '' }}>Sedang diverifikasi</option>
                <option value="Diverifikasi" {{ old('status', $user->status) == 'Diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                <option value="Perlu pembaharuan" {{ old('status', $user->status) == 'Perlu pembaharuan' ? 'selected' : '' }}>Perlu pembaharuan</option>
                <option value="Memohon perubahan" {{ old('status', $user->status) == 'Memohon perubahan' ? 'selected' : '' }}>Memohon perubahan</option>
                <option value="Permohonan perubahan disetujui" {{ old('status', $user->status) == 'Permohonan perubahan disetujui' ? 'selected' : '' }}>Permohonan perubahan disetujui</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
       
        <br>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>  

    <!-- Pastikan jQuery dimuat -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        
        $('#jenis_berkas').on('change', function() {
        // Hapus semua pesan kesalahan pada form
        $('.invalid-feedback').remove();
        // Hapus kelas is-invalid dari semua input/select
        $('input, select').removeClass('is-invalid');
    });
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: function() {
                return $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style';
            },
            placeholder: function() {
                return $(this).data('placeholder');
            },
        });

        function fillDropdown(url, id, targetSelector, selectedValue) {
            return $.ajax({
                url: url + '/' + id,
                type: 'GET',
                success: function(data) {
                    let target = $(targetSelector);
                    target.empty().attr('disabled', false);
                    target.append($('<option>', { value: '', text: target.data('placeholder') }));
                    $.each(data, function(key, value) {
                        // console.log(key,value);
                        let option = $('<option>', { value: key, text: value });
                        target.append(option);
                    });
                    if (selectedValue) {
                        target.val(selectedValue).trigger('change');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        }

        fillDropdown('{{ URL::to('provinsi-dropdown') }}', '', '#provinsi', '{{ $user->id_provinsi - 1 }}')
            .then(function() {
                return fillDropdown('{{ URL::to('kabupaten-dropdown') }}', '{{ $user->id_provinsi }}', '#kabupaten', '{{ $user->id_kabupaten }}');
            })
            .then(function() {
                return fillDropdown('{{ URL::to('kecamatan-dropdown') }}', '{{ $user->id_kabupaten }}', '#kecamatan', '{{ $user->id_kecamatan }}');
            })
            .then(function() {
                return fillDropdown('{{ URL::to('kelurahan-dropdown') }}', '{{ $user->id_kecamatan }}', '#kelurahan', '{{ $user->id_kelurahan }}');
            });
        $('#provinsi').on('change', function() {
            $('#kelurahan').empty().prop('disabled', true);
                $('#kecamatan').empty().prop('disabled', true);
        fillDropdown('{{ URL::to('kabupaten-dropdown') }}', parseInt($(this).val()) + 1, '#kabupaten');
        });

        $('#kabupaten').on('change', function() {
            // $('#kabupaten').empty().prop('disabled', false);
                    $('#kecamatan').empty().prop('disabled', true);
            fillDropdown('{{ URL::to('kecamatan-dropdown') }}', $(this).val(), '#kecamatan');
        });

        $('#kecamatan').on('change', function() {
            fillDropdown('{{ URL::to('kelurahan-dropdown') }}', $(this).val(), '#kelurahan');
        });

        var jenisBerkasSelect = $('#jenis_berkas');
        var provinsiSelect = $('#provinsi');
        var kabupatenSelect = $('#kabupaten');
        var kecamatanSelect = $('#kecamatan');
        var kelurahanSelect = $('#kelurahan');
        var jenisBerkasSelect = $('#jenis_berkas');
        var nationalitySelect = $('#nationality');
        var provinsiSelect = $('#provinsi');
        var kabupatenSelect = $('#kabupaten');
        var kecamatanSelect = $('#kecamatan');
        var kelurahanSelect = $('#kelurahan');
        var nikInput = $('#nik');
        var noPasporInput = $('#no_paspor');
        var tempatLahirInput = $('#tempat_lahir');
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
        var tempatLahirLabel = $('label[for="tempat_lahir"]');

        function handleVisibility() {
            var selectedJenisBerkas = jenisBerkasSelect.val();
            if (selectedJenisBerkas === 'ktp') {
                nationalitySelect.next('.select2').hide();
                nationalityLabel.hide();
                tglExpPasporInput.hide();
                tempatLahirInput.show();
                tglExpPasporLabel.hide();
                noPasporInput.hide();
                noPasporLabel.hide();
                provinsiSelect.next('.select2').show();
                kabupatenSelect.next('.select2').show();
                kecamatanSelect.next('.select2').show();
                kelurahanSelect.next('.select2').show();
                provinsiLabel.show();
                kabupatenLabel.show();
                kelurahanLabel.show();
                kecamatanLabel.show();
                tempatLahirLabel.show();
                nikInput.show();
                nikLabel.show();
            } else {
                nationalitySelect.next('.select2').show();
                nationalityLabel.show();
                noPasporInput.show();
                noPasporLabel.show();
                tglExpPasporInput.show();
                tglExpPasporLabel.show();
                tempatLahirInput.hide();
                provinsiSelect.next('.select2').hide();
                kabupatenSelect.next('.select2').hide();
                kecamatanSelect.next('.select2').hide();
                kelurahanSelect.next('.select2').hide();
                provinsiLabel.hide();
                kabupatenLabel.hide();
                kelurahanLabel.hide();
                kecamatanLabel.hide();
                nikInput.hide();
                nikLabel.hide();
                tempatLahirLabel.hide();
            }
        }

        handleVisibility();
        jenisBerkasSelect.on('change', function() {
            handleVisibility();
        });
    });

</script>
<!-- Muat Bootstrap dan Bootstrap Datepicker -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

@endsection

