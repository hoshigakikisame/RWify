<a
    href="{{ $href }}"
    class="block w-full cursor-pointer rounded-md px-3 py-2 text-inherit hover:bg-gray-100 dark:hover:bg-gray-800 md:px-4"
>
    <div class="wrap flex w-full justify-end gap-1 md:justify-stretch md:gap-5">
        <img src="{{ $icon }}" alt="svg element" class="w-5 md:h-10 md:w-10" />
        <div class="text pr-6">
            <h3 class="text-nowrap md:mr-10 md:font-semibold">{{ $title }}</h3>
            <p class="hidden w-11/12 text-wrap text-xs md:block">{{ $description }}</p>
        </div>
    </div>
</a>
