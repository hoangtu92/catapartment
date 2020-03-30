@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
@endsection

@section("content")

    <section class="inner-banner checkout-banner" style="background:url({{ asset(\Backpack\Settings\app\Models\Setting::get("banner_checkout")) }}) no-repeat center top;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <a href="#">{{ __("SHOPPING CART") }}</a>   >    <a href="#" class="active"> {{ __("CHECKOUT") }}</a>   >    <a href="#">{{ __("ORDER COMPLETE") }}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>{{ __("Billing Details") }}</h3>
                    <form action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("First Name") }}<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("Last Name") }}<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Company Name (optional)") }}</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Country") }}<em>*</em></label>
                                    <select class="form-control">
                                        <option>{{ __("Select Country") }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Street Address") }}<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Town / City") }}<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("State / County") }}<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Postal Code / ZIP") }}<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Phone") }}<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Email Address") }}<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-check">
                                    <label class="checkbox-btn">{{ __("Create an Account") }}
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="form-group form-check">
                                    <label class="checkbox-btn"><h3 class="mb-0">{{ __("Ship to a different address") }}</h3>
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Order Notes (optional)") }}</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6" style="background:#f8f8f8;">
                    <h3>{{ __("Your Order") }}</h3>
                    <div class="cart-tb">
                        <table class="table full-width">
                            <tbody>
                            <tr>
                                <th>{{ __("Product") }}</th>
                                <th>{{ __("Total") }}</th>
                            </tr>
                            <tr>
                                <td>{{ __("Best Clock") }}</td>
                                <td>$555.00</td>
                            </tr>
                            <tr>
                                <td><b>{{ __("Sub Total") }}</b></td>
                                <td><strong>$555.00</strong></td>
                            </tr>
                            <tr>
                                <td>{{ __("Shipping") }}</td>
                                <td><label class="rd-btn">{{ __("Flat rate") }} : <strong>$20.00</strong>
                                        <input type="radio" checked="checked" name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="rd-btn">{{ __("Free Shipping") }}
                                        <input type="radio" name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="rd-btn">{{ __("Local Pickup") }} : <strong>$25.00</strong>
                                        <input type="radio" name="radio">
                                        <span class="checkmark"></span>
                                    </label></td>
                            </tr>
                            <tr>
                                <td><b>{{ __("Total") }}</b></td>
                                <td><strong>$575.00</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="discount-box">
                        <label class="checkbox-btn">優惠折扣
                            <input type="checkbox" checked="checked">
                            <span class="checkmark"></span>
                        </label>
                        <span>請填入你的優惠折扣：</span>
                        <div class="cre-box"><input type="text"><button>抵用</button></div>
                    </div>

                    <label class="rd-btn">{{ __("Cheque Payment") }}
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>

                    <label class="rd-btn">{{ __("Cash on delivery") }}
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>

                    <label class="rd-btn">{{ __("Paypal") }}
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>

                    <hr>
                    <p>{!! __("privacy_notice", ["privacy_url" => '<a href="#"><strong>'.__("privacy policy").'</strong></a>']) !!}.</p>
                    <hr>
                    <label class="checkbox-btn">{!! __("term_condition_agreement", ["term_link" => '<a href="#"><strong>'.__("terms and conditions").'*</strong></a>']) !!}
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>

                    <button class="btn02">{{ __("Place Order") }}</button>

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
