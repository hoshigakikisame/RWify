@php
    $image = Vite::asset('resources/assets/images/avatar.jpg');
@endphp

<div class="card-container px-3 py-4">
    <div
        class="card-wrap flex flex-col gap-12 overflow-hidden rounded-xl border bg-white p-10 dark:border-gray-700 dark:bg-SecondaryBg">
        <div class="card-header flex w-full flex-col items-center gap-4 bg-cover bg-center">
            <div class="card-avatar">
                <img src="{{ $image }}" alt="" class="h-16 w-16 rounded-full" />
            </div>
            <div class="card-title text-center">
                <h2 class="font-Poppins text-xl font-semibold">{{ $name }}</h2>
                <h4 class="text-md font-Inter font-medium text-yellow-700 dark:text-[#2D9596]">{{ $position }}</h4>
            </div>
        </div>
        <div class="card-body flex flex-col items-center gap-2 text-center">
            <p class="text-sm md:text-md dark:text-gray-300">{{ $description }}</p>
        </div>
        <div class="card-footer text-center">
            <p class="text-xs font-medium text-green-700 dark:text-gray-300">{{ $date }}</p>
        </div>
    </div>
</div>
