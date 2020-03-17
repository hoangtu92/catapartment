@extends("frontend.templates.default")

@section("content")

    <section class="inner-banner">
        <img src="{{ asset("images/catshop-banner04.jpg") }}" alt=""/>
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
                            @foreach($news as $item)
                                <div class="col-sm-6 col-md-4">
                                    <div class="guide-box">
                                        <div class="img-box"><span><em>23</em> JUL</span><img src="{{ asset("images/guide-img01.jpg") }}"
                                                                                              alt=""/></div>
                                        <div class="gb-text">
                                            <h4>{{ $item->getTagsName() }}</h4>
                                            <h3><a href="#">{{ $item->title }}</a></h3>
                                            <h6>Posted by {{ $item->author->name }} </h6>
                                            <div>{!! mb_substr($item->content, 0, 70, "utf-8") !!}</div>
                                            <h5><a href="{{ route("news")  }}/{{ $item->title }}">Continue Reading</a></h5>
                                        </div>
                                    </div>
                                </div>
                                @endforeach



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
