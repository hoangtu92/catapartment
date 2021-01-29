
@include('crud::fields.inc.wrapper_start')
<div class="row">
    <div class="col-sm-6">
        <table style="width: 100%">
            <tbody>
            <tr>
                <td>
                    訂單編號<br>
                    <b>{{ $entry->order_id }}</b>
                </td>
            </tr>
            <tr>
                <td>日期<br>
                    <b>{{ $entry->created_at->format("Y, F j") }}</b>
                </td>
            </tr>
            <tr>
                <td>Email: <br><b>{{ $entry->email }}</b></td>
            </tr>
            <tr>
                <td>地址<br>
                    <b>{{ $entry->shipping_name }},
                        {{ $entry->shipping_phone }}<br>
                        {{ $entry->shipping_zipcode }}
                        {{ $entry->shipping_address }} {{ $entry->shipping_address2 }}
                        {{ $entry->state }}, {{ $entry->country }}</b>
                </td>
            </tr>
            <tr>
                <td>付款方式<br>
                    <b style="text-transform: uppercase">{{ $entry->getPaymentMethod() }}</b>
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
            @foreach($entry->items as $item)
                <tr>
                    <td>{{ $item->product->name }}<b>x{{ $item->qty }}</b></td>
                    <td>NT{{ $item->price*$item->qty }}</td>
                </tr>
            @endforeach
            <tr>
                <td>運費</td>
                <td>NT{{ $entry->shipping_fee }}</td>
            </tr>
            <tr>
                <td>紅利折抵</td>
                <td>NT{{ $entry->discount }}</td>
            </tr>
            <tr>
                <td>總金額
                </td>
                <td><b>NT{{ $entry->total_amount }}</b></td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
@include('crud::fields.inc.wrapper_end')
