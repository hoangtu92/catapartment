<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

/**
 * Class MonthlySalesChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MonthlySalesChartController extends ChartController
{

    private $labels = [];

    public function setup()
    {

        for ($i = 1; $i <= 12; $i++) {
            $this->labels[] = date("Y-m%", strtotime( date( 'Y-m-01' )." -$i months"));
        }

        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels($this->labels);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/monthly-sales'));

        // OPTIONAL
        // $this->chart->minimalist(false);
        // $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return void
     */
    public function data()
    {
        $data = [];

        foreach ($this->labels as $month){
            $data[] = DB::table("orders")->whereRaw("DATE_FORMAT(created_at,'%Y/%m') = '{$month}'")->sum("total_amount");
        }

        $this->chart->dataset('Month Sales', 'line', $data)
            ->color('rgba(253, 205, 0, 0.4)')
            ->backgroundColor('rgba(253, 205, 0, 0.4)');
    }
}
