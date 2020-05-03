@extends("frontend.templates.default")

@section("meta")
    <meta property="og:title" content="{{ $product->name }}"/>
    <meta property="og:description" content="{{ $product->content }}"/>
    <meta property="og:image" content="{{ asset($product->image) }}"/>
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

    <section class="detail-page">
        <div class="container">
            <form class="row" action="{{ route("cart") }}" method="post">
                @csrf
                <input type="hidden" name="action" value="add">
                <!--Product slide-->
                <div class="col-lg-6 flex-column justify-content-center align-items-center">
                    @if(count($product->images) > 0)
                        <div id="thumbnail-slider" data-options="defaultOptions" style="float:left;">
                            <div class="inner">
                                <ul>
                                    @foreach($product->images as $image)
                                        <li><a class="thumb" href="{{ asset($image) }}"></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div id="ninja-slider" data-options="nsOptions" style="float:left;">
                            <div class="slider-inner">
                                <ul>
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
                    <h1>{{ $product->name }}</h1>
                    <p class="cre"><img src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img
                            src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img
                            src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img
                            src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img
                            src="{{ asset("images/star-icon01.jpg") }}" alt=""/> ( 1 customer review )</p>
                    <h3 class="price"><span>${{ $product->price }}</span> ${{ $product->sale_price }}</h3>
                    {!! $product->short_description !!}

                    @if($product->colors != null)
                        <div class="color-div">
                            <span>Color : </span>
                            @foreach($product->colors as $color)
                                <span>
                                <input id="color-{{$color->id}}" type="radio" value="{{ $color->name }}"
                                       style="display: none" name="color">
                                <label for="color-{{$color->id}}" style="background-color: {{ $color->value }}"
                                       title="{{ $color->name }}"></label>
                            </span>
                            @endforeach
                        </div>
                    @endif

                <!--Product attribute options-->
                    <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus"
                      data-field="qty">
                  <span>-</span>
              </button>
          </span>
                        <input type="text" name="qty" class="form-control input-number" value="1" min="1" max="10">
                        <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="qty">
                  <span>+</span>
              </button>
          </span>
                    </div>
                    <!--Product attribute options-->

                    <!--Product add to cart-->

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="submit" class="addto" value="{{ __("Add to cart") }}"/>


                    <div class="add-wishlist"><a href="#"><img src="{{ asset("images/icon02.jpg") }}" alt=""/> Add to
                            Wishlist</a></div>
                    <hr>
                    <!--Product add to cart-->

                    <h4><strong>SKU :</strong> {{ $product->sku || "N/A" }}</h4>
                    <h4><strong>Category :</strong> {{ $product->category->name }}</h4>
                    <h4><strong>Share :

                            <!-- Your share button code -->
                            <a target="_blank"
                               href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u={{ route("product_detail", ["slug" => $product->slug]) }}&display=popup&ref=plugin&src=share_button"
                            ><img src="{{ asset("images/facebook-icon.png") }}" width="25" alt=""/></a>

                            <a target="_blank"
                               href="https://twitter.com/intent/tweet?original_referer={{ route("product_detail", ["slug" => $product->slug]) }}&ref_src=twsrc%5Etfw&text={{ $product->name }}&tw_p=tweetbutton&url={{ route("product_detail", ["slug" => $product->slug]) }}"><img
                                    src="{{ asset("images/twitter-icon.png") }}" width="30" alt=""/></a>

                        </strong>
                    </h4>
                </div>
                <!--Product info-->
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <!--Product detail information-->
                <div id="horizontalTab">
                    <ul class="resp-tabs-list">
                        @if($product->content != null)
                            <li>Description</li>
                        @endif

                        @if($product->brand != null)
                            <li>Additional Information</li>
                        @endif

                        @if($product->review != null)
                            <li>Review</li>
                        @endif

                        @if($product->brand != null && $product->brand->description != null)
                            <li>About Brand</li>
                        @endif

                        @if(count($product->shipping_methods) > 0)
                            <li>Shipping & Delivery</li>
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
                                                <tr>
                                                    <td><b>Brand</b></td>
                                                    <td>{{ $product->brand->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Color</b></td>
                                                    <td>{{ implode(", ", $product->colorname) }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Measures</b></td>
                                                    <td>{{ $product->measures }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Origin</b></td>
                                                    <td>{{ $product->origin }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($product->review != null)
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>1 Review for best clock parallels</h3>
                                        <div class="re-box">
                                            <img src="{{ asset("images/user-img.jpg") }}" alt=""/>
                                            <h4><b>Donald Holmes</b> - July 28,2017</h4><span><img
                                                    src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img
                                                    src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img
                                                    src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img
                                                    src="{{ asset("images/star-icon01.jpg") }}" alt=""/><img
                                                    src="{{ asset("images/star-icon01.jpg") }}" alt=""/></span>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. Lorem Ipsum has been the industry's standard dummy text </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h3 class="mb-3">Add a Review</h3>
                                        <p>Your email address will not be published. Required fields are marked*</p>
                                        <p class="rating"><strong>Your Rating :</strong> <img
                                                src="{{ asset("images/star-icon02.jpg") }}" alt=""/><img
                                                src="{{ asset("images/star-icon02.jpg") }}" alt=""/><img
                                                src="{{ asset("images/star-icon02.jpg") }}" alt=""/><img
                                                src="{{ asset("images/star-icon02.jpg") }}" alt=""/><img
                                                src="{{ asset("images/star-icon02.jpg") }}" alt=""/></p>

                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Your Review <em>*</em></label>
                                                        <textarea class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name <em>*</em></label>
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email <em>*</em></label>
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="checkbox-btn">Save my name, email, and website in
                                                            this browser for the next time i comment.
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button class="btn02">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>


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

    <section class="container-fluid recently-viewed">
        <div class="row">
            <div class="col-lg-12">
                <h2>最近看過的商品</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 guide-slider">
                <div id="rv-slider" class="owl-carousel">
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a></div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a></div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product03.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a></div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product01.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a></div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product02.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a></div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="acce-box"><a href="#"> <img src="{{ asset("images/product03.jpg") }}" alt=""/>
                                <h3>Smart watches wood edition</h3>
                                <p>Accessories, Clocks</p>
                                <span><em>$499.00</em> $399.00</span></a></div>
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
    <script src="{{ asset("js/ninja-slider.js") }}"></script>
    <script src="{{ asset("js/thumbnail-slider.js") }}"></script>
    <script src="{{ asset("js/price_range_script.js") }}" type="text/javascript"></script>
    <script src="{{ asset("js/cart.js") }}" type="text/javascript"></script>

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
