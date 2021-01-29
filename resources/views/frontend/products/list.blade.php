<div class="plist">
    <div class="d-grid grid-3">
        @foreach($products as $product)
            <div>
                <div class="acce-box">
                    <a href="{{ $product->permalink }}">

                        @if($product->is_hot)
                            <span class="offer-hot">HOT</span>
                        @endif

                        @if($product->sale_price >=0 && $product->sale_price < $product->price)
                            <span class="offer-green">{{ round(( ($product->sale_price - $product->price)/$product->price)*100) }}%
                                </span>
                        @endif


                        <div class="image"><img onerror="this.src='/images/no-img.jpg'" src="{{ asset($product->image) }}" alt=""/></div>
                        <h3>{{ $product->name }}</h3>
                        {{--<p>Accessories, Clocks</p>--}}
                        <span><em>${{ $product->price }}</em> ${{ $product->sale_price }}</span></a></div>
            </div>
        @endforeach
    </div>
    @include("frontend.global.pagination")

</div>
