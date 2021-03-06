@extends("frontend.templates.default")


@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
@endsection

@section("content")

    <section class="inner-banner">
{{--
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_wishlist")) }}" alt=""/>
--}}
    </section>


    <section class="wishlist-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    @if($shoppingCart['items'] == null)
                    <i class="fa fa-shopping-cart"></i>
                    <h2>{{ __("Cart is empty.") }}</h2>
                    {{--<p>{!! __("cart_empty_notice") !!}</p>--}}
                    <a href="#">{{ __("Return to Shop") }}</a>

                        @else
                        <div class="points-table">
                            <form action="{{ route("cart") }}" method="post">
                                @csrf


                            <table class="table cart-table full-width">
                                <colgroup>
                                    <col width="10%">
                                    <col width="30%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">{{ __("Product") }}</th>
                                        <th class="text-center">{{ __("Qty") }}</th>
                                        <th class="text-center">{{ __("Price") }}</th>
                                        <th class="text-center">{{ __("Total") }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($shoppingCart['items'] as $index => $item)

                                    <tr>
                                        <td><img src="{{ asset($item->product->image) }}"></td>
                                        <td><a href="{{route("product_detail", ["slug" => $item->product->slug])}}">{{ $item->product->name }}</a> <br>
                                            @if(!empty($item->attr))
                                                @foreach($item->attr as $key => $value)
                                                    <strong><small>{{ $key }}: {{ $value }}</small></strong><br>
                                                @endforeach
                                            @endif</td>

                                        <td>

                                            <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="minus"
                      data-field="cart_items[{{  $index }}][qty]">
                  <span>-</span>
              </button>
          </span>
                                                <input type="text" name="cart_items[{{  $index }}][qty]" class="form-control input-number" value="{{ $item->qty }}" min="0" max="100">
                                                <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="cart_items[{{  $index }}][qty]">
                  <span>+</span>
              </button>
          </span>
                                            </div>

                                            </td>


                                        @if(Auth::check())
                                            @if(Auth::user()->isVip())

                                            <td>${{ $item->product->price*0.8*0.9 }}</td>
                                            <td>${{ $item->qty*$item->product->price*0.8*0.9 }}</td>
                                            @else
                                                <td>${{ $item->product->price*0.8 }}</td>
                                                <td>${{ $item->qty*$item->product->price*0.8 }}</td>
                                            @endif
                                        @else
                                            <td>${{ $item->product->price }}</td>
                                            <td>${{ $item->qty*$item->product->price }}</td>
                                        @endif


                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                                <div class="form-group text-right flex-column align-items-center justify-content-between">
                                    <input type="hidden" name="action" value="update_cart">
                                    <a class="m-0 btn-cat" href="{{ route("products") }}">{{ __("回賣場選購") }}</a>
                                    <input class="m-0 btn-cat" type="submit" value="{{ __("Update") }}">

                                    <a class="m-0 btn-cat" href="{{ route("checkout") }}">{{ __("Go to checkout") }}</a>
                                </div>
                            </form>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection


@section("scripts")
    <!-- Price Rengebar JS Part Start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
            type="text/javascript"></script>
    <script src="{{ asset("js/cart.js") }}" type="text/javascript"></script>

@endsection
