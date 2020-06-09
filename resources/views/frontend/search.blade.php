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
                                    <a data-type="{{ $item->type }}" href="{{ $item->type != 'faq' ? route($item->type,["slug" => $item->slug])  : "#"}}">

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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("frontend.global.ads")

@endsection
