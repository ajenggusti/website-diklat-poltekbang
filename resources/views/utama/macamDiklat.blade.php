@extends('layout.mainUser')
@section('container')
    @foreach ($diklat as $perdiklat)
            @if ($perdiklat->gambar)
                <img src="{{ asset('storage/' . $perdiklat->gambar) }}" alt="" style="width: 30%;">
            @else
                @php $foundDefault = false; @endphp
                @foreach ($allDiklat as $data)
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
        <a href="/utama/detailDiklat/{{ $perdiklat->id }}">lihat detail tentang {{ $perdiklat->nama_diklat }}</a>
        <br>
    @endforeach

    <a href="/" class="btn btn-info">Kembali</a>
@endsection