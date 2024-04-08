<div class="mb-2">
    <label for="{{$key}}" class="text-xs dark:text-gray-200">{{$title}}</label>
    <input wire:model="form.{{$key}}" type="{{$type}}" id="{{$key}}" name="{{$key}}" class="flex w-full items-center justify-center rounded-md border text-sm outline-none dark:bg-gray-900 dark:text-gray-200 border-gray-200" {{$validation}}>
    @error('{{$key}}')
    <span class="text-red-200">{{$message}}</span>
    @enderror
</div>