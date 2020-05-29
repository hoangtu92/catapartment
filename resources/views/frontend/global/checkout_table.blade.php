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
                <td>{{ $item->product->name }}</td>
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
            <td colspan="2"><strong>-${{ Session::get("discount") }}</strong></td>
        </tr>
    @endif
    @if(Session::get("member_discount") > 0)
        <tr>
            <td>
                <b>{{ __("Member Discount") }}</b>
            </td>
            <td colspan="2"><strong>-${{ (Session::get("member_discount")*$cart_total_amount)/100 }}</strong></td>
        </tr>
    @endif

    <tr>
        <td>{{ __("Shipping") }}</td>
        <td colspan="2">
            <label class="rd-btn">{{ __("Flat rate") }} : <strong>${{ Setting::get("shipping_fee") }}</strong>
                <input name="delivery" onclick="document.getElementById('updateOrder').click()" type="radio" @if(Session::get('delivery') == 'flat_rate') checked @endif value="flat_rate">
                <span class="checkmark"></span>
            </label>
            <label class="rd-btn">{{ __("Free Shipping") }} :
                <input type="radio" name="delivery" onclick="document.getElementById('updateOrder').click()" @if(Session::get('delivery') == 'free_shipping') checked @endif value="free_shipping">
                <span class="checkmark"></span>
            </label>
            <label class="rd-btn">{{ __("Local Pickup") }} : <strong></strong>
                <input type="radio" name="delivery" onclick="document.getElementById('updateOrder').click()" @if(Session::get('delivery') == 'pickup') checked @endif value="pickup">
                <span class="checkmark"></span>
            </label>
            <input type="submit" name="action" value="update_order" style="display: none" id="updateOrder">
        </td>
    </tr>
    <tr>
        <td><b>{{ __("Total") }}</b></td>

        <td colspan="2"><strong>${{ $cart_total_amount + Session::get("shipping_fee") - Session::get("discount") - (Session::get("member_discount")*$cart_total_amount)/100 }}</strong></td>
    </tr>
    </tbody>
</table>
