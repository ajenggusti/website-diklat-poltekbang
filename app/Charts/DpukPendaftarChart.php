<?php
namespace App\Charts;

use App\Models\Pendaftaran;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DpukPendaftarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($year): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $pendaftarans = Pendaftaran::whereYear('pendaftaran.updated_at', $year)
            ->join('diklat', 'pendaftaran.id_diklat', '=', 'diklat.id')
            ->selectRaw('diklat.nama_diklat as diklat_name, COUNT(*) as total_pendaftar')
            ->groupBy('diklat_name')
            ->orderBy('diklat_name')
            ->get();

        $diklatNames = [];
        $totalPendaftar = [];

        foreach ($pendaftarans as $pendaftaran) {
            $diklatNames[] = $pendaftaran->diklat_name;
            $totalPendaftar[] = $pendaftaran->total_pendaftar;
        }

        return $this->chart->barChart()
            ->setTitle("Jumlah Pendaftaran tahun $year")
            ->setSubtitle('Total pendaftar per diklat')
            ->addData('Pendaftar', $totalPendaftar)
            ->setXAxis($diklatNames);
    }
}
