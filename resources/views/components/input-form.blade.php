@php
$keydata = 'form.' . $key
@endphp

<div class="mb-2">
    <label for="{{$key}}" class="text-xs dark:text-gray-200">{{$title}}</label>
    <input type="{{$type}}" id="{{$key}}" name="{{$key}}" class="flex w-full items-center justify-center rounded-md border text-sm outline-none dark:bg-gray-900 dark:text-gray-200 border-gray-200" />
    <x-input-error :messages="$errors->get($keydata)" class="mt-2" />
</div>