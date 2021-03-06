<div class="ptop filter">

    {{--<h5><a href="#">Text 1</a> / <span>Text 2</span></h5>--}}

    <form method="get" id="filter_form" action="{{ route(Route::currentRouteName(), isset($route_params) ? $route_params : []) }}">
        <div class="ptop-right">
                            <span><strong>頁數 :</strong>
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
            <span id="viewMode">
                <a href="#" ng-click="changeView(1)"><img ng-src="@{{ currentView !== 1 && 'images/licon01.jpg'  || currentView === 1 && 'images/licon01-active.jpg' }}" alt=""/></a>
                <a href="#" ng-click="changeView(2)"><img ng-src="@{{ currentView !== 2 && 'images/licon02.jpg'  || currentView === 2 && 'images/licon02-active.jpg' }}" alt=""/></a>
                <a href="#" ng-click="changeView(3)"><img ng-src="@{{ currentView !== 3 && 'images/licon03.jpg'  || currentView === 3 && 'images/licon03-active.jpg' }}" alt=""/></a>
                <a href="#" ng-click="changeView(4)"><img ng-src="@{{ currentView !== 4 && 'images/licon04.jpg'  || currentView === 4 && 'images/licon04-active.jpg' }}" alt=""/></a>
            </span>

            <span>
                <select name="order" onchange="document.querySelector('#filter_form').submit();">
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
    });


</script>
