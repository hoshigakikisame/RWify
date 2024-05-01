<div class="card-container px-3 py-4 ">
    <div class="card-wrap rounded-xl overflow-hidden  border dark:border-gray-700 ">
        <div class="card-img bg-cover bg-center w-full mx-6 my-5">
            <img src="{{ $icon }}" alt="" class="h-16 w-16">
        </div>
        <div class="card-body mx-6 my-5 flex flex-col gap-2">
            <h2 class="text-2xl font-medium font-Poppins leading-6">{{ $title }}</h2>
            <p class="font-Inter font-light text-md dark:text-gray-400 w-80">{{ $description }}</p>
            <div class="action-button">
                <a href="{{ $href }}" class="flex items-center dark:fill-green-600 fill-green-800">
                    <span class="py-2 text-xs text-green-800 dark:text-green-600">Selengkapnya</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 pt-1 fill-inherit">
                        <path
                            d="M18 12a2 2 0 0 0-.59-1.4l-4.29-4.3a1 1 0 0 0-1.41 0 1 1 0 0 0 0 1.42L15 11H5a1 1 0 0 0 0 2h10l-3.29 3.29a1 1 0 0 0 1.41 1.42l4.29-4.3A2 2 0 0 0 18 12" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
