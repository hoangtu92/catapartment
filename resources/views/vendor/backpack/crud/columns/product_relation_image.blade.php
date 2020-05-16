{{-- image column type --}}
<span>
  @if( empty($entry->product->image) )
    -
  @else
    <a href="{{ $entry->product->permalink }}" target="_blank">
      <img src="{{ asset($entry->product->image) }}" style="
          max-height: {{ isset($column['height']) ? $column['height'] : "25px" }};
          width: {{ isset($column['width']) ? $column['width'] : "auto" }};
          border-radius: 3px;"
      />
    </a>
  @endif
</span>
