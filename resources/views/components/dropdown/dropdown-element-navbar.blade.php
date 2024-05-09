<a href="{{$href}}" class="block w-full px-3 md:px-4 py-2 text-inherit cursor-pointer rounded-md hover:bg-gray-100 dark:hover:bg-gray-800">
    <div class="wrap flex gap-1 md:gap-5 justify-end md:justify-stretch w-full">
        <img src="{{$icon}}" alt="svg element" class="w-5 md:w-10 md:h-10 ">
        <div class="text pr-6">
            <h3 class="text-nowrap md:mr-10 md:font-semibold ">{{$title}}</h3>
            <p class="text-xs text-wrap w-11/12 hidden md:block">{{$description}}
            </p>
        </div>
    </div>
</a>