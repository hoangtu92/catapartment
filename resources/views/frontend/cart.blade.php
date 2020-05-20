@extends("frontend.templates.default")


@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/thumbnail-slider.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/ninja-slider.css") }}"/>
@endsection

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_wishlist")) }}" alt=""/>
    </section>

    <section class="wishlist-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    @if($cart_items == null)
                    <i class="fa fa-shopping-cart"></i>
                    <h2>{{ __("Cart is empty.") }}</h2>
                    <p>{!! __("cart_empty_notice") !!}</p>
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
                                        <th>{{ __("Product") }}</th>
                                        <th>{{ __("Qty") }}</th>
                                        <th>{{ __("Price") }}</th>
                                        <th>{{ __("Total") }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cart_items as $index => $item)
                                    <tr>
                                        <td><img src="{{ asset($item->product->image) }}"></td>
                                        <td>{{ $item->product->name }} @if($item->color != null) <strong><small>({{ $item->color }})</small></strong> @endif</td>
                                        <td>

                                            <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="minus"
                      data-field="cart_items[p_{{  $item->product_id.$item->color }}][qty]">
                  <span>-</span>
              </button>
          </span>
                                                <input type="text" name="cart_items[p_{{  $item->product_id.$item->color }}][qty]" class="form-control input-number" value="{{ $item->qty }}" min="0" max="100">
                                                <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="cart_items[p_{{  $item->product_id.$item->color }}][qty]">
                  <span>+</span>
              </button>
          </span>
                                            </div>

                                            </td>
                                        <td>{{ $item->product->sale_price }}</td>
                                        <td>{{ $item->qty*$item->product->sale_price }}</td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                                <div class="form-group text-right flex-column align-items-center justify-content-between">
                                    <input type="hidden" name="action" value="update_cart">
                                    <input class="m-0 btn-cat" type="submit" value="{{ __("Update") }}">
                                    <a class="m-0" href="{{ route("checkout") }}">{{ __("Go to checkout") }}</a>
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
    <script src="{{ asset("js/ninja-slider.js") }}"></script>
    <script src="{{ asset("js/thumbnail-slider.js") }}"></script>
    <script src="{{ asset("js/price_range_script.js") }}" type="text/javascript"></script>
    <script src="{{ asset("js/cart.js") }}" type="text/javascript"></script>

@endsection
