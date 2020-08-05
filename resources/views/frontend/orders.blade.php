@extends("frontend.templates.default")

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_account")) }}" alt=""/>
    </section>

    <section class="dashboard-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include("frontend.account.account_navigation")
                    <div class="dash-right">
                        <div class="points-table">
                            <table class="table full-width">
                                <thead>
                                <tr>
                                    <th>{{ __("No.") }}</th>
                                    <th>{{ __("Order ID") }}</th>
                                    <th>{{ __("Order Date") }}</th>
                                    <th>{{ __("Order Amount") }}</th>
                                    <th>{{ __("Order Info") }}</th>
                                    <th>{{ __("Order Status") }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach(App\Models\User::find(Auth::id())->orders as $index =>  $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->created_at->format("Y/m/d") }}</td>
                                    <td>NT$ {{ $order->total_amount }}</td>
                                    <td style="white-space: pre-line">{{ $order->shipping_name }},
                                        {{ $order->shipping_phone }}
                                        {{ $order->shipping_zipcode }}
                                        {{ $order->shipping_address }} {{ $order->shipping_address2 }}
                                        {{ $order->state }}, {{ $order->country }}
                                    </td>
                                    <td>{{ $order->getOrderStatus() }}</td>
                                    <td><a href="{{ route("order_detail", [$order->order_id]) }}">訂單詳情</a> </td>
                                </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
