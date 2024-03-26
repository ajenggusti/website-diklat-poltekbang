@extends('layout.mainAdmin')
@section('container')
    <h2>Form Edit Promo</h2>
        
    <form method="POST" action="/kelPromo/{{  $data->id }}" >
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="potongan" class="form-label is">Potongan</label>
            <input type="text" class="form-control  @error('potongan') is-invalid @enderror" id="potongan" name= "potongan" value="{{ old('potongan')?? $data->potongan}}">
            @error('potongan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="kode" class="form-label is">Kode Promo</label>
            <input type="text" class="form-control  @error('kode') is-invalid @enderror" id="kode" name= "kode" value="{{ old('kode')?? $data->kode}}">
            @error('kode')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3"> <!-- Date input -->
            <label class="control-label" for="tgl_awal">Tanggal Mulai Promo</label>
            <input class="form-control @error('tgl_awal') is-invalid @enderror" value="{{ old('tgl_awal') ?? ($data->tgl_awal ? \Carbon\Carbon::parse($data->tgl_awal)->format('d-m-Y') : '') }}" id="tgl_awal" name="tgl_awal" placeholder="dd-mm-yyyy" type="text"/>
            @error('tgl_awal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3"> <!-- Date input -->
            <label class="control-label" for="tgl_akhir">Tanggal Promo Berakhir</label>
            <input class="form-control @error('tgl_akhir') is-invalid @enderror" value="{{ old('tgl_akhir') ?? ($data->tgl_akhir ? \Carbon\Carbon::parse($data->tgl_akhir)->format('d-m-Y') : '') }}" id="tgl_akhir" name="tgl_akhir" placeholder="dd-mm-yyyy" type="text"/>
            @error('tgl_akhir')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>  
{{-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
    $(document).ready(function(){
        $('#tgl_awal, #tgl_akhir').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });
    });
</script>

@endsection

