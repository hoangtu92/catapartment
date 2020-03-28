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
                        <form method="post" action="{{ route("update_user") }}">
                            <input type="hidden" name="action" value="update_address">
                            @csrf

                           {{-- <div class="form-row">
                                <div class="form-group">
                                    <label for="city">{{ __("City") }}<sup>*</sup></label>
                                    <input id="city" value="{{ Auth::user()->city }}" type="text" class="form-control" name="city" required>
                                </div>

                            </div>--}}

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="address">{{ __("Address") }}</label>
                                    <input id="address" value="{{ Auth::user()->address }}" type="text" class="form-control" name="address">
                                </div>
                                <div class="form-group">
                                    <label for="zipcode">{{ __("Zip Code") }}</label>
                                    <input id="zipcode" value="{{ Auth::user()->zipcode }}" type="text" class="form-control" name="zipcode">
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="btn-cat pull-right" type="submit" value="{{ __("Save") }}">
                            </div>
                        </form>
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
