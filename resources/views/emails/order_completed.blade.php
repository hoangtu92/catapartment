<p>Hello {{ $user->name }}</p>
<p>Thank you for shopping with us, here is your order detail</p>

<table style="width: 100%; text-align: left">
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
                <td><img src="{{ asset($item->product->image) }}"></td>
                <td>{{ $item->product->name }} @if($item->color != null) <strong><small>({{ $item->color }})</small></strong> @endif</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->product->sale_price }}</td>
                <td>{{ $item->qty*$item->product->sale_price }}</td>
            </tr>
        @endforeach

        <tr>
            <th>{{ __("Sub Total") }}</th>
            <td colspan="4">
                {{ $order->sub_total }}
            </td>
        </tr>

        <tr>
            <th>{{ __("Shipping Fee") }}</th>
            <td colspan="4">
                {{ $order->shipping_fee }}
            </td>
        </tr>

        <tr>
            <th>{{ __("Discount") }}</th>
            <td colspan="4">
                {{ $order->discount + $order->member_discount }}
            </td>
        </tr>

        <tr>
            <th>{{ __("Total") }}</th>
            <td colspan="4">
                {{ $order->total_amount }}
            </td>
        </tr>
        </tbody>
</table>
