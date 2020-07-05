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

                    @if(count($wishlist['items']) > 0)
                        <table class="table cart-table full-width text-center">
                            <colgroup>
                                <col width="10%">
                                <col width="30%">
                                <col width="40%">
                                <col width="10%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">{{ __("Product") }}</th>
                                <th class="text-center">商品說明</th>
                                <th class="text-center">{{ __("Price") }}</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($wishlist['items'] as $index => $product)
                                <tr>
                                    <td class="align-middle text-center"><a href="{{ route("product_detail", [$product->slug]) }}"><img src="{{ asset($product->image) }}"></a> </td>
                                    <td class="align-middle text-center">{{ $product->name }}</td>
                                    <td class="align-middle text-center">{{ $product->short_description  }}</td>
                                    <td class="align-middle text-center">${{ $product->sale_price }}</td>
                                    <td class="align-middle text-center">
                                        <form action="{{ route("wishlist") }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="action" value="remove_wishlist">
                                            <input type="submit" class="btn-cat" value="移除">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        @else
                        <h2>{{ __("Wishlist is empty.") }}</h2>
                        <p>{!! __("wishlist_empty_notice") !!}</p>
                        @endif
                    <a href="{{ route("products") }}" class="btn-cat">{{ __("Return to Shop") }}</a>
                </div>
            </div>
        </div>
    </section>

@endsection

