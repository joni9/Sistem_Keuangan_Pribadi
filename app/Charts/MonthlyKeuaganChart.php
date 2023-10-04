<?php

namespace App\Charts;

use App\Models\Keuangan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyKeuaganChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $year   = date('Y');
        $month  = date('m');
        $keuangan = Keuangan::groupBy('jenis', 'id')->whereMonth('created_at', '=', $month)->whereYear('created_at', $year)->get();
        $data = [
            $keuangan->where('jenis', 'pemasukan')->sum('nominal'),
            $keuangan->where('jenis', 'keluaran')->sum('nominal'),
        ];
        $label = [
            'pemasukan',
            'pengeluaran',
        ];
        $colors = ['#1D8CF8', '#FD5D93'];
        return $this->chart->pieChart()
            ->setTitle('Data Keuangan bulan ini')
            ->setSubtitle('Joni Evendi')
            ->addData($data)
            ->setLabels($label)
            ->setColors($colors);
    }
}
