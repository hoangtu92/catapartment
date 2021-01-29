<!doctype html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body>
<form action="{{ $url }}" method="POST" id="form">
    {{--商家代號--}}<input type="hidden" name="seller_id" value="{{$seller_id}}">
    {{--交易編號--}}<input type="hidden" name="pno" value="{{$pno}}">
    {{--交易金額--}}<input type="hidden" name="ntd" value="{{$ntd}}">
    {{--交易時間--}}<input type="hidden" name="ttime" value="{{$ttime}}">
    {{--驗證參數--}}<input type="hidden" name="validate_method" value="{{$validate_method}}">
    {{--項目總數--}}<input type="hidden" name="count" value="{{$count}}">

    @foreach($order->items as $index => $item)
    {{--商品編號--}}<input type="hidden" name="pid{{$index}}" value="{{$item->product_id}}">
    {{--商品數量--}}<input type="hidden" name="qty{{$index}}" value="{{$item->qty}}">
    @endforeach

    {{--導回網頁--}}<input type="hidden" name="return_url" value="{{$return_url}}">
    {{--收件人--}}<input type="hidden" name="receiver" value="{{$receiver}}">
    {{--收件人--}}<input type="hidden" name="ship_addr" value="{{$ship_addr}}">
    {{--收件人--}}<input type="hidden" name="area_code" value="{{$area_code}}">
    {{--收件人--}}<input type="hidden" name="tel" value="{{$tel}}">
    {{--收件人--}}<input type="hidden" name="email" value="{{$email}}">
    {{--商品描述--}}<input type="hidden" name="pname" value="{{$pname}}">
    {{--Hash驗證碼1--}}<input type="hidden" name="pcode" value="{{$pcode}}">
    {{--Hash驗證碼1--}}<input type="hidden" name="channel_id" value="alipay">

</form>
<script>
    window.onload = function () {
        document.querySelector("#form").submit()
    }
</script>
</body>
</html>
