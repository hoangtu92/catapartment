{{-- image column type --}}
<span>
  @if( empty($entry->order) )
    -
  @else
    <a href="/admin/order/{{ $entry->order->id }}/edit">
     {{ $entry->order->order_id }}
    </a>
  @endif
</span>
