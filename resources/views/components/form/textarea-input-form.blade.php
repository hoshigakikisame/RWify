<div class="mt-4">
    <label for="{{ $key }}"
        class="block text-sm capitalize text-gray-700 dark:text-gray-300">{{ $title }}</label>

    <textarea id="{{ $key }}" placeholder="{{ $placeholder }}" name="{{ $key }}"
        rows="{{ $rows }}"
        class="resize:{{ $resize }} mt-2 block w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-gray-600 placeholder-gray-400 focus:border-green-400 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-40 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-green-300 dark:focus:ring-green-200">
{{ $value }}</textarea>
    <ul id="error" class="'text-sm space-y-1' text-red-600 dark:text-red-400"></ul>
    <x-form.input-error :messages="$errors->get($key)" class="mt-2" />
</div>
