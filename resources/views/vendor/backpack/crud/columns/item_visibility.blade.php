{{-- localized datetime using carbon --}}
@php
    $display = data_get($entry, 'display');
    $valid_from = data_get($entry, 'valid_from');
    $valid_until = data_get($entry, 'valid_until');
@endphp

<span data-order="{{ $valid_until || $display }}">

    @if (!is_null($display) )
    Yes
    @elseif (!empty($valid_from) && !empty($valid_until))
	{{
		\Carbon\Carbon::parse($valid_from)
		->locale(App::getLocale())
		->isoFormat($column['format'] ?? config('backpack.base.default_date_format'))
	}} - {{
		\Carbon\Carbon::parse($valid_until)
		->locale(App::getLocale())
		->isoFormat($column['format'] ?? config('backpack.base.default_date_format'))
	}}
        @else
        No
    @endif
</span>
