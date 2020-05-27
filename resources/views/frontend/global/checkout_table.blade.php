<table class="table full-width">
    <colgroup>
        <col width="40%">
        <col width="60%">
    </colgroup>
    <thead>
    <tr>
        <th>{{ __("Product") }}</th>
        <th>{{ __("Total") }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($cart_items as $index => $item)
        <tr>

            @if(isset($item->product))
                <td>
                    {{--<span ng-init="order.items['{{ $index }}'].product_id = '{{ $item->product_id }}'"></span>
                    <span ng-init="order.items['{{ $index }}'].qty = '{{ $item->qty }}'"></span>
                    <span ng-init="order.items['{{ $index }}'].color = '{{ $item->color }}'"></span>--}}

                    {{ $item->product->name }}

                </td>


            @else
                <td>{{ $item->customized_product->frame->name }}</td>
            @endif

            <td>
                <div>
                    @if(!empty($item->attr))
                        @foreach($item->attr as $key => $value)
                            <strong><small>{{ ATTRIBUTES[$key] }}: {{ $value }}</small></strong><br>
                        @endforeach
                    @endif


(x{{ $item->qty }})</div>
            </td>

            @if(isset($item->product))

                <td>${{ $item->product->sale_price*$item->qty }}</td>
            @else
                <td>${{ $item->customized_product->price*$item->qty }}</td>
            @endif

        </tr>
    @endforeach
    <tr>
        <td><b>{{ __("Sub Total") }}</b></td>
        <td colspan="2"><strong>${{ $cart_total_amount }}</strong></td>
    </tr>
    @if(Session::get("discount") > 0)
        <tr>
            <td>
                <b>{{ __("Discount") }}</b>
            </td>
            <td colspan="2"><strong>${{ Session::get("discount") }}</strong></td>
        </tr>
    @endif
    <tr>
        <td>{{ __("Shipping") }}</td>
        <td colspan="2">
            {{--<label class="rd-btn">{{ __("Flat rate") }} : <strong>$20.00</strong>
                <input name="shipping_method" ng-model="order.shipping_method" type="radio" value="flat_rate" checked="checked">
                <span class="checkmark"></span>
            </label>
            <label class="rd-btn">{{ __("Free Shipping") }}
                <input type="radio" name="shipping_method" ng-model="order.shipping_method" value="free_shipping">
                <span class="checkmark"></span>
            </label>--}}
            <label class="rd-btn" style="padding-right:0">{{ __("Local Pickup") }} : <strong>${{ Setting::get("shipping_fee") }}</strong>
                <input type="radio" name="delivery" ng-model="order.delivery" checked value="pickup">
                <span class="checkmark"></span>
            </label></td>
    </tr>
    <tr>
        <td><b>{{ __("Total") }}</b></td>
        <td colspan="2"><strong>${{ $cart_total_amount + Setting::get("shipping_fee") - Session::get("discount") }}</strong></td>
    </tr>
    </tbody>
</table>
