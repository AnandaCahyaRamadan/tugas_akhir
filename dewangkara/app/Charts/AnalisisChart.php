<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class AnalisisChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->options([
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                'xAxes' => [],
                'yAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true,
                            'callback' => "function(value, index, values) {
                            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        }",
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function labels($labels)
    {
        $this->labels = $labels;
        return $this;
    }

    public function customDataset($name, $data, $color)
    {
        return $this->dataset($name, 'line', $data)->color($color)->backgroundColor($color)->lineTension(0);
    }
}
