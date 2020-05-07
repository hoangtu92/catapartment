{{-- regular object attribute --}}

<ul style="padding:0; margin: 0; list-style: none">
    @foreach($entry->items as $item)
        <li><a href="{{ $item->product->permalink }}">{{ $item->product->name }}</a> <strong>({{ $item->color }}x{{$item->qty}})</strong></li>
        @endforeach
</ul>
