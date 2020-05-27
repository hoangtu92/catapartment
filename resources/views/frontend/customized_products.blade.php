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

                    <!--top filter-->
                @include("frontend.products.top_filter")
                <!--top filter-->

                    <div class="sprice"><h2><span>裱框訂製估價</span></h2></div>

                    <div class="ssearch-box" ng-init="getFrames(); getThickness()">
                        <form method="post" name="customProduct" id="customProduct" ng-submit="calculatePrice()">
                            <select ng-model="product.frame">
                                <option value="">請選擇材質</option>
                                <option ng-repeat="item in frames" ng-value="item" ng-bind="item.name"></option>
                            </select>
                            <select ng-model="product.thickness">
                                <option ng-value="0">請選擇框厚度</option>
                                <option ng-repeat="item in thickness" ng-value="item.value"
                                        ng-bind="item.name"></option>
                            </select>
                            <input type="number" ng-model="product.totalLength" placeholder="請填寫單邊長+寬尺寸">
                            <button type="submit">立刻估價</button>
                        </form>
                    </div>

                    <div class="vresults" ng-show="result.price >= 0">
                        <h2>估價結果</h2>
                        <div class="row">
                            <div class="col-md-4"><img src="{{ asset("images/image02.jpg") }}" alt=""/></div>
                            <div class="col-md-8">
                                <h3>你選擇的框是<i ng-bind="result.frame.name"></i>，寬<i ng-bind="result.thickness"></i>公分，長<i
                                        ng-bind="result.totalLength"></i>公分的訂製，含透明壓克力表層，數量一組。</h3>
                                <span>價格：<i ng-bind="result.price || 0"></i>元</span>
                                {{--<span>Shipping Fee：<i ng-bind="result.shipping_fee || 0"></i></span>--}}
                                <span>工作天：<i ng-bind="result.frame.time"></i>天</span>
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
                                <span class="bt"><a href="#" ng-click="resetSelection()" class="btn2">重新估算</a> <button type="submit" form="customizedProductAddCartForm"
                                        class="btn4">我要訂製</button></span>
                            </div>
                        </div>
                    </div>



                    <form action="{{ route("cart") }}" method="post" id="customizedProductAddCartForm" name="customizedProductAddCartForm">
                        @csrf
                        <input type="hidden" name="action" value="add_cart">
                        <input type="hidden" name="qty" value="1">
                        <input type="hidden" name="customized_product_id" ng-model="customized_product.id" value="@{{customized_product.id}}" id="product_id">
                        <input type="hidden" name="attr[thickness]" id="thickness" ng-model="customized_product.thickness" value="@{{ customized_product.thickness }}">
                        <input type="hidden" name="attr[total_length]" id="total_length" ng-model="customized_product.total_length" value="@{{ customized_product.total_length }}">

                    </form>

                    @include("frontend.products.list")
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
