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
        <form id="orderForm" action="{{ route("checkout") }}", method="post">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>{{ __("Billing Details") }}</h3>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("Name") }}<em>*</em></label>
                                    <input type="text" name="name" ng-model="order.name" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Company Name (optional)") }}</label>
                                    <input type="text" name="company_name" ng-model="order.company_name" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Country") }}<em>*</em></label>
                                    <select class="form-control" name="country" ng-model="order.country" readonly>
                                        <option value="Taiwan" selected>Taiwan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Street Address") }}<em>*</em></label>
                                    <input type="text" name="address" ng-model="order.address" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="address_2" ng-model="order.address2" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Town / City") }}<em>*</em></label>
                                    <input type="text" name="city" ng-model="order.city" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("State / County") }}<em>*</em></label>
                                    <input type="text" name="state" ng-model="order.state" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Postal Code / ZIP") }}<em>*</em></label>
                                    <input type="text" name="zipcode" ng-model="order.zipcode" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Phone") }}<em>*</em></label>
                                    <input type="text" name="phone" ng-model="order.phone" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Email Address") }}<em>*</em></label>
                                    <input type="text" name="email" ng-model="order.email" class="form-control" placeholder="">
                                </div>
                            </div>

                            @auth
                                @else
                            <div class="col-md-12">
                                <div class="form-group form-check">
                                    <label class="checkbox-btn">{{ __("Create an Account") }}
                                        <input name="create_account" ng-model="order.create_account" ng-click="toggleCreateAccount()" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
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
                                    <textarea name="notes" ng-model="order.notes" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-lg-6" style="background:#f8f8f8;">
                    <h3>{{ __("Your Order") }}</h3>
                    <div class="cart-tb">
                        <table class="table full-width">
                            <colgroup>
                                <col width="40%">
                                <col width="60%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>{{ __("Product") }}</th>
                                <th>{{ __("Total") }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($cart_items as $index => $item)
                            <tr>
                                <td>
                                    {{--<span ng-init="order.items['{{ $index }}'].product_id = '{{ $item->product_id }}'"></span>
                                    <span ng-init="order.items['{{ $index }}'].qty = '{{ $item->qty }}'"></span>
                                    <span ng-init="order.items['{{ $index }}'].color = '{{ $item->color }}'"></span>--}}
                                    {{ $item->product->name }}<small><strong> ({{ $item->color }}x{{ $item->qty }})</strong></small></td>
                                <td>${{ $item->product->sale_price*$item->qty }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><b>{{ __("Sub Total") }}</b></td>
                                <td><strong>${{ $cart_total_amount }}</strong></td>
                            </tr>
                            <tr>
                                <td>{{ __("Shipping") }}</td>
                                <td>
                                    {{--<label class="rd-btn">{{ __("Flat rate") }} : <strong>$20.00</strong>
                                        <input name="shipping_method" ng-model="order.shipping_method" type="radio" value="flat_rate" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="rd-btn">{{ __("Free Shipping") }}
                                        <input type="radio" name="shipping_method" ng-model="order.shipping_method" value="free_shipping">
                                        <span class="checkmark"></span>
                                    </label>--}}
                                    <label class="rd-btn">{{ __("Local Pickup") }} : <strong>${{ Setting::get("shipping_fee") }}</strong>
                                        <input type="radio" name="delivery" ng-model="order.delivery" checked value="pickup">
                                        <span class="checkmark"></span>
                                    </label></td>
                            </tr>
                            <tr>
                                <td><b>{{ __("Total") }}</b></td>
                                <td><strong>${{ $cart_total_amount + Setting::get("shipping_fee") }}</strong></td>
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
                        <div class="cre-box"><input type="number" name="point_discount" ng-model="order.preference_discount"><button>抵用</button></div>
                    </div>

                    <label class="rd-btn">{{ __("Cheque Payment") }}
                        <input type="radio" value="cheque" ng-model="order.payment_method" name="payment_method">
                        <span class="checkmark"></span>
                    </label>

                    <label class="rd-btn">{{ __("Cash on delivery") }}
                        <input type="radio" value="cod" ng-model="order.payment_method" name="payment_method">
                        <span class="checkmark"></span>
                    </label>

                    <label class="rd-btn">{{ __("ECPay") }}
                        <input type="radio" value="ecpay" ng-model="order.payment_method" name="payment_method" checked>
                        <span class="checkmark"></span>
                    </label>

                    <hr>
                    <p>{!! __("privacy_notice", ["privacy_url" => '<a href="#"><strong>'.__("privacy policy").'</strong></a>']) !!}.</p>
                    <hr>
                    <label class="checkbox-btn">{!! __("term_condition_agreement", ["term_link" => '<a href="#"><strong>'.__("terms and conditions").'*</strong></a>']) !!}
                        <input type="checkbox" ng-model="order.term_agree" checked="checked" name="term_agree">
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
