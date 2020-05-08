@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
@endsection

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_product")) }}" alt=""/>
    </section>

    <section class="order-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset("images/wishlist-icon.jpg") }}" alt=""/>
                        <h2>Are you happy with the product?</h2>
                    </div>


                    <form action="{{ route("order_detail", [$order->order_id]) }}" method="post">

                        @csrf

                        <table class="table order-detail-table">
                            <colgroup>
                                <col width="50%">
                                <col width="50%">
                            </colgroup>
                            <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <th>
                                        <div class="row">
                                            <div class="col-4">
                                                <a href="{{ $item->product->permalink }}">
                                                    <img width="100px" src="{{ asset($item->product->image) }}"
                                                         alt="{{ $item->product->name }}">
                                                </a>
                                            </div>
                                            <div class="col-8">
                                                <span>{{ $item->product->name }}</span>
                                                <p>{{ $item->product->short_description }}</p>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="form-group">

                                            <div class="rating">
                                                <label ng-class="{ checked: order.rating[{{ $item->id}}] == 5}" @if($item->rating == 5) class="checked" @endif><input ng-model="order.rating[{{ $item->id}}]" type="radio" name="item[{{ $item->id}}][rating]" value="5"> ☆</label>
                                                <label ng-class="{ checked: order.rating[{{ $item->id}}] == 4}" @if($item->rating == 4) class="checked" @endif><input ng-model="order.rating[{{ $item->id}}]" type="radio" name="item[{{ $item->id}}][rating]" value="4"> ☆</label>
                                                <label ng-class="{ checked: order.rating[{{ $item->id}}] == 3}" @if($item->rating == 3) class="checked" @endif><input ng-model="order.rating[{{ $item->id}}]" type="radio" name="item[{{ $item->id}}][rating]" value="3"> ☆</label>
                                                <label ng-class="{ checked: order.rating[{{ $item->id}}] == 2}" @if($item->rating == 2) class="checked" @endif><input ng-model="order.rating[{{ $item->id}}]" type="radio" name="item[{{ $item->id}}][rating]" value="2"> ☆</label>
                                                <label ng-class="{ checked: order.rating[{{ $item->id}}] == 1}" @if($item->rating == 1) class="checked" @endif><input ng-model="order.rating[{{ $item->id}}]" type="radio" name="item[{{ $item->id}}][rating]" value="1"> ☆</label>
                                            </div>

                                            <textarea rows="5" class="form-control"
                                                      name="item[{{ $item->id }}][review]">{{ $item->review }}</textarea>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="form-group text-right"><input type="submit" class="btn-cat" value="Leave review"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section("scripts")
    <!-- Price Rengebar JS Part Start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
            type="text/javascript"></script>
    <script src="{{ asset("js/price_range_script.js") }}" type="text/javascript"></script>

@endsection
