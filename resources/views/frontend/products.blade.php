@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
    <style>
        .acce-box p{
            display: none;
        }
    </style>
@endsection

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_product_list")) }}" alt=""/>
    </section>

    <section>
        <div class="container">
            <div class="row">
                @include("frontend.products.sidebar")
                <div class="col-md-9">

                    <!--top filter-->
                    @include("frontend.products.top_filter")
                    <!--top filter-->

                    <div class="plist" ng-init="filterProduct()">
                        <div class="row">

                                <div class="col-sm-6 col-md-4" ng-repeat="product in paged_data.items">
                                    <div class="acce-box">
                                        <a ng-href="{{ url("/") }}/products/detail/@{{ product.slug }}">

                                                <span ng-if="product.is_hot" class="offer-hot">HOT</span>



                                                <span ng-if="product.sale_price >= 0 && product.sale_price < product.price" class="offer-green">@{{ (((product.sale_price - product.price)/product.price)*100).round() }}%
                                </span>


                                            <img ng-src="{{ url('/') }}@{{ product.image }}" alt=""/>
                                            <h3>@{{ product.name }}</h3>
                                            {{--<p>Accessories, Clocks</p>--}}
                                            <span><em>$@{{ product.price }}</em> $@{{ product.sale_price }}</span>

                                        </a></div>
                                </div>

                        </div>

                        <div class="col-lg-12" ng-if="paged_data.total_items > 0">
                            <div class="pagination">

                                <a ng-if="filter.page > 1" href="#" ng-click="setPage(filter.page - 1)">&laquo;</a>

                                <a ng-repeat="p in [] | range:0:paged_data.totalPage" ng-class="{active: p+1 == filter.page}" href="#" ng-click="setPage(p+1)">@{{ p+1 }}</a>
                                <a ng-if="filter.page < paged_data.total_items/paged_data.perPage" href="#" ng-click="setPage(filter.page + 1)">&raquo;</a>
                            </div>
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

@endsection
