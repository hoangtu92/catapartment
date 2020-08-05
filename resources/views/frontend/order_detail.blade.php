@extends("frontend.templates.default")

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_account")) }}" alt=""/>
    </section>

    <section class="order-page mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">

                        <h2>請留下您的評價</h2>
                    </div>


                    <form action="{{ route("order_detail", [$order->order_id]) }}" method="post" class="mb-5">

                        @csrf

                        <table class="table order-detail-table">
                            <colgroup>
                                <col width="50%">
                                <col width="50%">
                            </colgroup>
                            <tbody>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <table style="width: 100%">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        訂單編號<br>
                                                        <b>{{ $order->order_id }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>日期<br>
                                                        <b>{{ $order->created_at->format("Y, F j") }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Email: <br><b>{{ $order->email }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>地址<br>
                                                        <b>{{ $order->shipping_name }},
                                                            {{ $order->shipping_phone }}
                                                            {{ $order->shipping_zipcode }}
                                                            {{ $order->shipping_address }} {{ $order->shipping_address2 }}
                                                            {{ $order->state }}, {{ $order->country }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>付款方式<br>
                                                        <b style="text-transform: uppercase">{{--{{ $order->payment_method }} --}}{{ $order->payment_type }}</b>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-6">
                                            <table style="width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th><b>品項</b></th>
                                                    <th><b>金額</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($order->items as $item)
                                                    <tr>
                                                        <td>{{ $item->product->name }}<b>x{{ $item->qty }}</b></td>
                                                        <td>NT{{ $item->price*$item->qty }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>運費</td>
                                                    <td>NT{{ $order->shipping_fee }}</td>
                                                </tr>
                                                <tr>
                                                    <td>紅利折抵</td>
                                                    <td>NT{{ $order->discount }}</td>
                                                </tr>
                                                <tr>
                                                    <td>總金額
                                                    </td>
                                                    <td><b>NT{{ $order->total_amount }}</b></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </td>
                            </tr>
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
                                                <p>{!! $item->product->short_description !!}</p>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="form-group">
                                            @if($item->review != null || $item->rating > 0)
                                                <div class="rating">
                                                    <label ng-class="{ checked: order.rating[{{ $item->id}}] == 5}"
                                                           @if($item->rating == 5) class="checked" @endif><input readonly
                                                            ng-model="order.rating[{{ $item->id}}]" type="radio"
                                                            value="5"> ☆</label>
                                                    <label ng-class="{ checked: order.rating[{{ $item->id}}] == 4}"
                                                           @if($item->rating == 4) class="checked" @endif><input readonly
                                                            ng-model="order.rating[{{ $item->id}}]" type="radio"
                                                            value="4"> ☆</label>
                                                    <label ng-class="{ checked: order.rating[{{ $item->id}}] == 3}"
                                                           @if($item->rating == 3) class="checked" @endif><input readonly
                                                            ng-model="order.rating[{{ $item->id}}]" type="radio"
                                                            value="3"> ☆</label>
                                                    <label ng-class="{ checked: order.rating[{{ $item->id}}] == 2}"
                                                           @if($item->rating == 2) class="checked" @endif><input readonly
                                                            ng-model="order.rating[{{ $item->id}}]" type="radio"
                                                             value="2"> ☆</label>
                                                    <label ng-class="{ checked: order.rating[{{ $item->id}}] == 1}"
                                                           @if($item->rating == 1) class="checked" @endif><input readonly
                                                            ng-model="order.rating[{{ $item->id}}]" type="radio"
                                                            value="1"> ☆</label>
                                                </div>

                                                <textarea rows="5" class="form-control"
                                                          readonly>{{ $item->review }}</textarea>
                                                @else
                                            <div class="rating">
                                                <label ng-class="{ checked: order.rating[{{ $item->id}}] == 5}"
                                                       @if($item->rating == 5) class="checked" @endif><input
                                                        ng-model="order.rating[{{ $item->id}}]" type="radio"
                                                        name="item[{{ $item->id}}][rating]" value="5"> ☆</label>
                                                <label ng-class="{ checked: order.rating[{{ $item->id}}] == 4}"
                                                       @if($item->rating == 4) class="checked" @endif><input
                                                        ng-model="order.rating[{{ $item->id}}]" type="radio"
                                                        name="item[{{ $item->id}}][rating]" value="4"> ☆</label>
                                                <label ng-class="{ checked: order.rating[{{ $item->id}}] == 3}"
                                                       @if($item->rating == 3) class="checked" @endif><input
                                                        ng-model="order.rating[{{ $item->id}}]" type="radio"
                                                        name="item[{{ $item->id}}][rating]" value="3"> ☆</label>
                                                <label ng-class="{ checked: order.rating[{{ $item->id}}] == 2}"
                                                       @if($item->rating == 2) class="checked" @endif><input
                                                        ng-model="order.rating[{{ $item->id}}]" type="radio"
                                                        name="item[{{ $item->id}}][rating]" value="2"> ☆</label>
                                                <label ng-class="{ checked: order.rating[{{ $item->id}}] == 1}"
                                                       @if($item->rating == 1) class="checked" @endif><input
                                                        ng-model="order.rating[{{ $item->id}}]" type="radio"
                                                        name="item[{{ $item->id}}][rating]" value="1"> ☆</label>
                                            </div>


                                            <textarea rows="5" class="form-control"
                                                      name="item[{{ $item->id }}][review]">{{ $item->review }}</textarea>
                                                @endif
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if($item->review == null && !$item->rating)
                        <div class="form-group text-right"><input type="submit" class="btn-cat" value="送出評價"></div>
                            @endif
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
