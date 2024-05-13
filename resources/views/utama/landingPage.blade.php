{{-- extend merupakan inheritance dari nama file yang ingin di warisi --}}
@extends('layout/mainUser')
@section('container')
    @foreach ($gbrSlide as $slide)
        <img src="{{ asset('storage/' . $slide->gambar_navbar) }}" alt="Gambar slide" style="width: 50%;">
    @endforeach
   
    <h1>Total seluruh pendaftaran : {{ $totalPendaftar }}</h1>
    <h1>jumlah alumni : {{ $alumni }}</h1>
    <h1>jumlah pendaftar saat ini : {{ $jmlPendaftarBelumTerlaksana }}</h1>
    <h1>jumlah diklat saat ini : {{ $jmlDiklat }}</h1>
    <hr>
    <h3>kategori diklat</h3>
    @foreach ($katDiklat as $kategori)
            @if ($kategori->gambar)
                <img src="{{ asset('storage/' . $kategori->gambar) }}" alt="" style="width: 30%;">
            @else
                @php $foundDefault = false; @endphp
                @foreach ($katDiklat as $data)
                    @if ($data->default == 'ya')
                        <img src="{{ asset('storage/' . $data->gambar) }}" alt="Default Image" style="width: 30%;">
                        @php $foundDefault = true; @endphp
                        @break
                    @endif
                @endforeach
                @if (!$foundDefault)
                    <img src="{{ asset('img/123.png') }}" alt="Default Image" style="width: 30%;">
                @endif
            @endif
        Kategori "{{ $kategori->kategori_diklat }}"
        <br>
        {{-- <a href="/utama/macamDiklat/{{ $kategori->id }}">Lihat semua diklat</a> --}}
        <a href="/utama/macamDiklat/{{ $kategori->id }}">{{ $kategori->kategori_diklat }}</a>
            <br>
    @endforeach

    <hr>
    <h1>Promo</h1>
    @foreach ($promos as $promo)
    {{ $promo->id }}
    <img src="{{ asset('storage/'.$promo->gambar) }}" alt="Promo Image">
        
    @endforeach
    <h1>Testimoni</h1>
    @foreach ($testimonis as $testimoni)
        @if ($testimoni->id_pendaftaran)
            <h3>{{ $testimoni->pendaftaran->nama_lengkap }}</h3>
            <b>{{ $testimoni->profesi }}</b>
            <p>Alumni diklat {{ $testimoni->pendaftaran->diklat->nama_diklat }}</p>
            <p>{{ $testimoni->testimoni }}</p>
        @else
            <h3>{{ $testimoni->nama_dummy }}</h3>
            <b>{{ $testimoni->profesi }}</b>
            <p>Alumni diklat {{ $testimoni->diklat->nama_diklat }}</p>
            <p>{{ $testimoni->testimoni }}</p>
        @endif
    @endforeach

@endsection
