@extends("frontend.templates.default")

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(Setting::get("banner_news")) }}" alt=""/>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ptop bread">
                        <h5><a href="#">首頁</a> / <span>拼圖情報</span></h5>
                    </div>

                    <div class="plist">
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-xs-12 col-md-5 d-none d-md-block" style="position: absolute;
    right: 0;
    top: 0;">
                                <!--top filter-->
                            @include("frontend.products.top_filter")
                            <!--top filter-->
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">

                            @foreach($news as $item)
                                <div class="col-sm-6 col-md-4">
                                    <div class="guide-box">
                                        <div class="img-box"><span><em>{{ $item->created_at->format("d") }}</em> {{ $item->created_at->format("M") }}</span>

                                            <a href="{{ route("news_details", ["slug" => $item->title]) }}">
                                                <img src="{{ asset("images/guide-img01.jpg") }}" alt=""/></a></div>
                                        <div class="gb-text">
                                            <h4>{{ $item->getTagsName() }}</h4>
                                            <h3><a href="{{ route("news_details", ["slug" => $item->title]) }}">{{ $item->title }}</a></h3>
                                            {{--<h6>Posted by {{ $item->author->name }} </h6>--}}
                                            <div>{!! mb_substr($item->content, 0, 70, "utf-8") !!}</div>
                                            <h5><a href="{{ route("news_details", ["slug" => $item->title]) }}">{{ __("Continue Reading") }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                                @endforeach


                            @include("frontend.global.pagination")




                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("frontend.global.ads")
@endsection
