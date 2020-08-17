@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
<ul class="nav nav-tabs float-right pl-3 pr-3 border-0">
    @foreach($widget['content'] as $key => $content)
        <li class="ml-2"><a class="btn btn-secondary text-white" data-toggle="tab" href="#chart-{{$key}}">{{$content['title']}}</a></li>
    @endforeach
</ul>
<div class="tab-content {{ $widget['class'] ?? ' mb-2' }}">
    @if (isset($widget['content']))
    @foreach($widget['content'] as $key => $content2)
        <div class="tab-pane fade @if($key == 0) show active @endif" id="chart-{{$key}}">
            @include('backpack::inc.widgets', [ 'widgets' => [$content2] ])
        </div>
    @endforeach
    @endif
</div>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')
