@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'sidebar-item flex w-full items-center justify-center gap-3 text-nowrap rounded-lg rounded-lg bg-gray-100 fill-ColorWhiteSidebar px-3 py-2 text-ColorWhiteSidebar dark:bg-gray-800 dark:fill-ColorButton dark:text-ColorButton dark:hover:bg-gray-800 lg:justify-normal'
            : 'sidebar-item flex w-full items-center justify-center gap-3 text-nowrap rounded-lg px-3 py-2 text-gray-800 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800 lg:justify-normal';
@endphp

<li class="nav-item relative" x-ref="link" @mouseover="$($refs.link).find('svg').addClass('!w-6')"
    @mouseleave="$($refs.link).find('svg').removeClass('!w-6')" x-data="{}">
    <a {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>
        {{ $slot }}
        <span
            class="absolute left-16 hidden rounded-lg bg-gray-200 px-2 py-1 transition-all ease-in dark:bg-gray-700 lg:static lg:block lg:bg-transparent lg:p-0 lg:dark:bg-transparent">
            {{ $title }}
        </span>
    </a>
</li>
