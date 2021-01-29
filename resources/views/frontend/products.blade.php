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

    <section ng-cloak="true">
        <div class="container">
            <div class="row">
                @include("frontend.products.sidebar")
                <div class="col-md-9">

                    <!--top filter-->
                    @include("frontend.products.top_filter")
                    <!--top filter-->

                    <div class="plist" ng-init="filterProduct()">
                        <div class="d-grid grid-3" ng-init="changeView()">

                                <div ng-repeat="product in paged_data.items">
                                    <div class="acce-box">

                                        <a ng-href="{{ url("/") }}/products/detail/@{{ product.slug }}">

                                            <span ng-if="product.isHot" class="offer-hot">HOT</span>

                                            @if(Auth::check())
                                                @if(Auth::user()->isVip())

                                                <span class="offer-green">@{{ (((product.price*0.8*0.9 - product.price)/product.price)*100).round() }}%</span>
                                                <div class="image"><img onerror="this.src='/images/no-img.jpg'" ng-src="{{ url('/') }}/@{{ product.image }}" alt=""/></div>
                                                <h3>@{{ product.name }}</h3>

                                                <span><em>$@{{ product.price }}</em> $@{{ product.price*0.8*0.9 }}</span>

                                                @else
                                                    <span class="offer-green">@{{ (((product.price*0.8 - product.price)/product.price)*100).round() }}%</span>
                                                    <div class="image"><img onerror="this.src='/images/no-img.jpg'" ng-src="{{ url('/') }}/@{{ product.image }}" alt=""/></div>
                                                    <h3>@{{ product.name }}</h3>
                                                    <span><em>$@{{ product.price }}</em> $@{{ product.price*0.8 }}</span>
                                                @endif
                                            @else
                                                <div class="image"><img onerror="this.src='/images/no-img.jpg'" ng-src="{{ url('/') }}/@{{ product.image }}" alt=""/></div>
                                                <h3>@{{ product.name }}</h3>
                                                <span>$@{{ product.price }}</span>
                                            @endif

                                            {{--<p>Accessories, Clocks</p>--}}

                                        </a>


                                        </div>
                                </div>

                        </div>

                        <div class="col-lg-12" ng-if="paged_data.total_items > 0">
                            <div class="pagination">

                                <ul uib-pagination total-items="paged_data.total_items" ng-model="filter.page" max-size="5" ng-change="filterProduct()" previous-text="‹" next-text="›"  class="pagination-sm" boundary-link-numbers="true" rotate="true"></ul>

                                {{--<a ng-if="filter.page > 1" href="#" ng-click="setPage(filter.page - 1)">&laquo;</a>

                                <a ng-repeat="p in [] | range:0:paged_data.totalPage" ng-class="{active: p+1 == filter.page}" href="#" ng-click="setPage(p+1)">@{{ p+1 }}</a>
                                <a ng-if="filter.page < paged_data.total_items/paged_data.perPage" href="#" ng-click="setPage(filter.page + 1)">&raquo;</a>--}}
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
