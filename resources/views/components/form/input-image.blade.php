@php
    $previewDiv = '<div id="' . $id . '-preview" class="mt-2 rounded-sm bg-cover bg-center bg-no-repeat w-full h-96" style="background-image: url(' . $value . ')"></div>';
@endphp

<div id="{{ $id }}-wrapper" {{ $attributes->merge(['class' => 'mt-4']) }}>
    <label for="{{ $id }}" class="block text-sm capitalize text-gray-700 dark:text-gray-300">{{ $title }}</label>
    <input
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        type="file"
        name="{{ $key }}"
        value="{{ $value }}"
        class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-gray-600 placeholder-gray-400 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-300 dark:focus:ring-blue-200"
        onchange="if(document.querySelector('#{{ $id }}-preview') == null){ document.querySelector('#{{ $id }}-wrapper').insertAdjacentHTML('beforeend', '{{ $previewDiv }}') };document.getElementById('{{ $id }}-preview').style.backgroundImage = 'url(' + window.URL.createObjectURL(event.target.files[0]) + ')';"
    />
    <ul id="error" class="'text-sm space-y-1' text-red-600 dark:text-red-400"></ul>
    <x-form.input-error :messages="$errors->get($key)" class="mt-2" />
    @if ($value)
        {!! $previewDiv !!}
    @endif
</div>
