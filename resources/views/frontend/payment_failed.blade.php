@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
@endsection

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_thankyou")) }}" alt=""/>
    </section>

    <section class="wishlist-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="{{ asset("images/wishlist-icon.jpg") }}" alt=""/>
                    <h2>{{ __("Order placed successfully but payment was failed. Please try again or contact administrator for supporting") }}</h2>
                    <p>Thank you for shopping with us</p>
                    <a href="/">{{ __("Return to Shop") }}</a>
                    <a href="{{ route("contact") }}">{{ __("Contact") }}</a>
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
