@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
@endsection

@section("content")

    <section class="inner-banner checkout-banner"
             style="background:url({{ asset(\Backpack\Settings\app\Models\Setting::get("banner_checkout")) }}) no-repeat center top;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <a href="#">{{ __("SHOPPING CART") }}</a> > <a href="#" class="active"> {{ __("CHECKOUT") }}</a> >
                    <a href="#">{{ __("ORDER COMPLETE") }}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout-page">
        <form id="orderForm" action="{{ route("checkout") }}" , method="post">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __("Billing Details") }}</h3>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("Name") }}<em>*</em></label>
                                    <input type="text" name="name"
                                           value="{{ Auth::guest() ? Session::get("name") :  Session::get("name", Auth::user()->name)}}"
                                           class="form-control" placeholder="">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Company Name (optional)") }}</label>
                                    <input type="text" name="company_name" value="{{ Session::get("company_name")}}"
                                           class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Country") }}<em>*</em></label>
                                    <select class="form-control" name="country" readonly>
                                        <option value="Taiwan" selected>Taiwan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Street Address") }}<em>*</em></label>
                                    <input type="text" name="address"
                                           value="{{ Auth::guest() ? Session::get("address") :  Session::get("address", Auth::user()->address)}}"
                                           class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="address2" value="{{ Session::get("address2")}}"
                                           class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Town / City") }}<em>*</em></label>
                                    <input type="text" name="city" value="{{ Session::get("city") }}"
                                           class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("State / County") }}<em>*</em></label>
                                    <input type="text" name="state" value="{{ Session::get("state") }}"
                                           class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Postal Code / ZIP") }}<em>*</em></label>
                                    <input type="text" name="zipcode"
                                           value="{{ Auth::guest() ? Session::get("zipcode") :  Session::get("zipcode", Auth::user()->zipcode)}}"
                                           class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Phone") }}<em>*</em></label>
                                    <input type="text" name="phone"
                                           value="{{ Auth::guest() ? Session::get("phone") :  Session::get("phone", Auth::user()->phone)}}"
                                           class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Email Address") }}<em>*</em></label>
                                    <input type="text" name="email"
                                           value="{{ Auth::guest() ? Session::get("email") :  Session::get("email", Auth::user()->email)}}"
                                           class="form-control" placeholder="">
                                </div>
                            </div>

                            @auth
                            @else
                                <div class="col-md-12">
                                    <div class="form-group form-check">
                                        <label class="checkbox-btn">{{ __("Create an Account") }}
                                            <input name="create_account" ng-model="order.create_account"
                                                   ng-click="toggleCreateAccount()" type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>

                                    </div>
                                    <div ng-if="order.create_account == true">
                                        <div class="form-group">
                                            <label>{{ __("Password") }}</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __("Retype Password") }}</label>
                                            <input type="password" name="password2" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            @endauth
                            {{--<div class="col-md-12 mt-4">
                                <div class="form-group form-check">
                                    <label class="checkbox-btn"><h3 class="mb-0">{{ __("Ship to a different address") }}</h3>
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>--}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Order Notes (optional)") }}</label>
                                    <textarea name="notes" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6" style="background:#f8f8f8;">
                        <h3>{{ __("Your Order") }}</h3>
                        <div class="cart-tb">
                            @include("frontend.global.checkout_table")
                        </div>

                        @auth
                        <div class="discount-box">
                            <label class="checkbox-btn">優惠折扣
                                <input type="checkbox" name="use_discount" value="true" @if(Session::get("use_discount") == "true") checked ng-init="order.use_discount = true" @endif ng-click="order.use_discount = !order.use_discount">
                                <span class="checkmark"></span>
                            </label>
                            <div ng-if="order.use_discount">
                                <span>請填入你的優惠折扣：</span>
                                <div class="cre-box"><input type="text" pattern="\d*" name="point_discount" value="{{ Session::get("point_discount") }}"><input
                                        type="submit" name="apply_discount" value="抵用"></div>
                            </div>

                        </div>
                        @endauth

                        <label class="rd-btn">{{ __("Cheque Payment") }}
                            <input type="radio" value="cheque" name="payment_method">
                            <span class="checkmark"></span>
                        </label>

                        <label class="rd-btn">{{ __("Cash on delivery") }}
                            <input type="radio" value="cod" name="payment_method">
                            <span class="checkmark"></span>
                        </label>

                        <label class="rd-btn">{{ __("ECPay") }}
                            <input type="radio" value="ecpay" name="payment_method" checked>
                            <span class="checkmark"></span>
                        </label>

                        <hr>
                        <p>{!! __("privacy_notice", ["privacy_url" => '<a href="#"><strong>'.__("privacy policy").'</strong></a>']) !!}
                            .</p>
                        <hr>
                        <label
                            class="checkbox-btn">{!! __("term_condition_agreement", ["term_link" => '<a href="#"><strong>'.__("terms and conditions").'*</strong></a>']) !!}
                            <input type="checkbox" name="term_agree">
                            <span class="checkmark"></span>
                        </label>

                        <button type="submit" class="btn02">{{ __("Place Order") }}</button>

                    </div>
                </div>
            </div>
        </form>
    </section>


@endsection

@section("scripts")
    <!-- Price Rengebar JS Part Start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
            type="text/javascript"></script>
    <script src="{{ asset("js/price_range_script.js") }}" type="text/javascript"></script>

@endsection
