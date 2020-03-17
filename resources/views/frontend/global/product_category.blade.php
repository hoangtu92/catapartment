<ul>
    @foreach($product_categories as $category)
        <li><a href="{{ route("product_cat", ["category_name" => $category->name]) }}"><img src="{{ asset($category->icon) }}" alt="{{ $category->name }}"/> {{ $category->name }}</a></li>
        @endforeach
</ul>
