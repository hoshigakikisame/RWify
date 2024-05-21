<div class="mt-4" x-effect="$($refs.{{ $key }}).val('{{ $selected }}').change()">
    <label for="agama" class="block text-sm capitalize text-gray-700 dark:text-gray-300">{{ $title }}</label>
    <select
        name="{{ $key }}"
        id="{{ $key }}"
        x-ref="{{ $key }}"
        aria-selected="{{ $selected }}"
        class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-gray-600 placeholder-gray-400 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-300 dark:focus:ring-blue-200"
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $option => $value)
            <option value="{{ $value }}">{{ $option }}</option>
        @endforeach
    </select>
    <ul id="error" class="'text-sm space-y-1' text-red-600 dark:text-red-400"></ul>
    <x-form.input-error :messages="$errors->get($key)" class="mt-2" />
</div>
