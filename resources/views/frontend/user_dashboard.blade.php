@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
@endsection

@section("content")

    <section class="inner-banner">
        <img src="{{ asset("images/catshop-banner08.jpg") }}" alt=""/>
    </section>

    <section class="dashboard-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include("frontend.global.account_navigation")
                    <div class="dash-right">
                        <p>Hello {{ Auth::user()->name }} (not {{ Auth::user()->name }}? <strong><a href="#" class="logout-link">Log out</a> </strong>)</p>
                        <p>From your account dashboard you can view your recent orders, manage your shipping and billing
                            address, and edit your password and account details.</p>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="dr-box"><a href="{{ route("orders") }}"><img src="{{ asset("images/dashboard-icon01.jpg") }}" alt=""/>
                                        <h3>Orders</h3></a></div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="dr-box"><a href="{{ route("points") }}"><img src="{{ asset("images/dashboard-icon02.jpg") }}" alt=""/>
                                        <h3>Points</h3></a></div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="dr-box"><a href="{{ route("address") }}"><img src="{{ asset("images/dashboard-icon03.jpg") }}" alt=""/>
                                        <h3>Addresses</h3></a></div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="dr-box"><a href="{{ route("profile") }}"><img src="{{ asset("images/dashboard-icon04.jpg") }}" alt=""/>
                                        <h3>Account Details</h3></a></div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="dr-box"><a href="{{ route("wishlist") }}"><img src="{{ asset("images/dashboard-icon05.jpg") }}" alt=""/>
                                        <h3>Wishlist</h3></a></div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="dr-box"><a href="#" class="logout-link"><img src="{{ asset("images/dashboard-icon06.jpg") }}" alt=""/>
                                        <h3>Logout</h3></a></div>
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
    <script src="{{ asset("js/price_range_script.js") }}" type="text/javascript"></script>

@endsection
