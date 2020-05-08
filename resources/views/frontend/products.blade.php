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

                    <div class="plist">
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box">
                                    <a href="{{ $product->permalink }}">

                                        <span class="offer-green">-20%</span>

                                        <span class="offer-hot">HOT</span>


                                        <img src="{{ asset($product->image) }}" alt=""/>
                                        <h3>{{ $product->name }}</h3>
                                        {{--<p>Accessories, Clocks</p>--}}
                                        <span><em>${{ $product->price }}</em> ${{ $product->sale_price }}</span></a></div>
                            </div>
                            @endforeach


                                @include("frontend.global.pagination")


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
