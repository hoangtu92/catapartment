{{-- image column type --}}
@php
  $images = data_get($entry, $column['name']);
  $prefix = $column['prefix'] ?? '';
@endphp

@if(is_array($images))
    @foreach($images as $value)

        @php
            if (preg_match('/^data\:image\//', $value)) { // base64_image
               $href = $src = $value;
             } elseif (isset($column['disk'])) { // image from a different disk (like s3 bucket)
               $href = $src = Storage::disk($column['disk'])->url($prefix.$value);
             } else { // plain-old image, from a local disk
               $href = $src = asset( $prefix . $value);
             }
        @endphp
<span>
  @if( empty($value) )
    -
  @else
    <a href="{{ $href }}" target="_blank">
      <img src="{{ $src }}" style="
          max-height: {{ isset($column['height']) ? $column['height'] : "25px" }};
          width: {{ isset($column['width']) ? $column['width'] : "auto" }};
          border-radius: 3px;"
      />
    </a>
  @endif
</span>
@endforeach
    @endif
