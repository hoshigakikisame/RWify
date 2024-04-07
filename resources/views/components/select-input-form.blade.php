<div class="mb-2">
    <label for="{{$key}}" class="text-xs dark:text-gray-200">{{$title}}</label>
    <select name="{{$key}}" id="{{$key}}" class="flex w-full items-center justify-center rounded-md border text-sm outline-none border-gray-200 dark:text-gray-200 dark:bg-gray-900" required>
        <option value="">Pilih {{$title}}</option>
        @foreach($options as $option => $value)
        <option value="{{$value}}">{{$option}}</option>
        @endforeach
    </select>
</div>