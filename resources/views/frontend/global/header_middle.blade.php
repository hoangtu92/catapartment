<div class="header-middle hide-mob">
    <div class="container">
        <div class="logo"><a href="{{ route("home") }}"><img src="{{ asset( Setting::get("site_logo")) }}" alt="{{ env("APP_NAME") }}"/></a></div>
        <div class="search-box">
            <form method="get" action="{{ route("search") }}">
                <input type="text" name="s" value="{{ old("s") }}" placeholder="{{ __("Search for products") }}">
                <select name="cat">
                    <option value="">{{ __("Select Category") }}</option>
                    @foreach($product_categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit"><img src="{{ asset("images/search-icon.jpg") }}" alt="{{ __("Search") }}"/></button>
            </form>
        </div>
        <div class="header-right">

            @auth
                <a href="{{ route("account") }}">{{ Auth()->user()->name }}</a>
                <a href="{{ route("points") }}"><img src="{{ asset("images/icon01.jpg") }}" alt="{{ __("Points") }}"/></a>
                <a href="{{ route("wishlist") }}"><img src="{{ asset("images/icon02.jpg") }}" alt="{{ __("Wishlist") }}"/></a>
            @else
                <a href="#" onclick="openNav()">{{ __("Login/Register") }}</a>
                <a href="#" onclick="openNav()"><img src="{{ asset("images/icon01.jpg") }}" alt="{{ __("Points") }}"/></a>
                <a href="#" onclick="openNav()"><img src="{{ asset("images/icon02.jpg") }}" alt="{{ __("Wishlist") }}"/></a>
            @endauth

            <a href="{{ route("cart") }}" class="hcart"><img src="{{ asset("images/icon03.jpg") }}" alt="{{ __("Cart") }}"/><em>{{ $cart_item_count }}</em> ${{ $cart_total_amount }}</a>
        </div>
    </div>
</div>
