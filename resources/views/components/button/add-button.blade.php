<button id="addButton" @click="modalOpen = !modalOpen"
    class="flex shrink-0 items-center justify-center gap-x-2 text-nowrap rounded-lg bg-ColorButton px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200  hover:bg-ColorHover dark:bg-ColorButton  dark:hover:bg-ColorHover sm:w-auto"
    onclick="window.utils.Request.actionRequest('{{ $routeButton }}', '{{ $modalParent }}', '{{ $modalForm }}',{{ $multipartReq }})">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="h-5 w-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>

    <span>{{ $title }}</span>
</button>
