<!-- Nothing worth having comes easy. - Theodore Roosevelt -->
<aside class="relative z-20 ">
    <nav class="px-4 py-6 overflow-y-hidden shadow-xl h-screen">
        <div class="overflow-y-auto w-fit h-full no-scrollbar">
            <div class="flex flex-col min-h-screen">
                <div class="sidebar-header mb-5 mt-1 inline-flex items-center gap-2 rounded-xl px-3 py-1">
                    <div class="h-7 w-7 rounded-lg bg-indigo-200">
                        <img src="" alt="" />
                    </div>
                    <h1 class="hidden text-center text-xl dark:text-gray-200 lg:block">{{ config('app.name') }}</h1>
                </div>
                <ul class="flex h-full w-full grow flex-col gap-1 fill-gray-500 py-5 dark:fill-gray-200">
                    {{ $slot }}
                </ul>

                <div class="sidebar-footer flex flex-col items-center">
                    <div class="user-wrap mb-2 w-fit rounded-full border p-2 text-gray-800">
                        <div class="user flex items-center lg:gap-2">
                            <button id="moreButton">
                                <div class="h-11 w-11 rounded-full bg-white bg-cover bg-center dark:bg-gray-900"
                                    style="background-image: url('{{ $imageProfile }}')"></div>
                            </button>
                            <div class="body relative hidden w-20 lg:block lg:min-w-10">
                                <h5
                                    class="overflow-data lg:text-md ... truncate text-nowrap bg-white text-sm dark:bg-gray-900 dark:text-gray-200">
                                    {{ $role }}
                                </h5>
                                <p
                                    class="overflow-data ... cursor-pointer truncate bg-white dark:bg-gray-900 dark:text-gray-200 sm:text-xs">
                                    {{ $email }}
                                </p>
                            </div>
                            <div class="nestedMenu relative flex" tabindex="0">
                                <button class="hidden px-3 lg:block" id="moreButton">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve"
                                        class="h-4 w-4 dark:fill-gray-200">
                                        <circle cx="42.667" cy="256" r="42.667" />
                                        <circle cx="256" cy="256" r="42.667" />
                                        <circle cx="469.333" cy="256" r="42.667" />
                                    </svg>
                                </button>
                                <div id="moreMenu"
                                    class="-right-30 absolute bottom-0 z-20 rounded-lg border bg-gray-50 px-2 py-0.5 shadow-md dark:bg-gray-900">
                                    <div class="flex w-full flex-col px-1 py-2">
                                        @foreach ($footerMenu as $key => $item)
                                            <a class="inline-flex items-center gap-2 text-nowrap rounded-md px-3 py-1 text-gray-800 hover:bg-white dark:text-gray-200 dark:hover:bg-gray-800"
                                                href="{{ $item['link'] }}">
                                                <span
                                                    class="fill-gray-800 dark:fill-gray-200">{!! $item['icon'] !!}</span>
                                                {{ $key }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center" id="darkModeButton">
                        <label for="themeSwitcherOne"
                            class="themeSwitcherTwo shadow-two relative inline-flex cursor-pointer select-none items-center justify-center gap-1 rounded-full border bg-white p-1 dark:bg-gray-900 dark:text-gray-200">
                            <span id="sun"
                                class="light text-primary bg-gray flex items-center space-x-[2px] rounded-full bg-gray-300 p-2 py-2 text-sm font-medium dark:bg-gray-800 dark:fill-slate-200 lg:px-[18px]">
                                <svg width="16" height="16" viewBox="0 0 16 16" class="fill-inherit">
                                    <g clip-path="url(#a)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8 0c.368 0 .667.298.667.667V2a.667.667 0 0 1-1.334 0V.667C7.333.298 7.632 0 8 0m0 5.333a2.667 2.667 0 1 0 0 5.334 2.667 2.667 0 0 0 0-5.334M4 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0m4.667 6a.667.667 0 1 0-1.334 0v1.333a.667.667 0 1 0 1.334 0zM2.34 2.342c.26-.26.683-.26.943 0l.947.947a.667.667 0 1 1-.943.943l-.947-.947a.667.667 0 0 1 0-.943m10.37 9.426a.667.667 0 1 0-.943.943l.947.947a.667.667 0 0 0 .943-.943zM0 8c0-.368.298-.667.667-.667H2a.667.667 0 0 1 0 1.334H.667A.667.667 0 0 1 0 8m14-.667a.667.667 0 1 0 0 1.334h1.333a.667.667 0 1 0 0-1.334zm-9.77 4.435c.26.26.26.683 0 .943l-.946.947a.667.667 0 0 1-.943-.943l.947-.947c.26-.26.682-.26.943 0m9.428-8.483a.667.667 0 0 0-.943-.943l-.947.947a.667.667 0 1 0 .943.943z" />
                                    </g>
                                    <defs>
                                        <clipPath id="a">
                                            <path fill="#fff" d="M0 0h16v16H0z" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="hidden lg:block">Light</span>
                            </span>
                            <span id="moon"
                                class="text-body-color dark flex items-center space-x-[2px] rounded-full p-2 py-2 text-sm font-medium text-gray-800 dark:bg-white lg:px-[18px]">
                                <svg width="16" height="16" viewBox="0 0 16 16" class="fill-inherit">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.055 1.673a.67.67 0 0 1-.045.724 4 4 0 0 0 5.594 5.594.667.667 0 0 1 1.06.598 6.667 6.667 0 1 1-7.251-7.252.67.67 0 0 1 .642.336M6.212 2.96a5.333 5.333 0 1 0 6.83 6.83 5.333 5.333 0 0 1-6.83-6.83" />
                                </svg>
                                <span class="hidden lg:block">Dark</span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</aside>
