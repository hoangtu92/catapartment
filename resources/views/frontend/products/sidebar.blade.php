<div class="col-md-3">
    <form id="product_filter" action="{{ route($route_name, isset($route_params) ? $route_params : []) }}" ng-submit="filterProduct()" method="get">

    <div class="lbox">
        <h3>用價格找拼圖</h3>
        <div class="price-range-block">
            <div id="slider-range" range-slide="" class="price-filter-range" name="rangeInput"></div>
            <div style="margin:20px auto">
                <input type="number" name="min" ng-model="filter.min" min=0 max="9900" oninput="validity.valid||(value='0');"
                       id="min_price" class="price-range-field"/>
                <input type="number" name="max" ng-model="filter.max" min=0 max="10000" oninput="validity.valid||(value='10000');"
                       id="max_price" class="price-range-field"/>
            </div>
            {{--<button class="price-range-search" id="price-range-submit"
                    style="display:block !important;">Search
            </button>--}}

        </div>
    </div>
    <div class="lbox">
        <h3>用產地找拼圖</h3>
        <ul>
            @foreach($origins as $origin)
                <li><input class="hide" id="origin-{{ $origin->id }}" type="checkbox" ng-model="filter.origins[{{ $origin->id }}]" ng-change="filterProduct()" value="{{ $origin->id }}"> <label for="origin-{{ $origin->id }}"><img src="{{ asset($origin->icon) }}" alt=""/> {{ $origin->name }} <span>{{ isset($category) ? $origin->cat_products($category->id)->count() : $origin->products()->count() }}</span></label></li>
            @endforeach


        </ul>
    </div>
    <div class="lbox">
        <h3>用片數找拼圖</h3>
        <ul>
            @foreach($pieces as $piece)
            <li><input type="checkbox" class="hide" ng-model="filter.pieces[{{ $piece->id}}]" value="{{ $piece->id }}" ng-change="filterProduct()" id="piece-{{ $piece->id }}"><label for="piece-{{ $piece->id }}">{{ $piece->name }} <span>{{ isset($category) ? $piece->cat_products($category->id)->count() : $piece->products()->count() }}</span></label></li>
            @endforeach
        </ul>
    </div>
    <div class="lbox">
        <h3>用品牌找拼圖</h3>
        <ul class="brands">
            @foreach($brands as $brand)
            <li><input type="checkbox" class="hide" ng-model="filter.brands[{{ $brand->id }}]" ng-change="filterProduct()" id="brand-{{ $brand->id }}" value="1"><label for="brand-{{ $brand->id }}"><img src="{{ asset($brand->logo) }}" alt=""/></label></li>
            @endforeach
        </ul>
    </div>

    </form>
</div>

    <script>
        @if(isset($category))
            var category_id = "{{ $category->id }}";
        @endif

        @if(isset($sort))
            var sort = "{{ $sort }}";
        @endif

        @if(isset($order))
            var order = "{{ $order }}";
        @endif

        @if(isset($orderBy))
            var orderBy = "{{ $orderBy }}";
        @endif

        @if(isset($perPage))
            var perPage = "{{ $perPage }}";
        @endif
    </script>

