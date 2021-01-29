<form action="{{ $ExecUrl }}" method="POST" id="form">
    <input type="hidden" name="seller_id" value="{{$StoreId}}"> <br/>
    <input type="hidden" name="outer_id" value="{{$product->id}}"> <br/>
    <input type="hidden" name="title" value="{{$product->name}}"> <br/>
    <input type="hidden" name="scids" value="1"> <br/>
    <input type="hidden" name="href" value="{{$product->permalink}}"> <br/>
    <input type="hidden" name="price" value="{{$product->realPrice}}"> <br/>
    <input type="hidden" name="weight" value="0"> <br/>
    <input type="hidden" name="length" value="0"> <br/>
    <input type="hidden" name="height" value="0"> <br/>
    <input type="hidden" name="width" value="0"> <br/>
    <input type="hidden" name="shipmode" value="1"> <br/>
    <input type="hidden" name="modified" value="{{$ModifyDate}}"> <br/>
</form>
<script>
    window.onload = function () {
        document.querySelector("#form").submit()
    }
</script>
