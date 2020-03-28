<div class="header-middle hide-mob">
    <div class="container">
        <div class="logo"><a href="{{ route("home") }}"><img src="{{ asset("images/logo.jpg") }}" alt=""/></a></div>
        <div class="search-box">
            <form method="get" action="{{ route("search") }}">
                <input type="text" name="s" value="{{ old("s") }}" placeholder="{{ __("Search for products") }}">
                <select name="cat">
                    <option value="">{{ __("Select Category") }}</option>
                    @foreach($product_categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit"><img src="{{ asset("images/search-icon.jpg") }}" alt=""/></button>
            </form>
        </div>
        <div class="header-right">

            @auth
                <a href="{{ route("account") }}">{{ __("My Account") }} <img src="{{ asset("images/icon01.jpg") }}" alt=""/></a>
            @else
                <a href="#" onclick="openNav()">{{ __("Login/Register") }}</a>

            @endauth

            <a href="{{ route("wishlist") }}"><img src="{{ asset("images/icon02.jpg") }}" alt=""/></a>
            <a href="#" class="hcart"><img src="{{ asset("images/icon03.jpg") }}" alt=""/><em>0</em> $0.00</a>
        </div>
    </div>
</div>
