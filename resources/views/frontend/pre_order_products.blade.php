@extends("frontend.templates.default")


@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_pre_order_product")) }}" alt=""/>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ptop bread">
                        <h5><a href="#">首頁</a> / <span>海外預購</span></h5>
                    </div>
                    @include("frontend.products.list")
                </div>
            </div>
        </div>
    </section>

    @include("frontend.global.ads")

@endsection
