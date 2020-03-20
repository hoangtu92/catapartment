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
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img01.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img02.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span><em>$499.00</em> $399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img03.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img04.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img05.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img06.jpg") }}"
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
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img04.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img05.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img06.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img01.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img02.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span><em>$499.00</em> $399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img03.jpg") }}"
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
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img01.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img02.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span><em>$499.00</em> $399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img03.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img04.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img05.jpg") }}"
                                                                            alt=""/>
                                            <h3>Accessories Name</h3>
                                            <p>Accessories</p>
                                            <span>$399.00</span></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="acce-box"><a href="#"> <img src="{{ asset("images/acce-img06.jpg") }}"
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
                    <div class="item" data-aos="fade-up">
                        <div class="guide-box">
                            <div class="img-box"><span><em>23</em> JUL</span><img
                                    src="{{ asset("images/guide-img01.jpg") }}" alt=""/></div>
                            <div class="gb-text">
                                <h4>Design Trends, Furniture</h4>
                                <h3><a href="#">Seating Collections Inspiration</a></h3>
                                <h6>Posted by S.Roger </h6>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum is simply dummy text.</p>
                                <h5><a href="#">Continue Reading</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="guide-box">
                            <div class="img-box"><span><em>23</em> JUL</span><img
                                    src="{{ asset("images/guide-img02.jpg") }}" alt=""/></div>
                            <div class="gb-text">
                                <h4>Design Trends, Furniture</h4>
                                <h3><a href="#">Seating Collections Inspiration</a></h3>
                                <h6>Posted by S.Roger </h6>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum is simply dummy text.</p>
                                <h5><a href="#">Continue Reading</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="guide-box">
                            <div class="img-box"><span><em>23</em> JUL</span><img
                                    src="{{ asset("images/guide-img03.jpg") }}" alt=""/></div>
                            <div class="gb-text">
                                <h4>Design Trends, Furniture</h4>
                                <h3><a href="#">Seating Collections Inspiration</a></h3>
                                <h6>Posted by S.Roger </h6>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum is simply dummy text.</p>
                                <h5><a href="#">Continue Reading</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="guide-box">
                            <div class="img-box"><span><em>23</em> JUL</span><img
                                    src="{{ asset("images/guide-img01.jpg") }}" alt=""/></div>
                            <div class="gb-text">
                                <h4>Design Trends, Furniture</h4>
                                <h3><a href="#">Seating Collections Inspiration</a></h3>
                                <h6>Posted by S.Roger </h6>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum is simply dummy text.</p>
                                <h5><a href="#">Continue Reading</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="guide-box">
                            <div class="img-box"><span><em>23</em> JUL</span><img
                                    src="{{ asset("images/guide-img02.jpg") }}" alt=""/></div>
                            <div class="gb-text">
                                <h4>Design Trends, Furniture</h4>
                                <h3><a href="#">Seating Collections Inspiration</a></h3>
                                <h6>Posted by S.Roger </h6>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum is simply dummy text.</p>
                                <h5><a href="#">Continue Reading</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <div class="guide-box">
                            <div class="img-box"><span><em>23</em> JUL</span><img
                                    src="{{ asset("images/guide-img03.jpg") }}" alt=""/></div>
                            <div class="gb-text">
                                <h4>Design Trends, Furniture</h4>
                                <h3><a href="#">Seating Collections Inspiration</a></h3>
                                <h6>Posted by S.Roger </h6>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum is simply dummy text.</p>
                                <h5><a href="#">Continue Reading</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
