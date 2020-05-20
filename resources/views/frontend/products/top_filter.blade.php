<div class="ptop filter">

    <h5><a href="#">Text 1</a> / <span>Text 2</span></h5>

    <form method="get" id="filter_form" action="{{ route($route_name, isset($route_params) ? $route_params : []) }}">
        <div class="ptop-right">
                            <span><strong>Show :</strong>
                                <span>
                                    <input id="perPage9" type="radio" @if($perPage == 9) checked @endif class="hide" name="perPage" value="9">
                                    <label for="perPage9">9</label>
                                </span>/
                                <span>
                                    <input id="perPage12" type="radio" @if($perPage == 12) checked @endif class="hide" name="perPage" value="12">
                                    <label for="perPage12">12</label>
                                </span> /
                                <span>
                                    <input id="perPage18" type="radio" @if($perPage == 18) checked @endif class="hide" name="perPage" value="18">
                                    <label for="perPage18">18</label>
                                </span> /
                                <span>
                                    <input id="perPage24" type="radio" @if($perPage == 24) checked @endif class="hide" name="perPage" value="24">
                                    <label for="perPage24">24</label>
                                </span>
                            </span>
            {{--<span>
                <a href="#"><img src="{{ asset("images/licon01.jpg") }}" alt=""/></a>
                <a href="#"><img src="{{ asset("images/licon02.jpg") }}" alt=""/></a>
                <a href="#"><img src="{{ asset("images/licon03.jpg") }}" alt=""/></a>
                <a href="#"><img src="{{ asset("images/licon04.jpg") }}" alt=""/></a>
            </span>--}}

            <span>
                <select name="order" onchange="document.querySelector('#filter_form').submit();">
                <option value=null>{{ __("Default Sorting") }}</option>
                <option value="asc" @if($order == 'asc') selected @endif>{{ __("Sorting A to Z") }}</option>
                <option value="desc" @if($order == 'desc') selected @endif>{{ __("Sorting Z to A") }}</option>
                </select>
            </span>
        </div>

    </form>
</div>
<script>
    document.querySelectorAll('.filter input[type="radio"]').forEach(function(o, i){
        o.onclick = function () {
            document.querySelector("#filter_form").submit();
        }
    })
</script>
