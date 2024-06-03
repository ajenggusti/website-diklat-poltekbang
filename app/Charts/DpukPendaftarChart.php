<?php

namespace App\Charts;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DpukPendaftarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $all = Pendaftaran::count();
        $lulusan = Pendaftaran::where('status_pelaksanaan', 'Terlaksana')->count();
        $pendaftarans = Pendaftaran::groupBy('id_diklat')
            ->select('id_diklat', DB::raw('count(*) as total_pendaftar'))
            ->get();

        // Initialize the data and labels arrays
        $data = [$all, $lulusan];
        $labels = ['Semua Pendaftar', 'Lulusan'];

        // Append pendaftarans data and labels
        foreach ($pendaftarans as $pendaftaran) {
            $data[] = $pendaftaran->total_pendaftar;
            $labels[] = $pendaftaran->diklat->nama_diklat; // Assuming diklat relationship is defined and diklat has a nama_diklat attribute
        }

        return $this->chart->pieChart()
            ->setTitle('Jumlah Pendaftaran dan Lulusan')
            ->setSubtitle('Data Pendaftaran tiap diklat dan Lulusan')
            ->addData($data)
            ->setLabels($labels);
    }
}
