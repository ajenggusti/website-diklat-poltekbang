@extends('layout.mainUser')
@section('title', 'Profil')
@section('container')
    <link href="/css/editForUser.css" rel="stylesheet">

    <div class="content">
        <div class="bg-edit">
            <div class="content-editProfil">
                <form action="{{ route('updateProfil.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data" id="formPendaftaran" class="edit-profil">
                    @method('put')
                    @csrf
                    <h2>Kelengkapan Profil</h2>
                    <hr>
                    @if (session('success') )
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <h5>Hai {{ $user->name }}, Lengkapi datamu!</h5>
                
                    @if ($user->status)
                        <span style="color: rgb(16, 126, 190); font-weight: bold; font-size: 16px;">* Status biodatamu : 
                            <b style="text-transform: uppercase;">
                                @if ($user->status=='Perlu dilengkapi')
                                        <span class="badge badge-pill badge-danger">{{ $user->status }}</span>
                                    @elseif ($user->status=='Sedang diverifikasi')
                                        <span class="badge badge-pill badge-info">{{ $user->status }}</span>
                                    @elseif ($user->status=='Diverifikasi')
                                        <span class="badge badge-pill badge-success">{{ $user->status }}</span>
                                    @elseif ($user->status=='Perlu pembaharuan')
                                        <span class="badge badge-pill badge-warning">{{ $user->status }}</span>
                                    @elseif ($user->status=='Memohon perubahan')
                                        <span class="badge badge-pill badge-secondary">{{ $user->status }}</span>
                                    @elseif ($user->status=='Permohonan perubahan disetujui')
                                        <span class="badge badge-pill badge-primary">{{ $user->status }}</span>
                                    @endif
                            </b>
                            *</span>
                    @endif
                    <hr>
                    <div class="left-profil">
                        <div class="mb-3">
                            <label for="jenis_berkas" class="form-label">Pilih jenis berkas: <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <select name="jenis_berkas" id="jenis_berkas" class="form-select">
                                <option value="ktp" {{ old('jenis_berkas', $user->jenis_berkas) == 'ktp' ? 'selected' : '' }}>KTP</option>
                                <option value="paspor" {{ old('jenis_berkas', $user->jenis_berkas) == 'paspor' ? 'selected' : '' }}>Paspor</option>
                            </select>
                        </div>
                        @error('jenis_berkas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <br>
                        <div class="mb-3">
                            <label for="img" class="form-label">Gambar sebelumnya</label><br>
                            <img src="{{ asset('storage/' . $user->berkas_pendukung) }}" class="img-preview img-fluid" style="width: 550px;">
                        </div>
                        
                        <div class="mb-3">
                            <label for="img" class="form-label">Masukkan foto ktp/paspor <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <img class="img-preview img-fluid" style="width: 550px;">
                            <input name="img" onchange="previewImage()" class="form-control @error('img') is-invalid @enderror" type="file" id="img">
                            <small style="color: rgb(91, 91, 255)">Foto berukuran maksimal 2 MB</small>
                            @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label is">Nama Lengkap <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name= "name" value="{{ old('name') ?: $user->name}}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        
                    </div>

            
                    <div class="right-profil">
                       
                        {{-- <div class="mb-3">
                            <label for="email" class="form-label is">Email</label>
                            <input type="text" class="form-control  @error('email') is-invalid @enderror" id="email" name= "email" value="{{ old('email') ?: $user->email}}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                          
                        <div class="mb-3">
                            <label for="nik" class="form-label is">NIK <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <input type="text" class="form-control  @error('nik') is-invalid @enderror" id="nik" name= "nik" value="{{ old('nik') ?: $user->nik}}">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="no_paspor" class="form-label is">Nomor Paspor <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <input type="text" class="form-control  @error('no_paspor') is-invalid @enderror" id="no_paspor" name= "no_paspor" value="{{ old('no_paspor') ?: $user->no_paspor}}">
                            @error('no_paspor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Pilih jenis kelamin: <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="" selected disabled>Pilih jenis kelamin</option>
                                <option value="p" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'p' ? 'selected' : '' }}>Perempuan</option>
                                <option value="l" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'l' ? 'selected' : '' }}>Laki-laki</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                            
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label is">Tempat lahir <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <input type="text" class="form-control  @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name= "tempat_lahir" value="{{ old('tempat_lahir') ?: $user->tempat_lahir}}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                                    
                        <div class="mb-3">
                            <label class="control-label" for="tgl_lahir">Tanggal Lahir <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <input class="form-control datepicker @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') ?? ($user->tgl_lahir ? \Carbon\Carbon::parse($user->tgl_lahir)->format('d-m-Y') : '') }}" id="tgl_lahir" name="tgl_lahir" placeholder="dd-mm-yyyy" type="text"/>
                            @error('tgl_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="mb-3">
                            <label class="control-label" for="tgl_exp_paspor">Tanggal expired paspor</label>
                            <input class="form-control datepicker @error('tgl_exp_paspor') is-invalid @enderror" value="{{ old('tgl_exp_paspor') ?? ($user->tgl_exp_paspor ? \Carbon\Carbon::parse($user->tgl_exp_paspor)->format('d-m-Y') : '') }}" id="tgl_exp_paspor" name="tgl_exp_paspor" placeholder="dd-mm-yyyy" type="text"{{ $user->status == 'Diverifikasi' ? 'disabled' : '' }}/>
                            @error('tgl_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        
                        <div class="mb-3">
                            <label for="nationality">Nationality: <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <select class="form-select single-select-field" name="id_nationality" id="nationality" data-placeholder="Pilih nationality">
                                <option></option>
                                @foreach ($nationalities as $nationality)
                                    <option value="{{ $nationality->id }}" @if($nationality->id == $user->id_nationality) selected @endif>{{ $nationality->name }}</option>
                                @endforeach
                            </select>
                            @error('id_nationality')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- alamat --}}
                        <div class="mb-3">
                            <label for="provinsi">Provinsi: <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <select class="form-select single-select-field @error('id_provinsi') is-invalid @enderror" name="id_provinsi" id="provinsi" data-placeholder="Pilih provinsi">
                                <option></option>
                                @foreach ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                @endforeach
                            </select>
                            @error('id_provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="kabupaten">Kabupaten: <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <select class="form-select single-select-field @error('id_kabupaten') is-invalid @enderror" name="id_kabupaten" id="kabupaten" data-placeholder="Pilih Kabupaten">
                                <option></option>
                            </select>
                            @error('id_kabupaten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="kecamatan">Kecamatan: <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <select class="form-select single-select-field @error('id_kecamatan') is-invalid @enderror" name="id_kecamatan" id="kecamatan" data-placeholder="Pilih kecamatan">
                                <option></option>
                            </select>
                            @error('id_kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="kelurahan">Kelurahan: <small style="color: rgb(255, 0, 0); font-weight: bold;">*</small></label>
                            <select class="form-select single-select-field @error('id_kelurahan') is-invalid @enderror" name="id_kelurahan" id="kelurahan" data-placeholder="Pilih kelurahan">
                                <option></option>
                            </select>
                            @error('id_kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div style="clear: both;"></div>
                    <hr>
                    <div class="btn-mohon-wrapper">
                        @if ($user->status=="Diverifikasi" )
                            <p>Profilmu sudah terverifikasi, jika kamu ingin mengubah biodatamu, ajukan permohonan dengan klik tombol dibawah ini!</p>
                            <br>
                            <div class="btn-mohon">
                                <a href="/permohonan/{{ $user->id }}" class="btn btn-warning">Permohonan mengubah data</a>
                            </div>
                        
                        @elseif($user->status =="Permohonan perubahan disetujui" || $user->status == "Perlu dilengkapi" || $user->status == "Sedang diverifikasi" ||$user->status == "Perlu pembaharuan")
                            <button type="submit" class="btn btn-primary btn-mohon">Kirimkan Perubahan</button>
                        @else
                        @endif
                    </div>
                </form> 
            </div>
        </div>
    </div>

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