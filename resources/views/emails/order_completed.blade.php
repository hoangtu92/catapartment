<p>Hello {{ $order->billing_name }}</p>
<p>感謝您的購買，以下是訂單資訊</p>

<table style="width: 100%; text-align: left; border-collapse: collapse;" border="1">
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
        @foreach($order->items as $index => $item)
            <tr>
                <td><img width="64" src="{{ asset($item->product_image) }}"></td>
                <td>{{ $item->product_name }}

                        <div>
                            @if(!empty($item->attr))
                                @foreach($item->attr as $key => $value)
                                    <strong><small>{{ ATTRIBUTES[$key] }}: {{ $value }}</small></strong><br>
                                @endforeach
                            @endif
                        </div>

                </td>
                <td>{{ $item->qty }}</td>
                <td>${{ $item->price }}</td>
                <td>${{ $item->qty*$item->price }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="3" rowspan="4"></td>
            <th>{{ __("Sub Total") }}</th>
            <td>
                ${{ $order->sub_total }}
            </td>
        </tr>

        <tr>
            <th>{{ __("Shipping Fee") }}</th>
            <td>
                ${{ $order->shipping_fee }}
            </td>
        </tr>

        <tr>
            <th>{{ __("Discount") }}</th>
            <td>
                ${{ $order->discount + $order->member_discount }}
            </td>
        </tr>

        <tr>
            <th>{{ __("Total") }}</th>
            <td>
                <b>${{ $order->total_amount }}</b>
            </td>
        </tr>
        </tbody>
</table>
