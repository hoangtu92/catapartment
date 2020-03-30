@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
@endsection

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_customized_product")) }}" alt=""/>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ptop">
                        <h5><a href="#">首頁</a> / <span>拼圖情報</span></h5>
                        <div class="ptop-right">
                            <span><strong>Show :</strong> <a href="#">9</a> / <a href="#" class="active">12</a> / <a
                                    href="#">18</a> / <a href="#">24</a></span>
                            <span><a href="#"><img src="{{ asset("images/licon01.jpg") }}" alt=""/></a> <a href="#"><img
                                        src="{{ asset("images/licon02.jpg") }}" alt=""/></a> <a href="#"><img
                                        src="{{ asset("images/licon03.jpg") }}" alt=""/></a> <a href="#"><img
                                        src="{{ asset("images/licon04.jpg") }}" alt=""/></a></span>
                            <span>
<select>
<option>Default Sorting</option>
<option>Sorting A to Z</option>
<option>Sorting Z to A</option>
</select>
</span>
                        </div>
                    </div>
                    <div class="sprice"><h2><span>裱框訂製估價</span></h2></div>

                    <div class="ssearch-box"  ng-init="getFrames(); getThickness()">
                        <form method="post" name="customProduct" id="customProduct" ng-submit="calculatePrice()">
                            <select ng-model="product.frame">
                                <option value="">請選擇材質</option>
                                <option ng-repeat="item in frames" ng-value="item.name" ng-bind="item.name"></option>
                            </select>
                            <select ng-model="product.thickness">
                                <option ng-value="0">請選擇框厚度</option>
                                <option ng-repeat="item in thickness" ng-value="item.value" ng-bind="item.name"></option>
                            </select>
                            <input type="number" ng-model="product.totalLength" placeholder="請填寫單邊長+寬尺寸">
                            <button type="submit">立刻估價</button>
                        </form>
                    </div>

                    <div class="vresults">
                        <h2>估價結果</h2>
                        <div class="row">
                            <div class="col-md-4"><img src="{{ asset("images/image02.jpg") }}" alt=""/></div>
                            <div class="col-md-8">
                                <h3>你選擇的框是<i ng-bind="result.frame"></i>，寬<i ng-bind="result.thickness"></i>公分，長<i ng-bind="result.totalLength"></i>公分的訂製，含透明壓克力表層，數量一組。</h3>
                                <span>價格：<i ng-bind="result.price"></i></span>
                                <span>元工作天：10天</span>
                                <span>物流：
<div class="rbtn">
<label class="rd-btn">自取無運費
  <input type="radio" checked="checked" ng-model="order.delivery" value="pickup" name="delivery">
  <p class="checkmark"></p>
</label>
<label class="rd-btn">貨運需另行估算運費
  <input type="radio" name="delivery" ng-model="order.delivery" value="shipping">
  <p class="checkmark"></p>
</label>
</div>
</span>
                                <span class="bt"><a href="#" class="btn2">重新估算</a> <a href="#"
                                                                                      class="btn4">我要訂製</a></span>
                            </div>
                        </div>
                    </div>


                    <div class="plist">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}"
                                                                        alt=""/>
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
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}"
                                                                        alt=""/>
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
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}"
                                                                        alt=""/>
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
                                <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}"
                                                                        alt=""/>
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
