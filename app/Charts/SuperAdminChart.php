<?php

namespace App\Charts;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class SuperAdminChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $all = User::count();
        $groupBy = User::groupBy('id_level')
            ->select('id_level', DB::raw('count(*) as total_user'))
            ->get();

        $data = [$all];
        $labels = ['Semua User'];

        foreach ($groupBy as $user) {
            $data[] = $user->total_user;
            $labels[] = $user->level->level;
        }

        return $this->chart->pieChart()
            ->setTitle('Chart user berdasarkan Level')
            // ->setSubtitle('Data user')
            ->addData($data)
            ->setLabels($labels);
    }
}