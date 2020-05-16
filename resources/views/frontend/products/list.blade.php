<div class="plist">
    <div class="row">
        @foreach($products as $product)
            <div class="col-sm-6 col-md-4">
                <div class="acce-box">
                    <a href="{{ $product->permalink }}">

                        <span class="offer-green">-20%</span>

                        <span class="offer-hot">HOT</span>


                        <img src="{{ asset($product->image) }}" alt=""/>
                        <h3>{{ $product->name }}</h3>
                        {{--<p>Accessories, Clocks</p>--}}
                        <span><em>${{ $product->price }}</em> ${{ $product->sale_price }}</span></a></div>
            </div>
        @endforeach


        @include("frontend.global.pagination")


    </div>

</div>
