@php
$style = "rounded border-1 border-gray-500/50 text-gray-700 dark:text-gray-200 dark:bg-gray-900";
@endphp
<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <label for="{{$key}}" class="text-sm text-gray-500 dark:text-gray-400">{{$title}}</label>
    <div class="mt-1">
        @if($disabled)
        <input id="{{$key}}" type="{{$type}}" name="{{$key}}" value="{{$value}}" disabled {{ $attributes->merge(['class' => $style]) }}>
        @else
        <input id="{{$key}}" type="{{$type}}" name="{{$key}}" value="{{$value}}" {{ $attributes->merge(['class' => $style]) }}>
        @endif
    </div>
</div>