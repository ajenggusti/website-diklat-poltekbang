<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Pembayaran;

class KeuanganChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($year): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $data = Pembayaran::where('status', 'Lunas')
            ->whereYear('updated_at', $year) // Filter by year
            ->selectRaw('jenis_pembayaran, SUM(total_harga) as total, MONTH(updated_at) as month')
            ->groupBy('jenis_pembayaran', 'month')
            ->get();

        $diklat = array_fill(0, 12, 0);
        $pendaftaran = array_fill(0, 12, 0);

        foreach ($data as $item) {
            $index = $item->month - 1;
            if ($item->jenis_pembayaran == 'diklat') {
                $diklat[$index] = $item->total;
            } elseif ($item->jenis_pembayaran == 'pendaftaran') {
                $pendaftaran[$index] = $item->total;
            }
        }

        return $this->chart->lineChart()
            ->setTitle("Pemasukan Tahun $year")
            ->setSubtitle('Total pemasukan per bulan dalam Rupiah')
            ->addData('Diklat', $diklat)
            ->addData('Pendaftaran', $pendaftaran)
            ->setXAxis(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'])
            ->setGrid(true)
            ->setMarkers(['#FF5733', '#33FF57'])
            ->setToolBar(true)
            ->setOptions([
                'chart' => [
                    'toolbar' => [
                        'show' => true,
                    ],
                ],
                'yaxis' => [
                    'labels' => [
                        'formatter' => function($value) {
                            return 'Rp' . number_format($value, 0, ',', '.');
                        },
                    ],
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => function($value) {
                            return 'Rp' . number_format($value, 0, ',', '.');
                        },
                    ],
                ],
            ]);
    }
}
