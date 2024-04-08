<div class="mb-2">
    <label for="{{$key}}" class="text-xs dark:text-gray-200">{{$title}}</label>
    <textarea id="{{$key}}" wire:model="form.{{$key}}" name="{{$key}}" class="flex w-full items-center justify-center rounded-md border text-sm outline-none border-gray-200 dark:bg-gray-900 dark:text-gray-200"></textarea>
    @error('{{$key}}')
    <span class="text-red-400">{{$message}}</span>
    @enderror
</div>