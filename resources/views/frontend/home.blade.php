@extends("frontend.templates.default")
@section("content")
    <section class="home-banner">
        <div class="container">
            <div class="home-slider">
                <div class="hcat-list t-0">
                    @include("frontend.global.product_category")
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
                <div class="col-lg-6 mb-4 cb"><a href="#">
                        <h3>可愛動物系列</h3>
                        <img src="{{ asset("images/hcollection-img01.jpg") }}" alt=""/></a></div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-4 cb"><a href="#">
                                <h4>可愛動物系列</h4>
                                <img src="{{ asset("images/hcollection-img02.jpg") }}" alt=""/></a></div>
                        <div class="col-lg-6 col-md-6 mb-4 cb"><a href="#">
                                <h4>可愛動物系列</h4>
                                <img src="{{ asset("images/hcollection-img03.jpg") }}" alt=""/></a></div>
                        <div class="col-lg-6 col-md-6 mb-4 cb"><a href="#">
                                <h4>可愛動物系列</h4>
                                <img src="{{ asset("images/hcollection-img04.jpg") }}" alt=""/></a></div>
                        <div class="col-lg-6 col-md-6 mb-4 cb"><a href="#">
                                <h4>可愛動物系列</h4>
                                <img src="{{ asset("images/hcollection-img05.jpg") }}" alt=""/></a></div>
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
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img01.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img02.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span><em>$499.00</em> $399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img03.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img04.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img05.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img06.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-lg-12 text-center mb-5"><a href="#" class="btn3">More...</a></div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img04.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img05.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img06.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img01.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img02.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span><em>$499.00</em> $399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img03.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img01.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img02.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span><em>$499.00</em> $399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img03.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img04.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img05.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="acce-box"><a href="#"> <img
                                                    src="{{ asset("images/acce-img06.jpg") }}"
                                                    alt=""/>
                                                <h3>Accessories Name</h3>
                                                <p>Accessories</p>
                                                <span>$399.00</span></a></div>
                                    </div>
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
                                        <h3><a href="{{ route("news_details", ["slug" => $new->title]) }}">{{ $new->title }}</a></h3>
                                        {{--<h6>Posted by S.Roger </h6>--}}
                                        {!! mb_substr($new->content, 0, 70, "utf-8") !!}
                                        <h5><a href="{{ route("news_details", ["slug" => $new->title]) }}">{{ __("Continue Reading") }}</a></h5>
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
        jQuery(document).ready(function($){
            jQuery('.overlay .close').click(function(){
                jQuery('.overlay').hide()
            });

            if(1 || (sessionStorage.subscribed !== "1" && localStorage.subscribed !== "1")){
                jQuery('.overlay').css('visibility','visible').css('opacity',1);
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
                    error: function(){
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
