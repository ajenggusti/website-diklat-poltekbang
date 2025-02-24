@extends('layout.mainAdmin')
@section('title', 'Dashboard Super Admin')
@section('container')
    {{-- HEAD --}}
    <link href="/css/staff.css" rel="stylesheet">
    {{-- Body --}}
    
    <div class="rows">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $count }}</h3>

              <p>Total Seluruh Pengguna</p>
            </div>
            <div class="icon">
              <i class="bi bi-person"></i>
            </div>
            <a href="/allUser" class="small-box-footer">More info <i class="bi bi-arrow-right-circle-fill"></i></a>
          </div>
        </div>

        @foreach($userCounts as $userCount)
            @php
                $levelConfig = [
                    'DPUK' => ['class' => 'bg-secondary', 'icon' => 'bi-person-workspace'],
                    'Keuangan' => ['class' => 'bg-success', 'icon' => 'bi-currency-dollar'],
                    'Member' => ['class' => 'bg-warning', 'icon' => 'bi-person-square'],
                    'Super Admin' => ['class' => 'bg-danger', 'icon' => 'bi-person-fill']
                ];

                $defaultConfig = ['class' => 'bg-primary', 'icon' => 'bi-person'];

                $config = $levelConfig[$userCount->level->level] ?? $defaultConfig;
            @endphp
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box {{ $config['class'] }}">
                <div class="inner">
                    <h3>{{ $userCount->total_user }}</h3>
    
                    <p>Level {{ $userCount->level->level }}</p>
                </div>
                <div class="icon">
                    <i class="bi {{ $config['icon'] }}"></i>
                </div>
                <a href="/byLevel/{{ $userCount->level->id }}" class="small-box-footer">
                    More info <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
                </div>
            </div>
        @endforeach
        {{-- ini untuk menghitung user per status --}}
    
        @foreach ($statusCounts as $statusCount)
            @php
                $statusConfig = [
                    'Perlu dilengkapi' => ['class' => 'bg-secondary', 'icon' => 'bi-person-workspace'],
                    'sedang diverifikasi' => ['class' => 'bg-success', 'icon' => 'bi-currency-dollar'],
                    'Diverifikasi' => ['class' => 'bg-warning', 'icon' => 'bi-person-square'],
                    'Perlu pembaharuan' => ['class' => 'bg-danger', 'icon' => 'bi-person-fill'],
                    'Memohon perubahan' => ['class' => 'bg-danger', 'icon' => 'bi-person-fill'],
                    'Permohonan perubahan disetujui' => ['class' => 'bg-warning', 'icon' => 'bi-person-square'],
                ];

                $defaultConfig = ['class' => 'bg-primary', 'icon' => 'bi-person'];

                $config = $statusConfig[$statusCount->status] ?? $defaultConfig;
            @endphp
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box {{ $config['class'] }}">
                <div class="inner">
                    <h3>{{ $statusCount->total_byStatus }}</h3>

                    <p>Status {{ $statusCount->status }}</p>
                </div>
                <div class="icon">
                    <i class="bi {{ $config['icon'] }}"></i>
                </div>
                <a href="/byStatus/{{ $statusCount->status}}" class="small-box-footer">
                    More info <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
                </div>
            </div>
        @endforeach
    </div>
    <hr>
    <div class="container px-4 mx-auto">
        <div class="p-6 m-20 bg-white rounded shadow">
            {!! $SuperAdminChart->container() !!}
        </div>
    </div>
    
    <script src="{{ $SuperAdminChart->cdn() }}"></script>

    {{ $SuperAdminChart->script() }}
@endsection
