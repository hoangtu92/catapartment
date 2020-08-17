<form action="{{ $url }}" method="POST" id="form">
    {{--商家代號--}}<input type="hidden" name="seller_id" value="{{$seller_id}}"> <br/>
    {{--交易編號--}}<input type="hidden" name="pno" value="{{$pno}}"><br/>
    {{--交易金額--}}<input type="hidden" name="ntd" value="{{$ntd}}"><br/>
    {{--交易時間--}}<input type="hidden" name="ttime" value="{{$ttime}}"><br/>
    {{--驗證參數--}}<input type="hidden" name="validate_method" value="{{$validate_method}}"><br/>
    {{--項目總數--}}<input type="hidden" name="count" value="{{$count}}"><br/>
    {{--商品編號--}}<input type="hidden" name="pid0" value="{{$pid0}}"><br/>
    {{--商品數量--}}<input type="hidden" name="qty0" value="{{$qty0}}"><br/>
    {{--導回網頁--}}<input type="hidden" name="return_url" value="{{$return_url}}"><br/>
    {{--收件人--}}<input type="hidden" name="receiver" value="{{$receiver}}"><br/>
    {{--商品描述--}}<input type="hidden" name="pname" value="{{$pname}}"><br/>
    {{--Hash驗證碼1--}}<input type="hidden" name="pcode" value="{{$pcode}}"><br/>
</form>
<script>
    window.onload = function () {
        document.querySelector("#form").submit()
    }
</script>
