@props([
    'active',
])

@php
    $classes =
        $active ?? false
            ? 'sidebar-item flex w-full items-center justify-center gap-3 text-nowrap rounded-lg rounded-lg bg-gray-100 fill-blue-600 px-3 py-2 text-blue-600 dark:bg-gray-800 dark:fill-blue-400 dark:text-blue-300 dark:hover:bg-gray-800 lg:justify-normal'
            : 'sidebar-item flex w-full items-center justify-center gap-3 text-nowrap rounded-lg px-3 py-2 text-gray-800 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800 lg:justify-normal';
@endphp

<li class="nav-item relative">
    <a {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>
        {{ $slot }}
        <span
            class="absolute left-16 hidden rounded-lg bg-gray-200 px-2 py-1 transition-all ease-in dark:bg-gray-700 lg:static lg:block lg:bg-transparent lg:p-0 lg:dark:bg-transparent"
        >
            {{ $title }}
        </span>
    </a>
</li>
