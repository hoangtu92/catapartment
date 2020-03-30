@extends("frontend.templates.default")


@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_search")) }}" alt=""/>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ptop bread">
                        <h5><a href="#">首頁</a> / <span>搜尋</span></h5>
                    </div>
                    <div class="plist">
                        <div class="row">
                            @foreach($results as $item)
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="acce-box ">
                                    <a href="{{ $item->type == 'product' ? url('/products/'.$item->name) : $item->type == 'news' ?  url('/news/'.$item->name) : "#"}}">

                                        @if(isset($item->thumbnail))
                                            <img src="{{ asset($item->thumbnail) }}" alt=""/>
                                        @endif


                                        <h3>{{ $item->name }}</h3>

                                        @if(isset($item->sale_price))
                                        <span><em>${{ $item->price }}</em> ${{ $item->sale_price }}</span>
                                            @endif


                                        @if( isset($item->description) )
                                            {!! $item->description !!}
                                            @endif

                                    </a>
                                </div>

                            </div>
                            @endforeach
                            @if(count($results) == 0)
                                <div class="text-center col-12">您搜尋的{{ app('request')->input("s") }}查無資料</div>
                                @endif
                            {{--<div class="col-lg-12">
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
                            </div>--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("frontend.global.ads")

@endsection
