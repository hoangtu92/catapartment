@extends("frontend.templates.default")

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_wishlist")) }}" alt=""/>
    </section>

    <section class="wishlist-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="{{ asset("images/wishlist-icon.jpg") }}" alt=""/>
                    <h2>{{ __("Wishlist is empty.") }}</h2>
                    <p>{!! __("wishlist_empty_notice") !!}</p>
                    <a href="#">{{ __("Return to Shop") }}</a>
                </div>
            </div>
        </div>
    </section>

@endsection

