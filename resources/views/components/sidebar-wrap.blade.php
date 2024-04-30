<!-- Nothing worth having comes easy. - Theodore Roosevelt -->
<aside class="min-h-screen relative z-20">
    <nav class="h-full flex flex-col shadow-xl px-4 py-6 w-fit">
        <div class="sidebar-header">
            <h1 class="text-center text-3xl hidden lg:block dark:text-gray-200">{{ config('app.name') }}</h1>
            <img src="" alt="">
        </div>
        <ul class="h-full grow py-5 w-full flex flex-col gap-1  fill-gray-500 dark:fill-gray-200">
            {{$slot}}
        </ul>

        <div class="sidebar-footer">
            <div class="user-wrap border p-2 rounded-full text-gray-800 mb-2 w-full">
                <div class="user flex items-center lg:gap-2 ">
                    <button id="moreButton">
                        <img class="h-10 max-w-10 rounded-full" src="{{$imageProfile}}" alt="Thoriq Fathurrozi">
                    </button>
                    <div class="body lg:min-w-10 hidden lg:block w-20 relative">
                        <h5 class="overflow-data text-sm lg:text-md dark:text-gray-200  dark:bg-gray-900 bg-white text-nowrap truncate ...">{{$role}}</h5>
                        <p class="overflow-data dark:bg-gray-900 bg-white cursor-pointer sm:text-xs dark:text-gray-200 truncate ... ">{{$email}}</p>
                    </div>
                    <div class="nestedMenu relative flex" tabindex="0">
                        <button class="px-3 hidden lg:block" id="moreButton">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="h-4 w-4 dark:fill-gray-200">
                                <circle cx="42.667" cy="256" r="42.667" />
                                <circle cx="256" cy="256" r="42.667" />
                                <circle cx="469.333" cy="256" r="42.667" />
                            </svg>
                        </button>
                        <div id="moreMenu" class="absolute -right-30 bottom-0 bg-gray-50 dark:bg-gray-900 rounded-lg py-0.5 px-2 shadow-md border z-20">
                            <div class="py-2 px-1 flex flex-col w-full">
                                @foreach($footerMenu as $item => $link)
                                <a class="px-4 py-1 rounded-md hover:bg-white dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200 text-nowrap" href="{{$link}}">{{$item}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" flex justify-center" id="darkModeButton">
                <label for="themeSwitcherOne" class="themeSwitcherTwo shadow-two relative inline-flex cursor-pointer select-none items-center justify-center bg-white dark:bg-gray-900 p-1 dark:text-gray-200 border rounded-full gap-1">
                    <span id="sun" class="light text-primary bg-gray dark:bg-gray-800 bg-gray-300 flex items-center space-x-[2px] rounded-full py-2 p-2 lg:px-[18px] text-sm font-medium dark:fill-slate-200">
                        <svg width="16" height="16" viewBox="0 0 16 16" class="fill-inherit">
                            <g clip-path="url(#a)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0c.368 0 .667.298.667.667V2a.667.667 0 0 1-1.334 0V.667C7.333.298 7.632 0 8 0m0 5.333a2.667 2.667 0 1 0 0 5.334 2.667 2.667 0 0 0 0-5.334M4 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0m4.667 6a.667.667 0 1 0-1.334 0v1.333a.667.667 0 1 0 1.334 0zM2.34 2.342c.26-.26.683-.26.943 0l.947.947a.667.667 0 1 1-.943.943l-.947-.947a.667.667 0 0 1 0-.943m10.37 9.426a.667.667 0 1 0-.943.943l.947.947a.667.667 0 0 0 .943-.943zM0 8c0-.368.298-.667.667-.667H2a.667.667 0 0 1 0 1.334H.667A.667.667 0 0 1 0 8m14-.667a.667.667 0 1 0 0 1.334h1.333a.667.667 0 1 0 0-1.334zm-9.77 4.435c.26.26.26.683 0 .943l-.946.947a.667.667 0 0 1-.943-.943l.947-.947c.26-.26.682-.26.943 0m9.428-8.483a.667.667 0 0 0-.943-.943l-.947.947a.667.667 0 1 0 .943.943z" />
                            </g>
                            <defs>
                                <clipPath id="a">
                                    <path fill="#fff" d="M0 0h16v16H0z" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span class="hidden lg:block">Light</span>
                    </span>
                    <span id="moon" class="dark text-body-color flex items-center space-x-[2px] p-2 lg:px-[18px] rounded-full py-2 text-sm font-medium dark:bg-white text-gray-800">
                        <svg width="16" height="16" viewBox="0 0 16 16" class="fill-inherit">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.055 1.673a.67.67 0 0 1-.045.724 4 4 0 0 0 5.594 5.594.667.667 0 0 1 1.06.598 6.667 6.667 0 1 1-7.251-7.252.67.67 0 0 1 .642.336M6.212 2.96a5.333 5.333 0 1 0 6.83 6.83 5.333 5.333 0 0 1-6.83-6.83" />
                        </svg>
                        <span class="hidden lg:block">Dark</span>
                    </span>
                </label>
            </div>
        </div>
    </nav>
</aside>