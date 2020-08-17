@extends(backpack_view('blank'))

@section('content')

    @php
        $salesTotal = \Illuminate\Support\Facades\DB::table("orders")->where("status", COMPLETED)->where("payment_status", PAID)->selectRaw(DB::raw("SUM(total_amount) as total"))->first()->total;

        $userProgress = [
            'type'        => 'progress',
            'class'       => 'card text-white bg-info mb-2',
            'value'       => \App\User::where("role", "user")->count(),
            'description' => '總會員數',
            'wrapperClass' => "col-xs-12"
        ];

        $saleProgress = [
            'type'        => 'progress',
            'class'       => 'card text-white bg-warning mb-2',
            'value'       => "NT$".number_format($salesTotal),
            'description' => '月銷售總金額',
            'wrapperClass' => "col-xs-12"
        ];

        $dailySales = [
            'type'  => 'chart',
            'controller' => \App\Http\Controllers\Admin\Charts\DailySalesChartController::class,
            'wrapperClass' => "col-xs-12",
            'title' => '日'
        ];

        $weeklySales = [
            'type'  => 'chart',
            'controller' => \App\Http\Controllers\Admin\Charts\WeeklySalesChartController::class,
            'wrapperClass' => "col-xs-12",
            'title' => '週'
        ];

        $monthlySales = [
            'type'  => 'chart',
            'controller' => \App\Http\Controllers\Admin\Charts\MonthlySalesChartController::class,
            'wrapperClass' => "col-xs-12",
            'title' => '月'
        ];

        $tabs = [
            'type' => 'tabs',
            'class' => '',
            'content' => [$dailySales, $weeklySales, $monthlySales]
        ];

        $left = [
          'type' => 'div',
          'class' => 'col-xs-12 col-md-8 col-lg-9',
          'content' => [$tabs]
        ];

        $right= [
          'type' => 'div',
          'class' => 'col-xs-12 col-md-4 col-lg-3',
          'content' => [
                $userProgress,
                $saleProgress
          ]
        ];

        $widgets['before_content'][] =  [
          'type' => 'div',
          'class' => 'row',
          'content' => [ // widgets
                $left, $right
           ]
        ];

    @endphp

@endsection
