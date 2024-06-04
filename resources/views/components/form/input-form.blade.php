<div {{ $attributes->merge(['class' => 'mt-4']) }}>
    <label for="{{ $key }}" class="block text-sm capitalize text-gray-700 dark:text-gray-300">{{ $title }}</label>
    <input
        id="{{ $key }}"
        placeholder="{{ $placeholder }}"
        type="{{ $type }}"
        name="{{ $key }}"
        value="{{ $value }}"
        class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-gray-600 placeholder-gray-400 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-300 dark:focus:ring-blue-200"
        {{ $readonly ? 'readonly' : '' }}
    />
    <ul id="error" class="'text-sm space-y-1' text-red-600 dark:text-red-400"></ul>
    <x-form.input-error :messages="$errors->get($key)" class="mt-2" />
</div>
