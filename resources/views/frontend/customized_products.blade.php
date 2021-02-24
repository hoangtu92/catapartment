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
                {{--@include("frontend.products.top_filter")--}}
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
                        <input type="hidden" name="product_id" ng-model="customized_product.id" value="@{{customized_product.id}}" id="product_id">
                        <input type="hidden" name="attr[thickness]" id="thickness" ng-model="customized_product.thickness" value="@{{ customized_product.thickness }}">
                        <input type="hidden" name="attr[total_length]" id="total_length" ng-model="customized_product.total_length" value="@{{ customized_product.total_length }}">

                    </form>

                    {{--@include("frontend.products.list")--}}


                    <div class=WordSection1>

                        <p align=center><b><span lang=ZH-TW
                                >收納拼圖之拼圖拆片圖解說明</span></b>
                        </p>


                        <p><span lang=ZH-TW>拼圖完拼後若面臨不知如何收納，或是想要帶去裱框卻不知如何處裡，以下拼圖的拆片方法可以幫助您將已完成的拼圖順利收妥在拼圖盒內。</span>
                        </p>


                        <p><span lang=ZH-TW>【步驟一】：</span></p>

                        <p><img width=554 height=554 id="圖片 2"
                                src="{{ asset('/images/image001.jpg') }}"></p>

                        <p><span lang=ZH-TW>開始拼圖之前，請先準備一塊尺寸比拼圖完成後大一點的塑膠瓦楞板，除了可以直接在塑膠瓦楞板上拼圖之外，亦可在完拼好後將拼圖移到板子上。如圖所示，塑膠瓦楞板比拼圖完成後的尺寸大。</span>
                        </p>

                        <p><b><span lang=ZH-TW>※可至文具行選購不同尺寸的塑膠瓦楞板。</span></b></p>


                        <p><span lang=ZH-TW>【步驟二】：</span></p>

                        <p><img width=554 height=554 id="圖片 1"
                                src="{{ asset('/images/image002.jpg') }}"></p>

                        <p><span lang=ZH-TW>準備幾張比拼圖盒蓋小一些的乾淨紙張。</span></p>

                        <p><span lang=JA>※</span><b><span
                                    lang=ZH-TW>拆片後的拼圖會放在紙張上，建議要拿乾淨的紙張，不要拿報紙或有油墨的紙，以免油墨沾到拼圖）。</span></b></p>


                        <p><span lang=ZH-TW>【步驟三】：</span></p>

                        <p><img width=554 height=554 id="圖片 3"
                                src="{{ asset('/images/image003.jpg') }}"></p>

                        <p><span lang=ZH-TW>將已完拼的拼圖從原本的瓦楞板移至另一塊墊在下方的瓦楞板。</span></p>

                        <p><span lang=ZH-TW>※<b>移動拼圖到另一塊瓦楞板前，可先數好拼片移動的位置，其拼圖大小是否可以完好的放在已準備好的乾淨紙張上面。</b></span>
                        </p>


                        <p><span lang=ZH-TW>【步驟四】</span></p>

                        <p><img width=468 height=375 id="圖片 4"
                                src="{{ asset('/images/image004.jpg') }}"></p>

                        <p><img width=468 height=347 id="圖片 6"
                                src="{{ asset('/images/image005.jpg') }}"></p>

                        <p><span lang=ZH-TW>利用瓦楞板的高低落差，用手指下壓將拼片分開。</span></p>


                        <p><span lang=ZH-TW>【步驟五】</span></p>

                        <p><img width=554 height=554 id="圖片 7"
                                src="{{ asset('/images/image006.jpg') }}"></p>

                        <p><span lang=ZH-TW>重複以上步驟，將拆下來的拼片移到事先準備好的紙張上（拆片的拼圖要符合紙張大小，切勿超過紙張的範圍，以免拼圖散落）。</span>
                        </p>


                        <p><span lang=ZH-TW>【步驟五】</span></p>

                        <p><img width=554 height=554 id="圖片 8"
                                src="{{ asset('/images/image007.jpg') }}"></p>

                        <p><span lang=ZH-TW>將拼圖依序拆片完成，並放在乾淨的紙張上。</span></p>


                        <p><span lang=ZH-TW>【步驟六】</span></p>

                        <p><img width=554 height=554 id="圖片 9"
                                src="{{ asset('/images/image008.jpg') }}"></p>

                        <p class=MsoListParagraph><span lang=ZH-TW
                            >將拆好的拼圖連同底下的紙張一起放入拼圖盒蓋內，將盒底反過來壓在拼圖上放（務必將盒底反過來壓住拼圖，才能完整固定住拼圖，以免發生搖晃的情況而讓拼圖散開！）</span>
                        </p>


                        <p><span lang=ZH-TW>【步驟七】</span></p>

                        <p><img width=554 height=554 id="圖片 10"
                                src="{{ asset('/images/image009.jpg') }}"></p>

                        <p class=MsoListParagraph><span lang=ZH-TW
                            >如圖所示，用拼圖盒底反壓住拼圖，以確保拼圖不會因為移動或搖晃而散掉，後續使用橡皮筋，或是盒子四邊黏上無痕膠帶、用長尾夾夾住等方式讓拼圖完整固定住，就可以完好的收納，也可以把拼圖帶出門拿到拼圖店裱框了！</span>
                        </p>

                        <video style="width: 100%" autoplay muted controls src="{{ asset("/uploads/frame-videos/frame_video.mp4") }}"></video>


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
