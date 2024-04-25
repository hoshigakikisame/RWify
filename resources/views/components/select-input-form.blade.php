<div class="mt-4">
    <label for="agama" class="block text-sm text-gray-700 capitalize dark:text-gray-300">{{$title}}</label>
    <select name="{{$key}}" id="{{$key}}" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
        <option value="">{{$placeholder}}</option>
        @foreach ($options as $option=> $value)
        <option value="{{$value}}">{{$option}}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get($key)" class="mt-2" />
</div>