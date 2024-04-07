<div class="mb-2">
    <label for="{{$key}}" class="text-xs">{{$title}}</label>
    <select name="{{$key}}" id="{{$key}}" class="flex w-full items-center justify-center rounded-md border text-sm outline-none border-gray-200" required>
        <option value="">Pilih {{$title}}</option>
        @foreach($options as $option => $value)
        <option value="{{$value}}">{{$option}}</option>
        @endforeach
    </select>
</div>