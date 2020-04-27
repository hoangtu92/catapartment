{{-- regular object attribute --}}
@php
	$value = data_get($entry, $column['name']);

@endphp

<div style="width: 16px; height: 16px; border-radius: 50%; border:1px solid black; background-color: {{ $value }}"></div>
