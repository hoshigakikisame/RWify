<div class="mb-2">
    <label for="{{$key}}" class="text-xs dark:text-gray-200">{{$title}}</label>
    <textarea id="{{$key}}" name="{{$key}}" class="flex w-full items-center justify-center rounded-md border text-sm outline-none border-gray-200 dark:bg-gray-900 dark:text-gray-200"></textarea>
    <x-input-error :messages="$errors->get($keydata)" class="mt-2" />
</div>