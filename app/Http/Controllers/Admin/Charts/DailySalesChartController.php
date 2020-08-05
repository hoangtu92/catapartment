<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\Order;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//use ConsoleTVs\Charts\Classes\Echarts\Chart;


/**
 * Class DailySalesChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DailySalesChartController extends ChartController
{

    private $labels;

    public function setup()
    {

        $this->labels = [date('Y-m-d', strtotime('-7 days')),
            date('Y-m-d', strtotime('-6 days')),
            date('Y-m-d', strtotime('-5 days')),
            date('Y-m-d', strtotime('-4 days')),
            date('Y-m-d', strtotime('-3 days')),
            date('Y-m-d', strtotime('-2 days')),
            date('Y-m-d', strtotime('-1 days')),
            date('Y-m-d')];

        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points


        $this->chart->labels($this->labels);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/daily-sales'));

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

         foreach ($this->labels as $date){
             $data[] = DB::table("orders")->whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d') = '{$date}'")->sum("total_amount");
         }


         $this->chart->dataset('Daily Sales', 'line', $data)
             ->color('rgb(96, 92, 168)')
             ->backgroundColor('rgba(96, 92, 168, 0.4)');
     }
}
