@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
@endsection

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_pre_order_product")) }}" alt=""/>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ptop bread">
                        <h5><a href="#">首頁</a> / <span>海外預購</span></h5>
                    </div>
                    <div class="plist">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                        <h3>Smart watches wood edition</h3>
                                        <p>Accessories, Clocks</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"> <a href="#">
                                        <span class="offer-green">-20%</span>
                                        <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                        <h3>Penatibus parturient</h3>
                                        <p>Toys</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"> <a href="#"> <span class="offer-hot">HOT</span><img src="{{ asset("images/product03.jpg") }}" alt=""/>
                                        <h3>Wooden bow tie man</h3>
                                        <p>Accessories</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                        <h3>Smart watches wood edition</h3>
                                        <p>Accessories, Clocks</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"> <a href="#">
                                        <span class="offer-green">-20%</span>
                                        <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                        <h3>Penatibus parturient</h3>
                                        <p>Toys</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"> <a href="#"> <span class="offer-hot">HOT</span><img src="{{ asset("images/product03.jpg") }}" alt=""/>
                                        <h3>Wooden bow tie man</h3>
                                        <p>Accessories</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                        <h3>Smart watches wood edition</h3>
                                        <p>Accessories, Clocks</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"> <a href="#">
                                        <span class="offer-green">-20%</span>
                                        <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                        <h3>Penatibus parturient</h3>
                                        <p>Toys</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"> <a href="#"> <span class="offer-hot">HOT</span><img src="{{ asset("images/product03.jpg") }}" alt=""/>
                                        <h3>Wooden bow tie man</h3>
                                        <p>Accessories</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                        <h3>Smart watches wood edition</h3>
                                        <p>Accessories, Clocks</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"> <a href="#">
                                        <span class="offer-green">-20%</span>
                                        <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                        <h3>Penatibus parturient</h3>
                                        <p>Toys</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box"> <a href="#"> <span class="offer-hot">HOT</span><img src="{{ asset("images/product03.jpg") }}" alt=""/>
                                        <h3>Wooden bow tie man</h3>
                                        <p>Accessories</p>
                                        <span><em>$499.00</em> $399.00</span></a> </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="pagination">
                                    <a href="#">&laquo;</a>
                                    <a href="#">1</a>
                                    <a class="active" href="#">2</a>
                                    <a href="#">3</a>
                                    <a href="#">4</a>
                                    <a href="#">5</a>
                                    <a href="#">6</a>
                                    <a href="#">&raquo;</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("frontend.global.ads")

@endsection

@section("scripts")
    <!-- Price Rengebar JS Part Start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
            type="text/javascript"></script>
    <script src="{{ asset("js/price_range_script.js") }}" type="text/javascript"></script>

@endsection
