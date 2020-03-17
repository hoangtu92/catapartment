@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
@endsection

@section("content")

    <section class="inner-banner checkout-banner" style="background:url(images/catshop-banner13.jpg) no-repeat center top;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <a href="#">SHOPPING CART</a>   >    <a href="#" class="active"> CHECKOUT</a>   >    <a href="#">ORDER COMPLETE</a>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Billing Details</h3>
                    <form action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Company Name (optional)</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Country<em>*</em></label>
                                    <select class="form-control">
                                        <option>Select Country</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Street Address<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Town / City<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>State / County<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Postal Code / ZIP<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email Address<em>*</em></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-check">
                                    <label class="checkbox-btn">Create an Account
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="form-group form-check">
                                    <label class="checkbox-btn"><h3 class="mb-0">Ship to a different address</h3>
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Order Notes (optional)</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6" style="background:#f8f8f8;">
                    <h3>Your Order</h3>
                    <div class="cart-tb">
                        <table class="table full-width">
                            <tbody>
                            <tr>
                                <th>Product</th>
                                <th>Total</th>
                            </tr>
                            <tr>
                                <td>Best Clock</td>
                                <td>$555.00</td>
                            </tr>
                            <tr>
                                <td><b>Sub Total</b></td>
                                <td><strong>$555.00</strong></td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td><label class="rd-btn">Flat rate : <strong>$20.00</strong>
                                        <input type="radio" checked="checked" name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="rd-btn">Free Shipping
                                        <input type="radio" name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="rd-btn">Local Pickup : <strong>$25.00</strong>
                                        <input type="radio" name="radio">
                                        <span class="checkmark"></span>
                                    </label></td>
                            </tr>
                            <tr>
                                <td><b>Total</b></td>
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

                    <label class="rd-btn">Cheque Payment
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>

                    <label class="rd-btn">Cash on delivery
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>

                    <label class="rd-btn">Paypal
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>

                    <hr>
                    <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#"><strong>privacy policy</strong></a>.</p>
                    <hr>
                    <label class="checkbox-btn">I have read and agree to the website <a href="#"><strong>terms and conditions*</strong></a>
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>

                    <button class="btn02">Place Order</button>

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
