@php
    $style =
        'mt-2 block w-full rounded-md border border-gray-200 px-3 py-2 text-gray-600 placeholder-gray-400 focus:border-green-400 focus:outline-none focus:ring dark:bg-darkBg focus:ring-green-300 focus:ring-opacity-40 dark:border-gray-500  dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-green-300 dark:focus:ring-green-200';
@endphp

<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <label for="{{ $key }}" class="text-sm text-gray-500 dark:text-gray-400">{{ $title }}</label>
    <div class="mt-1">
        @if ($disabled)
            <input id="{{ $key }}" type="{{ $type }}" name="{{ $key }}"
                value="{{ $value }}" disabled {{ $attributes->merge(['class' => $style]) }} />
        @else
            <input id="{{ $key }}" type="{{ $type }}" name="{{ $key }}"
                value="{{ $value }}" {{ $attributes->merge(['class' => $style]) }} />
        @endif
        <ul id="error" class="'text-sm space-y-1' text-red-600 dark:text-red-400"></ul>
    </div>
</div>
