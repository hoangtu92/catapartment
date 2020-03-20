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
        <img src="{{ asset("images/catshop-banner02.jpg") }}" alt=""/>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="lbox">
                        <h3>用價格找拼圖</h3>
                        <div class="price-range-block">
                            <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                            <div style="margin:20px auto">
                                <input type="number" min=0 max="9900" oninput="validity.valid||(value='0');"
                                       id="min_price" class="price-range-field"/>
                                <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');"
                                       id="max_price" class="price-range-field"/>
                            </div>
                            <button class="price-range-search" id="price-range-submit"
                                    style="display:block !important;">Search
                            </button>

                        </div>
                    </div>
                    <div class="lbox">
                        <h3>用產地找拼圖</h3>
                        <ul>
                            <li><a href="#"><img src="{{ asset("images/country-icon01.png") }}" alt=""/> 日本 <span>10</span></a></li>
                            <li><a href="#"><img src="{{ asset("images/country-icon02.png") }}" alt=""/> 美國 <span>12</span></a></li>
                            <li><a href="#"><img src="{{ asset("images/country-icon03.png") }}" alt=""/> 英國 <span>14</span></a></li>
                            <li><a href="#"><img src="{{ asset("images/country-icon04.png") }}" alt=""/> 德國 <span>10</span></a></li>
                            <li><a href="#"><img src="{{ asset("images/country-icon05.png") }}" alt=""/> 法國 <span>16</span></a></li>
                            <li><a href="#"><img src="{{ asset("images/country-icon06.png") }}" alt=""/> 義大利 <span>11</span></a></li>
                            <li><a href="#"><img src="{{ asset("images/country-icon07.png") }}" alt=""/> 韓國 <span>18</span></a></li>
                            <li><a href="#"><img src="{{ asset("images/country-icon08.png") }}" alt=""/> 台灣 <span>12</span></a></li>
                        </ul>
                    </div>
                    <div class="lbox">
                        <h3>用片數找拼圖</h3>
                        <ul>
                            <li><a href="#">～100 片 <span>10</span></a></li>
                            <li><a href="#">101～300 片 <span>12</span></a></li>
                            <li><a href="#">301~500 片 <span>14</span></a></li>
                            <li><a href="#">501片~800 片 <span>10</span></a></li>
                            <li><a href="#">801~1,000 片 <span>16</span></a></li>
                            <li><a href="#">1,001~1,200 片 <span>11</span></a></li>
                            <li><a href="#">1,201~1,500 片 <span>18</span></a></li>
                            <li><a href="#">1,501~2,000 片 <span>12</span></a></li>
                            <li><a href="#">2,000片以上 <span>12</span></a></li>
                        </ul>
                    </div>
                    <div class="lbox">
                        <h3>用品牌找拼圖</h3>
                        <ul class="brands">
                            <li><img src="{{ asset("images/brand-logo01.jpg") }}" alt=""/> <img src="{{ asset("images/brand-logo06.jpg") }}" alt=""/>
                            </li>
                            <li><img src="{{ asset("images/brand-logo02.jpg") }}" alt=""/> <img src="{{ asset("images/brand-logo07.jpg") }}" alt=""/>
                            </li>
                            <li><img src="{{ asset("images/brand-logo03.jpg") }}" alt=""/> <img src="{{ asset("images/brand-logo08.jpg") }}" alt=""/>
                            </li>
                            <li><img src="{{ asset("images/brand-logo04.jpg") }}" alt=""/> <img src="{{ asset("images/brand-logo09.jpg") }}" alt=""/>
                            </li>
                            <li><img src="{{ asset("images/brand-logo05.jpg") }}" alt=""/> <img src="{{ asset("images/brand-logo10.jpg") }}" alt=""/>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="ptop">
                        <h5><a href="#">Text 1</a> / <span>Text 2</span></h5>
                        <div class="ptop-right">
                            <span><strong>Show :</strong> <a href="#">9</a> / <a href="#" class="active">12</a> / <a
                                    href="#">18</a> / <a href="#">24</a></span>
                            <span><a href="#"><img src="{{ asset("images/licon01.jpg") }}" alt=""/></a> <a href="#"><img
                                        src="{{ asset("images/licon02.jpg") }}" alt=""/></a> <a href="#"><img src="{{ asset("images/licon03.jpg") }}"
                                                                                                alt=""/></a> <a
                                    href="#"><img src="{{ asset("images/licon04.jpg") }}" alt=""/></a></span>
                            <span>
<select>
<option>Default Sorting</option>
<option>Sorting A to Z</option>
<option>Sorting Z to A</option>
</select>
</span>
                        </div>
                    </div>
                    <div class="plist">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                        <h3>Smart watches wood edition</h3>
                                        <p>Accessories, Clocks</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#">
                                        <span class="offer-green">-20%</span>
                                        <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                        <h3>Penatibus parturient</h3>
                                        <p>Toys</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#"> <span class="offer-hot">HOT</span><img
                                            src="{{ asset("images/product03.jpg") }}" alt=""/>
                                        <h3>Wooden bow tie man</h3>
                                        <p>Accessories</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                        <h3>Smart watches wood edition</h3>
                                        <p>Accessories, Clocks</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#">
                                        <span class="offer-green">-20%</span>
                                        <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                        <h3>Penatibus parturient</h3>
                                        <p>Toys</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#"> <span class="offer-hot">HOT</span><img
                                            src="{{ asset("images/product03.jpg") }}" alt=""/>
                                        <h3>Wooden bow tie man</h3>
                                        <p>Accessories</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                        <h3>Smart watches wood edition</h3>
                                        <p>Accessories, Clocks</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#">
                                        <span class="offer-green">-20%</span>
                                        <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                        <h3>Penatibus parturient</h3>
                                        <p>Toys</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#"> <span class="offer-hot">HOT</span><img
                                            src="{{ asset("images/product03.jpg") }}" alt=""/>
                                        <h3>Wooden bow tie man</h3>
                                        <p>Accessories</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                        <h3>Smart watches wood edition</h3>
                                        <p>Accessories, Clocks</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#">
                                        <span class="offer-green">-20%</span>
                                        <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                        <h3>Penatibus parturient</h3>
                                        <p>Toys</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#"> <span class="offer-hot">HOT</span><img
                                            src="{{ asset("images/product03.jpg") }}" alt=""/>
                                        <h3>Wooden bow tie man</h3>
                                        <p>Accessories</p>
                                        <span><em>$499.00</em> $399.00</span></a></div>
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
@endsection

@section("scripts")
    <!-- Price Rengebar JS Part Start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
            type="text/javascript"></script>
    <script src="{{ asset("js/price_range_script.js") }}" type="text/javascript"></script>

@endsection
