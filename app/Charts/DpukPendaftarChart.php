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

    public function build($year): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $pendaftarans = Pendaftaran::whereYear('updated_at', $year)
            ->selectRaw('MONTH(updated_at) as month, COUNT(*) as total_pendaftar')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = array_fill(0, 12, 0);
        foreach ($pendaftarans as $pendaftaran) {
            $months[$pendaftaran->month - 1] = $pendaftaran->total_pendaftar;
        }

        return $this->chart->lineChart()
            ->setTitle("Jumlah Pendaftaran tahun $year")
            ->setSubtitle('Total pendaftar per bulan')
            ->addData('Pendaftar', $months)
            ->setXAxis(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
    }
}
