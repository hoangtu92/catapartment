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

                    @include("frontend.products.list")
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
