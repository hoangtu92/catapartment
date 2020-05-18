@extends("frontend.templates.default")
@section("content")
    <section class="home-banner">
        <div class="container">
            <div class="home-slider">
                <div class="hcat-list t-0">
                    @include("frontend.products.product_category")
                </div>
                <div id="home-slider" class="owl-carousel">
                    @foreach($slides as $slide)

                        <div class="item" data-aos="fade-up" title="{{ $slide->title }}"
                             @if($slide->link != null) onclick="window.location.href='{{$slide->link}}'" @endif
                             style="background:url({{ asset($slide->image) }}) no-repeat center top; @if($slide->link != null) cursor: pointer; @endif"></div>

                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="collection">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 htitle"><span>CATS APARTMENT COLLECTIONS</span>
                    <h2>VIP拼圖推薦</h2>
                    <p>You have to believe in yourself. That’s the secret of success.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4 cb">
                    @if(isset($latest_products[1]))
                        <a href="{{ $latest_products[1]->product->permalink }}">
                            <h3>{{ $latest_products[1]->product->category->name }}</h3>
                            <img src="{{ asset($latest_products[1]->product->image) }}" alt=""/></a>
                    @else
                        <a href="#">
                            <h3>可愛動物系列</h3>
                            <img src="{{ asset("images/hcollection-img01.jpg") }}" alt=""/></a>
                    @endif
                </div>

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-4 cb">

                            @if(isset($latest_products[2]))
                                <a href="{{ $latest_products[2]->product->permalink }}">
                                    <h3>{{ $latest_products[2]->product->category->name }}</h3>
                                    <img src="{{ asset($latest_products[2]->product->image) }}" alt=""/></a>
                            @else

                                <a href="#">
                                    <h4>可愛動物系列</h4>
                                    <img src="{{ asset("images/hcollection-img03.jpg") }}" alt=""/></a>

                            @endif

                        </div>
                        <div class="col-lg-6 col-md-6 mb-4 cb">

                            @if(isset($latest_products[3]))
                                <a href="{{ $latest_products[3]->product->permalink }}">
                                    <h3>{{ $latest_products[3]->product->category->name }}</h3>
                                    <img src="{{ asset($latest_products[3]->product->image) }}" alt=""/></a>
                            @else

                                <a href="#">
                                    <h4>可愛動物系列</h4>
                                    <img src="{{ asset("images/hcollection-img04.jpg") }}" alt=""/></a>

                            @endif

                        </div>
                        <div class="col-lg-6 col-md-6 mb-4 cb">

                            @if(isset($latest_products[4]))
                                <a href="{{ $latest_products[4]->product->permalink }}">
                                    <h3>{{ $latest_products[4]->product->category->name }}</h3>
                                    <img src="{{ asset($latest_products[4]->product->image) }}" alt=""/></a>
                            @else

                                <a href="#">
                                    <h4>可愛動物系列</h4>
                                    <img src="{{ asset("images/hcollection-img05.jpg") }}" alt=""/></a>

                            @endif

                        </div>
                        <div class="col-lg-6 col-md-6 mb-4 cb">

                            @if(isset($latest_products[5]))
                                <a href="{{ $latest_products[5]->product->permalink }}">
                                    <h3>{{ $latest_products[5]->product->category->name }}</h3>
                                    <img src="{{ asset($latest_products[5]->product->image) }}" alt=""/></a>
                            @else

                                <a href="#">
                                    <h4>可愛動物系列</h4>
                                    <img src="{{ asset("images/hcollection-img05.jpg") }}" alt=""/></a>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="h-accessories">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 htitle"><span>CATS APARTMENT ACCESSORIES</span>
                    <h2>人氣拼圖推薦</h2>
                    <p>You have to believe in yourself. That’s the secret of success.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="horizontalTab">
                        <ul class="resp-tabs-list">
                            <li>熱賣拼圖</li>
                            <li>新品預購</li>
                            <li>換季促銷</li>
                        </ul>
                        <div class="resp-tabs-container">

                            <div>
                                <div class="row">

                                    @if(isset($recommend_products['熱賣拼圖']))
                                        @foreach($recommend_products['熱賣拼圖'] as $p)
                                            <div class="col-md-4">
                                                <div class="acce-box"><a href="{{ $p->product->permalink }}"> <img
                                                            src="{{ asset($p->product->image) }}"
                                                            alt=""/>
                                                        <h3>{{ $p->product->name }}</h3>
                                                        <p>{{ $p->product->category->name }}</p>
                                                        <span>${{ $p->product->sale_price }}</span></a></div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="col-lg-12 text-center mb-5"><a href="#" class="btn3">More...</a></div>
                                </div>
                            </div>


                            <div>
                                <div class="row">
                                    @if(isset($recommend_products['新品預購']))
                                        @foreach($recommend_products['新品預購'] as $p)
                                            <div class="col-md-4">
                                                <div class="acce-box"><a href="{{ $p->product->permalink }}"> <img
                                                            src="{{ asset($p->product->image) }}"
                                                            alt=""/>
                                                        <h3>{{ $p->product->name }}</h3>
                                                        <p>{{ $p->product->category->name }}</p>
                                                        <span>${{ $p->product->sale_price }}</span></a></div>
                                            </div>
                                        @endforeach

                                            <div class="col-lg-12 text-center mb-5"><a href="#" class="btn3">More...</a></div>
                                    @endif

                                </div>
                            </div>

                            <div>
                                <div class="row">
                                    @if(isset($recommend_products['換季促銷']))
                                        @foreach($recommend_products['換季促銷'] as $p)
                                            <div class="col-md-4">
                                                <div class="acce-box"><a href="{{ $p->product->permalink }}"> <img
                                                            src="{{ asset($p->product->image) }}"
                                                            alt=""/>
                                                        <h3>{{ $p->product->name }}</h3>
                                                        <p>{{ $p->product->category->name }}</p>
                                                        <span>${{ $p->product->sale_price }}</span></a></div>
                                            </div>
                                        @endforeach

                                            <div class="col-lg-12 text-center mb-5"><a href="#" class="btn3">More...</a></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("frontend.global.ads")

    <section class="fguide">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 htitle"><span>Furtinure Guides</span>
                    <h2>最新拼圖情報</h2>
                    <p>You have to believe in yourself. That’s the secret of success.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 guide-slider">
                    <div id="guide-slider" class="owl-carousel">

                    @foreach($news as $new)
                        <!--News-->
                            <div class="item" data-aos="fade-up">
                                <div class="guide-box">
                                    <div class="img-box"><span><em>{{ $new->created_at->format("d") }}</em> {{ $new->created_at->format("M") }}</span>
                                        <a href="{{ route("news_details", ["slug" => $new->title]) }}"><img
                                                src="{{ asset($new->image) }}" alt=""/></a></div>
                                    <div class="gb-text">
                                        <h4>{{ $new->getTagsName() }}</h4>
                                        <h3>
                                            <a href="{{ route("news_details", ["slug" => $new->title]) }}">{{ $new->title }}</a>
                                        </h3>
                                        {{--<h6>Posted by S.Roger </h6>--}}
                                        {!! mb_substr($new->content, 0, 70, "utf-8") !!}
                                        <h5>
                                            <a href="{{ route("news_details", ["slug" => $new->title]) }}">{{ __("Continue Reading") }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <!--News-->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section("scripts")
    <script>
        jQuery(document).ready(function ($) {
            jQuery('.overlay .close').click(function () {
                jQuery('.overlay').hide()
            });

            if (1 || (sessionStorage.subscribed !== "1" && localStorage.subscribed !== "1")) {
                jQuery('.overlay').css('visibility', 'visible').css('opacity', 1);
                sessionStorage.subscribed = '1';
            }
            $("#subscribeForm").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route("subscribe") }}",
                    type: "post",
                    data: {
                        email: this.email.value,
                        _token: this._token.value
                    },
                    success: function () {
                        $("#infoModal .message").html("您已成功訂閱貓公寓電子報");
                        localStorage.subscribed = "1";
                    },
                    error: function () {
                        $("#infoModal .message").html("發生了一個錯誤。請稍後重試");
                    },
                    complete: function () {
                        $("#infoModal").modal("show");
                        jQuery('.overlay').hide()
                    }
                });

                return false;

            })
        })
    </script>
@endsection
