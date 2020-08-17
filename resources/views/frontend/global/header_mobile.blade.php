<div class="mob-header">
    <div class="container-fluid">
        <div class="mob-logo"><a href="{{ route("home") }}"><img src="{{ asset("images/logo.jpg") }}" alt=""/></a></div>
        <div class="header-right"><a href="#" class="msearch"><img src="{{ asset("images/search-icon1.jpg") }}"
                                                                   alt=""/></a>

            <a href="{{ route("login") }}"><img src="{{ asset("images/user-icon.jpg") }}" alt=""/></a> <a href="#"><img
                    src="{{ asset("images/icon01.jpg") }}" alt=""/></a> <a href="#"><img
                    src="{{ asset("images/icon02.jpg") }}" alt=""/></a> <a href="#" class="hcart"><img
                    src="{{ asset("images/icon03.jpg") }}" alt=""/><em>{{$shoppingCart['count']}}</em>
                <p>${{$shoppingCart['total']}}</p></a>
            <div class="mob-search">
                <div class="search-box">
                    <form method="get" action="{{ route("home") }}">
                        <input type="text" placeholder="搜尋">
                        <select name="cat">
                            <option>{{ __("Select Category") }}</option>
                            @foreach($product_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit"><img src="{{ asset("images/search-icon.jpg") }}" alt=""/></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
