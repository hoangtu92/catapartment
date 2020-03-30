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
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--<tr>
                                    <td>1</td>
                                    <td>CAT-23944974356</td>
                                    <td>2020/03/10</td>
                                    <td>TWD 3,000</td>
                                    <td>Tom Holland,
                                        0986756453
                                        123 St, District 4, London
                                    </td>
                                </tr>--}}
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
