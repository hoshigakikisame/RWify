<div class="mt-4">
    <label for="{{$key}}" class="block text-sm text-gray-700 capitalize dark:text-gray-300">{{$title}}</label>

    <textarea id="{{$key}}" placeholder="{{$placeholder}}" name="{{$key}}" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:focus:ring-blue-200 dark:focus:border-blue-300 dark:bg-gray-700 dark:border-gray-500 dark:text-gray-300 dark:placeholder-gray-500">{{$value}}</textarea>
    <ul id="error" class="'text-sm text-red-600 dark:text-red-400 space-y-1'">
    </ul>
    <x-form.input-error :messages="$errors->get($key)" class="mt-2" />
</div>