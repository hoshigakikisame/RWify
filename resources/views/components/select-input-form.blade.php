@php
$keydata = 'form.' . $key
@endphp
<div class="mb-2">
    <label for="{{$key}}" class="text-xs dark:text-gray-200">{{$title}}</label>
    <select name="{{$key}}" wire:model="{{$keydata}}"  id="{{$key}}" class="flex w-full items-center justify-center rounded-md border text-sm outline-none border-gray-200 dark:text-gray-200 dark:bg-gray-900" >
        <option value="">Pilih {{$title}}</option>
        @foreach($options as $option => $value)
        <option value="{{$value}}">{{$option}}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get($keydata)" class="mt-2" /> 
</div>