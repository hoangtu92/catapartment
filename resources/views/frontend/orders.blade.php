@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
@endsection

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_account")) }}" alt=""/>
    </section>

    <section class="dashboard-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include("frontend.global.account_navigation")
                    <div class="dash-right">
                        <div class="points-table">
                            <table class="table full-width">
                                <thead>
                                <tr>
                                    <th>{{ __("No.") }}</th>
                                    <th>{{ __("Order ID") }}</th>
                                    <th>{{ __("Order Date") }}</th>
                                    <th>{{ __("Order Amount") }}</th>
                                    <th>{{ __("Order Info") }}</th>
                                    <th>{{ __("Order Status") }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach(App\Models\User::find(Auth::id())->orders as $index =>  $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->created_at->format("Y/m/d") }}</td>
                                    <td>TWD {{ $order->total_amount }}</td>
                                    <td style="white-space: pre-line">{{ $order->shipping_name }},
                                        {{ $order->shipping_phone }}
                                        {{ $order->shipping_zipcode }}
                                        {{ $order->shipping_address }} {{ $order->shipping_address2 }}
                                        {{ $order->state }}, {{ $order->country }}
                                    </td>
                                    <td>{{ $order->status }}</td>
                                </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section("scripts")
    <!-- Price Rengebar JS Part Start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
            type="text/javascript"></script>
    <script src="{{ asset("js/price_range_script.js") }}" type="text/javascript"></script>

@endsection
