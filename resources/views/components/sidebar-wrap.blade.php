<!-- Nothing worth having comes easy. - Theodore Roosevelt -->
<aside class="h-screen relative">
    <nav class="h-full flex flex-col shadow-xl px-4 py-6 w-fit">
        <div class="sidebar-header">
            <h1 class="text-center text-3xl hidden lg:block">RWFIY</h1>
            <img src="" alt="">
        </div>
        <ul class="h-full grow py-5 w-full flex flex-col gap-1 fill-gray-500 mx-auto">
            {{$slot}}
        </ul>

        <div class="sidebar-footer border p-2 rounded-full text-gray-800 mb-8 w-full">
            <div class="user flex items-center lg:gap-2 ">
                <button id="moreButton">
                    <img class="h-10 max-w-10 rounded-full" src="{{Vite::asset('resources/assets/images/frrxy.png')}}" alt="Thoriq Fathurrozi">
                </button>
                <div class="body lg:min-w-10 hidden lg:block w-20">
                    <h5 class="text-sm lg:text-md ">{{$role}}</h5>
                    <p class="text-xs text-ellipsis overflow-hidden ...">{{$email}}</p>
                </div>
                <div class="nestedMenu relative flex" tabindex="0">
                    <button class="px-3 hidden lg:block" id="moreButton">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="h-4 w-4 ">
                            <circle cx="42.667" cy="256" r="42.667" />
                            <circle cx="256" cy="256" r="42.667" />
                            <circle cx="469.333" cy="256" r="42.667" />
                        </svg>
                    </button>
                    <div id="moreMenu" class="absolute -right-30 bottom-0 bg-gray-50 rounded-lg py-0.5 px-2 shadow-md border z-20">
                        <div class="py-2 px-1 flex flex-col w-full">
                            @foreach($footerMenu as $item => $link)
                            <a class="px-4 py-1 rounded-md hover:bg-white text-gray-800 text-nowrap" href="{{$link}}">{{$item}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</aside>