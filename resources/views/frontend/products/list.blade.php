<div class="plist">
    <div class="row">
        @foreach($products as $product)
            <div class="col-sm-6 col-md-4">
                <div class="acce-box">
                    <a href="{{ $product->permalink }}">

                        @if($product->is_hot)
                            <span class="offer-hot">HOT</span>
                        @endif

                        @if($product->sale_price >=0 && $product->sale_price < $product->price)
                            <span class="offer-green">{{ round(( ($product->sale_price - $product->price)/$product->price)*100) }}%
                                </span>
                        @endif


                        <img src="{{ asset($product->image) }}" alt=""/>
                        <h3>{{ $product->name }}</h3>
                        {{--<p>Accessories, Clocks</p>--}}
                        <span><em>${{ $product->price }}</em> ${{ $product->sale_price }}</span></a></div>
            </div>
        @endforeach


        @include("frontend.global.pagination")


    </div>

</div>
