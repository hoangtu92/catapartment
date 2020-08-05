@extends("frontend.templates.default")

@section("meta")
    <meta property="og:title" content="{{ $product->name }}"/>
    <meta property="og:description" content="{{ $product->content }}"/>
    <meta property="og:image" content="{{ asset($product->image) }}"/>

    <meta name="description" content="{{ strip_tags($product->short_description) }}">
    <meta name="keywords" content="{{ $product->keywords }}">
@endsection

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/thumbnail-slider.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/ninja-slider.css") }}"/>
@endsection

@section("content")

    <section
        class="detail-page @if($current_user != null && $current_user->hasPurchased($product->id)) hasPurchased  @endif">
        <div class="container">
            <form class="row" action="{{ route("cart") }}" method="post">
            @csrf

            <!--Product slide-->
                <div class="col-lg-6 flex-column justify-content-center align-items-center">
                    @if(count($product->images) > 0)
                        <div id="thumbnail-slider" data-options="defaultOptions" style="float:left;">
                            <div class="inner">
                                <ul>
                                    <li><a class="thumb" href="{{ asset($product->image) }}"></a></li>
                                    @foreach($product->images as $image)
                                        <li><a class="thumb" href="{{ asset($image) }}"></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div id="ninja-slider" data-options="nsOptions" style="float:left;">
                            <div class="slider-inner">
                                <ul>
                                    <li><a class="ns-img" href="{{ asset($product->image) }}"></a></li>
                                    @foreach($product->images as $image)
                                        <li><a class="ns-img" href="{{ asset($image) }}"></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <img alt="{{ $product->name }}" src="{{ asset($product->image) }}"
                             style="width:100%; object-fit: cover">
                    @endif

                    <div class="p-badge">
                        @if($product->is_hot)
                            <div class="badge-hot">HOT</div>
                        @endif

                        @if($product->sale_price >=0 && $product->sale_price < $product->price)
                            <div
                                class="badge-sales-off">{{ round(( ($product->sale_price - $product->price)/$product->price)*100) }}
                                %
                            </div>
                        @endif
                    </div>

                </div>
                <!--Product slide-->

                <!--Product info-->
                <div class="col-lg-6">
                    <div class="bread"><a href="#">首頁</a> / <a href="#">拼圖商店</a> / <span>{{ $product->name }}</span>
                    </div>
                    <h1 class="product-name">{{ $product->name }}</h1>

                    <p class="cre" data-rating="{{$product->averageRating}}">
                        @if($product->averageRating >= 0)
                            <img src="{{ asset("images/star-icon01.jpg") }}" alt=""/>
                        @else
                            <img src="{{ asset("images/star-icon02.jpg") }}" alt=""/>
                        @endif

                        @if($product->averageRating >= 2)
                            <img src="{{ asset("images/star-icon01.jpg") }}" alt=""/>
                        @else
                            <img src="{{ asset("images/star-icon02.jpg") }}" alt=""/>
                        @endif

                        @if($product->averageRating >= 3)
                            <img src="{{ asset("images/star-icon01.jpg") }}" alt=""/>
                        @else
                            <img src="{{ asset("images/star-icon02.jpg") }}" alt=""/>
                        @endif

                        @if($product->averageRating >= 4)
                            <img src="{{ asset("images/star-icon01.jpg") }}" alt=""/>
                        @else
                            <img src="{{ asset("images/star-icon02.jpg") }}" alt=""/>
                        @endif

                        @if($product->averageRating >= 5)
                            <img src="{{ asset("images/star-icon01.jpg") }}" alt=""/>
                        @else
                            <img src="{{ asset("images/star-icon02.jpg") }}" alt=""/>
                        @endif

                                        ( {{ count($product->reviews) }} 個評論  )</p>
                    <h3 class="price"><span>${{ $product->price }}</span> ${{ $product->sale_price }}</h3>
                    {!! $product->short_description !!}

                    @if($product->colors != null)
                        <div class="color-div">
                            <span>顏色 : </span>
                            @foreach($product->colors as $color)
                                <span>
                                <input id="color-{{$color->id}}" type="radio" value="{{ $color->name }}"
                                       style="display: none" name="attr[color]">
                                <label for="color-{{$color->id}}" style="background-color: {{ $color->value }}"
                                       title="{{ $color->name }}"></label>
                            </span>
                            @endforeach
                        </div>
                    @endif


                <!--Product add to cart-->

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    @if($product->isAvailable)

                        <input type="hidden" name="action" value="add_cart">

                        <!--Product attribute options-->
                        <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus"
                      data-field="qty">
                  <span>-</span>
              </button>
          </span>
                            <input type="text" @if(!$product->is_available) disabled @endif name="qty"
                                   class="form-control input-number" value="1" min="1" max="10">
                            <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="qty">
                  <span>+</span>
              </button>
          </span>
                        </div>
                        <!--Product attribute options-->

                        <input type="submit" class="addto" value="{{ __("Add to cart") }}"/>
                    @else

                        <div><input type="submit" class="addto notify_product_btn" name="action" value="貨到通知"></div>
                    @endif

                    <div class="add-wishlist">
                        @if(in_array($product->id, $wishlist['ids']))
                            <a href="#" onclick="document.querySelector('#wishlist-form').submit()">
                                <img src="{{ asset("images/icon02-active.jpg") }}" alt=""/> {{ __("Add to wishlist") }}
                            </a>
                        @else
                            <a href="#" onclick="document.querySelector('#wishlist-form').submit()">
                                <img src="{{ asset("images/icon02.jpg") }}" alt=""/> {{ __("Add to wishlist") }}</a>
                        @endif

                    </div>

                    <hr>
                    <!--Product add to cart-->

                    <h4><strong>貨號 :</strong> {{ $product->sku || "N/A" }}</h4>

                    @if($product->category)
                        <h4><strong>目錄 :</strong> {{ $product->category->name }}</h4>
                    @endif

                    <h4><strong>分享 :

                            <!-- Your share button code -->
                            <a target="_blank"
                               href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u={{ route("product_detail", ["slug" => $product->slug]) }}&display=popup&ref=plugin&src=share_button"
                            ><img src="{{ asset("images/facebook-icon.png") }}" width="25" alt=""/></a>

                            {{--
                                                        <a target="_blank" href="" title="Instagram"> <img src="{{ asset("images/instagram-icon.png") }}" width="25" alt=""/></a>
                            --}}
                            <a target="_blank" href="https://www.pinterest.com/pin/create/button/"
                               data-pin-do="buttonBookmark" data-pin-custom="true" title="Pinterest"> <img
                                    src="{{ asset("images/pinterest_icon.png") }}" width="25" alt=""/></a>
                            <a target="_blank"
                               href="mailto:?subject={{ $product->name }}&amp;body={{ $product->short_description }} {{ $product->permalink }}<br>"
                               title="Email"> <img src="{{ asset("images/mail-icon.png") }}" width="25" alt=""/></a>

                            {{-- <a target="_blank"
                                href="https://twitter.com/intent/tweet?original_referer={{ route("product_detail", ["slug" => $product->slug]) }}&ref_src=twsrc%5Etfw&text={{ $product->name }}&tw_p=tweetbutton&url={{ route("product_detail", ["slug" => $product->slug]) }}"><img
                                     src="{{ asset("images/twitter-icon.png") }}" width="30" alt=""/></a>--}}

                        </strong>
                    </h4>
                    <h4><strong>庫存: </strong><span>{{ $product->stock }}</span></h4>
                </div>
                <!--Product info-->
            </form>
        </div>
        <hr>
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <!--Product detail information-->
                    <div id="horizontalTab">
                        <ul class="resp-tabs-list">
                            @if($product->content != null)
                                <li>商品細節</li>
                            @endif

                            @if($product->brand != null || $product->colors != null || $product->measures != null || $product->origin != null)
                                <li>更多資訊</li>
                            @endif

                            @if(count($product->reviews) > 0)
                                <li>評價</li>
                            @endif

                            @if($product->brand != null && $product->brand->description != null)
                                <li>關於品牌</li>
                            @endif

                            @if(count($product->shipping_methods) > 0)
                                <li>{{ __("Shipping & Delivery") }}</li>
                            @endif
                        </ul>
                        <div class="resp-tabs-container">

                            @if($product->content != null)
                                <div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! $product->content !!}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($product->brand != null || $product->colors != null || $product->measures != null || $product->origin != null)
                                <div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="cart-tb">
                                                <table class="table full-width" style="max-width:500px; margin:auto;">
                                                    <tbody>

                                                    @if($product->brand)
                                                        <tr>
                                                            <td><b>品牌</b></td>
                                                            <td>{{ $product->brand->name }}</td>
                                                        </tr>
                                                    @endif

                                                    @if($product->colors)
                                                        <tr>
                                                            <td><b>顏色</b></td>
                                                            <td>{{ implode(", ", $product->colorname) }}</td>
                                                        </tr>
                                                    @endif

                                                    @if($product->measures)
                                                        <tr>
                                                            <td><b>尺寸</b></td>
                                                            <td>{{ $product->measures }}</td>
                                                        </tr>
                                                    @endif

                                                    @if($product->origin)
                                                        <tr>
                                                            <td><b>進口國家</b></td>
                                                            <td>{{ $product->origin->name }}</td>
                                                        </tr>
                                                    @endif


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            @if(count($product->reviews) > 0)
                                <div>
                                    <div class="row">

                                        <div class="col-12">
                                            {{--<h3>{{ count($product->reviews) }} 則評價</h3>--}}
                                            <div class="re-box">
                                                @foreach($product->orderItems as $orderItem)


                                                            <div>
                                                        {{--<img class="avatar" src="{{ asset("images/user-img.jpg") }}" alt=""/>--}}
                                                                @if($orderItem->rating != null && $orderItem->review != null)


                                                        @if(!empty($orderItem->order->user))
                                                            <h4><b>{{  mb_substr($orderItem->order->user->name, 0, 3, "utf-8") }}****</b>
                                                                - {{ date_format(new DateTime($orderItem->review_date), "Y/m/d") }}
                                                            </h4>
                                                                    <p class="cre">
                                                                        @if($orderItem->rating >= 1)
                                                                            <img src="{{ asset("images/star-icon01.jpg") }}"
                                                                                 alt=""/>
                                                                        @else
                                                                            <img src="{{ asset("images/star-icon02.jpg") }}"
                                                                                 alt=""/>
                                                                        @endif

                                                                        @if($orderItem->rating >= 2)
                                                                            <img src="{{ asset("images/star-icon01.jpg") }}"
                                                                                 alt=""/>
                                                                        @else
                                                                            <img src="{{ asset("images/star-icon02.jpg") }}"
                                                                                 alt=""/>
                                                                        @endif

                                                                        @if($orderItem->rating >= 3)
                                                                            <img src="{{ asset("images/star-icon01.jpg") }}"
                                                                                 alt=""/>
                                                                        @else
                                                                            <img src="{{ asset("images/star-icon02.jpg") }}"
                                                                                 alt=""/>
                                                                        @endif

                                                                        @if($orderItem->rating >= 4)
                                                                            <img src="{{ asset("images/star-icon01.jpg") }}"
                                                                                 alt=""/>
                                                                        @else
                                                                            <img src="{{ asset("images/star-icon02.jpg") }}"
                                                                                 alt=""/>
                                                                        @endif

                                                                        @if($orderItem->rating >= 5)
                                                                            <img src="{{ asset("images/star-icon01.jpg") }}"
                                                                                 alt=""/>
                                                                        @else
                                                                            <img src="{{ asset("images/star-icon02.jpg") }}"
                                                                                 alt=""/>
                                                                        @endif
                                                                    </p>
                                                                    <p>{{ $orderItem->review }}</p>
                                                        @endif


                                                                    @endif
                                                    </div>
                                                @endforeach

                                                @if($current_user != null && $current_user->hasPurchased($product->id) && $product->orderItem->rating == null)
                                                    <h3 class="mb-3">留下您的評價
                                                    </h3>
                                                    <p class="text-orange">請放心，系統將會匿名發布您的評價
                                                    </p>

                                                    <form
                                                        action="{{ route("order_detail", [$product->orderItem->order->order_id, "redirect" => route("product_detail", [$product->slug])]) }}"
                                                        method="post">
                                                        @csrf

                                                        <p><strong>星等 :</strong></p>
                                                        <div class="rating">
                                                            <label
                                                                ng-class="{ checked: order.rating[{{ $product->orderItem->id}}] == 5}"
                                                                @if($product->orderItem->rating == 5) class="checked" @endif><input
                                                                    ng-model="order.rating[{{ $product->orderItem->id}}]"
                                                                    type="radio"
                                                                    name="item[{{ $product->orderItem->id}}][rating]"
                                                                    value="5"> ☆</label>
                                                            <label
                                                                ng-class="{ checked: order.rating[{{ $product->orderItem->id}}] == 4}"
                                                                @if($product->orderItem->rating == 4) class="checked" @endif><input
                                                                    ng-model="order.rating[{{ $product->orderItem->id}}]"
                                                                    type="radio"
                                                                    name="item[{{ $product->orderItem->id}}][rating]"
                                                                    value="4"> ☆</label>
                                                            <label
                                                                ng-class="{ checked: order.rating[{{ $product->orderItem->id}}] == 3}"
                                                                @if($product->orderItem->rating == 3) class="checked" @endif><input
                                                                    ng-model="order.rating[{{ $product->orderItem->id}}]"
                                                                    type="radio"
                                                                    name="item[{{ $product->orderItem->id}}][rating]"
                                                                    value="3"> ☆</label>
                                                            <label
                                                                ng-class="{ checked: order.rating[{{ $product->orderItem->id}}] == 2}"
                                                                @if($product->orderItem->rating == 2) class="checked" @endif><input
                                                                    ng-model="order.rating[{{ $product->orderItem->id}}]"
                                                                    type="radio"
                                                                    name="item[{{ $product->orderItem->id}}][rating]"
                                                                    value="2"> ☆</label>
                                                            <label
                                                                ng-class="{ checked: order.rating[{{ $product->orderItem->id}}] == 1}"
                                                                @if($product->orderItem->rating == 1) class="checked" @endif><input
                                                                    ng-model="order.rating[{{ $product->orderItem->id}}]"
                                                                    type="radio"
                                                                    name="item[{{ $product->orderItem->id}}][rating]"
                                                                    value="1"> ☆</label>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label><strong>留下評論 <em>*</em></strong></label>
                                                                    <textarea
                                                                        name="item[{{ $product->orderItem->id }}][review]"
                                                                        class="form-control">{{ $product->orderItem->review }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn02">送出</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                @endif
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($product->brand != null && $product->brand->description != null)
                                <div>
                                    <div class="row">

                                        <div class="col-12">
                                            {!! $product->brand->description !!}
                                        </div>
                                        {{--<div class="col-md-4">

                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-lg-4"><img src="{{ asset("images/product01.jpg") }}"
                                                                           alt=""/></div>
                                                <div class="col-lg-4"><img src="{{ asset("images/product02.jpg") }}"
                                                                           alt=""/></div>
                                                <div class="col-lg-4"><img src="{{ asset("images/product03.jpg") }}"
                                                                           alt=""/></div>
                                            </div>

                                        </div>--}}
                                    </div>
                                </div>
                            @endif

                            @if(count($product->shipping_methods) > 0)
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="{{ asset("images/shipping-img.jpg") }}" alt=""/></div>
                                        <div class="col-md-6">
                                            @foreach($product->shipping_methods as $shipping_method)
                                                <div class="mb-2">
                                                    <h3 class="mb-2">{{ $shipping_method->name }}</h3>
                                                    {!! $shipping_method->description !!}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif


                        </div>
                    </div>
                    <!--Product detail information-->
                </div>
            </div>

        </div>
    </section>


    @if(count($recent_view_products) > 0)
        <section class="container-fluid recently-viewed">
            <div class="row">
                <div class="col-lg-12">
                    <h2>最近看過的商品</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 guide-slider">
                    <div id="rv-slider" class="owl-carousel">

                        @foreach($recent_view_products as $p)
                            <div class="item" data-aos="fade-up">
                                <div class="acce-box"><a href="{{ $p->permalink }}"> <img src="{{ asset($p->image) }}"
                                                                                          alt=""/>
                                        <h3>{{ $p->name }}</h3>
                                        <span><em>${{ $p->price }}</em> ${{ $p->sale_price }}</span></a></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif


    <form id="wishlist-form" action="{{ route("wishlist") }}" method="post">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="action" value="add_wishlist">
    </form>

    @include("frontend.global.notify_product")
@endsection

@section("scripts")

    @if($product->sku)
        <!--<script>
            window.onbeforeunload  = function () {
                var confirm = window.confirm("是否加入我\n" +
                    "的最愛或放入購物⾞，是？ 或 否？");

                if(!confirm){
                    return true;
                }
                return "";
            }
        </script>-->
    @endif

    <!-- Price Rengebar JS Part Start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
            type="text/javascript"></script>
    <script src="{{ asset("js/ninja-slider.js") }}"></script>
    <script src="{{ asset("js/thumbnail-slider.js") }}"></script>
    <script src="{{ asset("js/price_range_script.js") }}" type="text/javascript"></script>
    <script src="{{ asset("js/cart.js") }}" type="text/javascript"></script>
    <script
        type="text/javascript"
        async defer
        src="//assets.pinterest.com/js/pinit.js"
    ></script>

    <script>

        var nsSlider, thumbSlider;

        var imageOptions =
            {
                sliderId: "ninja-slider",
                transitionType: "fade", //"fade", "slide", "zoom", "kenburns 1.2" or "none"
                autoAdvance: false,
                delay: "default",
                transitionSpeed: 700,
                aspectRatio: "1:1",
                initSliderByCallingInitFunc: false,
                shuffle: false,
                startSlideIndex: 0, //0-based
                navigateByTap: true,
                pauseOnHover: false,
                keyboardNav: true,
                license: "b2e981"
            }, thumbOptions =
            {
                sliderId: "thumbnail-slider",
                orientation: "vertical",
                thumbWidth: "80px",
                thumbHeight: "80px",
                showMode: 2,
                autoAdvance: true,
                selectable: true,
                slideInterval: 3000,
                transitionSpeed: 900,
                aspectRatio: "1:1",
                shuffle: false,
                startSlideIndex: 0, //0-based
                pauseOnHover: true,
                initSliderByCallingInitFunc: false,
                rightGap: 0,
                keyboardNav: false,
                mousewheelNav: true,
                license: "b2e98"
            };


        jQuery(document).ready(function ($) {

            //Subscribe product
            $(".notify_product_btn").click(function (e) {
                e.preventDefault();
                $("#notifyProductModal").modal()
            });


            // provide any default options you want
            thumbOptions.before = function (currentIdx, nextIdx, manual) {
                nsSlider.displaySlide(nextIdx);
            };
            // init carousel
            thumbSlider = new ThumbnailSlider(thumbOptions);

            imageOptions.before = function (currentIdx, nextIdx, manual) {
                thumbSlider.display(nextIdx);
            };

            // init carousel
            nsSlider = new NinjaSlider(imageOptions);
        })

    </script>

@endsection
