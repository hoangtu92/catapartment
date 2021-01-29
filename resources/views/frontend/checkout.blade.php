@extends("frontend.templates.default")

@section("stylesheet")
    <link rel="stylesheet" href="{{ asset("css/radio-btn.css") }}">
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
        <form id="orderForm" action="{{ route("checkout") }}" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __("Billing Details") }}

                            @if(!Auth::id())
                        <br>
                            <a style="font-size: 14px" href="{{route("login")}}">會員請先登入</a>
                                @endif
                        </h3>

                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Name") }}<em>*</em></label>
                                    <input type="text" name="name"
                                           value="{{ Auth::guest() ? Session::get("name") :  Session::get("name", Auth::user()->name)}}"
                                           class="form-control" placeholder="">
                                    @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Company Name (optional)") }}</label>
                                    <input type="text" name="company_name" value="{{ Session::get("company_name")}}"
                                           class="form-control" placeholder="">

                                </div>
                            </div>
                            {{--<div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Country") }}<em>*</em></label>
                                    <select class="form-control" name="country" readonly>
                                        <option value="Taiwan" selected>Taiwan</option>
                                    </select>
                                </div>
                            </div>--}}
                            <input type="hidden" name="country" value="Taiwan">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Street Address") }}<em>*</em></label>
                                    <input type="text" name="address"
                                           value="{{ Auth::guest() ? Session::get("address") :  Session::get("address", Auth::user()->address)}}"
                                           class="form-control" placeholder="">
                                    @error('address')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                </div>
                                {{--<div class="form-group">
                                    <input type="text" name="address2" value="{{ Session::get("address2")}}"
                                           class="form-control" placeholder="">
                                </div>--}}
                            </div>
                            {{--<div class="col-md-12">
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
                            </div>--}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Postal Code / ZIP") }}<em>*</em></label>
                                    <input type="text" name="zipcode"
                                           value="{{ Auth::guest() ? Session::get("zipcode") :  Session::get("zipcode", Auth::user()->zipcode)}}"
                                           class="form-control" placeholder="">
                                    @error('zipcode')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Phone") }}<em>*</em></label>
                                    <input type="text" name="phone"
                                           value="{{ Auth::guest() ? Session::get("phone") :  Session::get("phone", Auth::user()->phone)}}"
                                           class="form-control" placeholder="">
                                    @error('phone')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __("Email Address") }}<em>*</em></label>
                                    <input type="text" name="email"
                                           value="{{ Auth::guest() ? Session::get("email") :  Session::get("email", Auth::user()->email)}}"
                                           class="form-control" placeholder="">
                                    @error('email')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            @auth
                            @else
                                <div class="col-md-12">
                                    <div class="form-group form-check">
                                        <label class="checkbox-btn">{{ __("Create an Account") }}
                                            <input name="create_account" ng-model="order.create_account"
                                                   ng-click="toggleCreateAccount()" type="checkbox" @if(Session::get("create_account") == true) checked ng-init="order.create_account = true" @endif>
                                            <span class="checkmark"></span>
                                        </label>

                                    </div>
                                    <div ng-if="order.create_account == true">
                                        <div class="form-group">
                                            <label>{{ __("Password") }}</label>
                                            <input type="password" name="password" class="form-control">
                                            @error('password')<div class="alert alert-danger">{{ $message }}</div>@enderror

                                        </div>
                                        <div class="form-group">
                                            <label>{{ __("Retype Password") }}</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                            @error('password_confirmation')<div class="alert alert-danger">{{ $message }}</div>@enderror
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
                                    <textarea name="notes" value="{{old("notes")}}" class="form-control"></textarea>
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

                            @if(Auth::user()->isVip())

                                <div class="discount-box point-discount">
                                    <div>
                                        <span>請填入你的優惠折扣：</span>
                                        <div class="cre-box">

                                            <input type="number" id="check_discount" min="0" value="{{ Session::get("discount")  | round(Auth::user()->points/Setting::get("point_ratio")) }}" name="point_discount">

                                            <input type="button" onclick="validateVip()" name="action" value="抵用">

                                            <button class="btn btn-cat discount-reset-btn" type="button" onclick="this.form.point_discount.value = 0">不抵用</button>
                                        </div>
                                    </div>


                                    @error('point_discount')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                    @error('vip_code')<div class="alert alert-danger">{{ $message }}</div>@enderror

                                </div>

                            @endif

                        @endauth

                       {{-- <label class="rd-btn">{{ __("Cheque Payment") }}
                        </label>--}}

                        <label class="rd-btn">{{ __("Cash on delivery") }}
                            <input type="radio" value="cod" name="payment_method" @if(Session::get("payment_method") == "code") checked @endif>
                            <span class="checkmark"></span>
                        </label>

                        <label class="rd-btn">{{ __("ECPay") }}
                            <input type="radio" value="ecpay" name="payment_method" @if(Session::get("payment_method") == "ecpay") checked @endif>
                            <span class="checkmark"></span>
                        </label>

                        <label class="rd-btn">{{ __("支付寶") }}
                            <input type="radio" value="arcrma" name="payment_method" @if(Session::get("payment_method") == "arcrma") checked @endif>
                            <span class="checkmark"></span>
                        </label>

                        <hr>
                        <p>{!! __("privacy_notice", ["privacy_url" => '<a href="'.route('page', ['privacy-policy']).'" target="_blank"><strong>'.__("privacy policy").'</strong></a>']) !!}
                            .</p>
                        <hr>
                        <label
                            class="checkbox-btn">{!! __("term_condition_agreement", ["term_link" => '<a href="'.route('page', ['terms']).'" target="_blank"><strong>'.__("terms and conditions").'*</strong></a>']) !!}
                            <input type="checkbox" name="term_agree">
                            <span class="checkmark"></span>
                        </label>

                        @error('term_agree')<div class="alert alert-danger">{{ $message }}</div>@enderror

                        <button type="submit" class="btn02">{{ __("Place Order") }}</button>

                    </div>
                </div>
            </div>
        </form>
    </section>
    @auth
    <div class="modal fade" id="validateVip">
        <div class="modal-dialog">
            <form action="{{ route("validate_vip") }}" method="POST" id="vipcodeform" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="message text-center">

                        @csrf

                        <input type="hidden" name="point_discount" id="point_discount_field">

                        <div class="form-group">
                            <input class="form-control" type="text" name="vip_code" placeholder="{{ __("VIP身分證驗證") }}">
                        </div>

                    </div>
                </div>
                <div class="modal-footer text-center">
                    <div class="form-group" style="width: 100%">
                        <input class="btn-cat" type="button" onclick="onValidateVipSubmit()" value="驗證" style="margin: 0">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
    function validateVip(){
        $("#validateVip").modal();
    }

    function onValidateVipSubmit() {
        $("#vipcodeform #point_discount_field").val(document.querySelector('#orderForm').point_discount.value);
        $("#vipcodeform").submit();
    }

    document.querySelector("#check_discount").onkeypress = function(e){
        console.log(e.which)
        if(e.which === 45) return false;
    }



</script>
    @endauth
@endsection
