<div {{ $attributes->merge(['class' => 'flex justify-center']) }} id="darkModeButton">
    <label for="themeSwitcherOne"
        class="themeSwitcherTwo shadow-two relative inline-flex cursor-pointer select-none items-center justify-center gap-1 rounded-full border bg-white p-1 dark:bg-darkBg dark:text-gray-200">
        <span id="sun"
            class="light text-primary bg-gray flex items-center space-x-[2px] rounded-full bg-gray-300 p-2 py-2 text-sm font-medium dark:bg-darkBg dark:fill-slate-200 {{ $isSimple ? '' : 'lg:px-[18px]' }}">
            <svg viewBox="0 0 16 16" class="w-4 fill-inherit">
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
            @if (!$isSimple)
                <span class="hidden lg:block">Light</span>
            @endif
        </span>
        <span id="moon"
            class="text-body-color dark flex items-center space-x-[2px] rounded-full p-2 py-2 text-sm font-medium text-gray-800 dark:bg-white {{ $isSimple ? '' : 'lg:px-[18px]' }}">
            <svg viewBox="0 0 16 16" class="w-4  fill-inherit">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M8.055 1.673a.67.67 0 0 1-.045.724 4 4 0 0 0 5.594 5.594.667.667 0 0 1 1.06.598 6.667 6.667 0 1 1-7.251-7.252.67.67 0 0 1 .642.336M6.212 2.96a5.333 5.333 0 1 0 6.83 6.83 5.333 5.333 0 0 1-6.83-6.83" />
            </svg>
            @if (!$isSimple)
                <span class="hidden lg:block">Dark</span>
            @endif
        </span>
    </label>
</div>
