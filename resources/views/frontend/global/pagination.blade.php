<div class="col-lg-12">
    <div class="pagination">

        @if($page > 1)
            <a href="{{ route(Route::currentRouteName(), [$page - 1, 'perPage' => $perPage]) }}">&laquo;</a>
        @endif

        @for($i=1; $i <= ceil($total_items/$perPage); $i++)

            <a @if($i == $page) class="active" @endif href="{{ route(Route::currentRouteName(), [$i, 'perPage' => $perPage]) }}">{{ $i }}</a>

        @endfor
        @if($page <= $total_items/$perPage)
            <a href="{{ route(Route::currentRouteName(), [$page + 1, 'perPage' => $perPage]) }}">&raquo;</a>
        @endif
    </div>
</div>
