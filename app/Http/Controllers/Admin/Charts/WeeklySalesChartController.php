<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

/**
 * Class WeeklySalesChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WeeklySalesChartController extends ChartController
{

    private $labels = [];
    private $weeks = [];

    public function setup()
    {

        $past_weeks = 4;
        $relative_time = time();

        for($week_count=0;$week_count<$past_weeks;$week_count++) {
            $monday = strtotime("last Monday", $relative_time);
            $sunday = strtotime("Sunday", $monday);
            array_unshift($this->weeks, array(
                date("Y/m/d", $monday),
                date("Y/m/d", $sunday),
            ));

            $relative_time = $monday;
        }

        $this->labels = [
            $this->weeks[0][0].'-'.$this->weeks[0][1],
            $this->weeks[1][0].'-'.$this->weeks[1][1],
            $this->weeks[2][0].'-'.$this->weeks[2][1],
            $this->weeks[3][0].'-'.$this->weeks[3][1],
            /*$this->weeks[4][0].'-'.$this->weeks[4][1],
            $this->weeks[5][0].'-'.$this->weeks[5][1],
            $this->weeks[6][0].'-'.$this->weeks[6][1],*/
        ];

        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels($this->labels);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/weekly-sales'));

        // OPTIONAL
        // $this->chart->minimalist(false);
        $this->chart->displayLegend(false);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return void
     */
    public function data()
    {
        $data = [];

        foreach ($this->weeks as $week){
            $data[] = DB::table("orders")->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') >= '{$week[0]}' AND DATE_FORMAT(created_at,'%Y/%m/%d') <= '{$week[1]}'")->sum("total_amount");
        }

        $this->chart->dataset('Weekly Sales', 'line', $data)
            ->color('rgb(96, 92, 168)')
            ->backgroundColor('rgba(96, 92, 168, 0.4)');
    }
}
