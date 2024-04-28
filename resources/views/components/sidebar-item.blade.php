@props(['active'])

@php
$classes = ($active ?? false)
    ? 'w-full text-blue-600 fill-blue-600 rounded-lg flex bg-gray-100 items-center justify-center dark:bg-gray-800 dark:text-blue-300 dark:fill-blue-400 lg:justify-normal gap-3 py-2 px-3 dark:hover:bg-gray-800 rounded-lg sidebar-item text-nowrap'
    : 'w-full text-gray-800 dark:text-gray-200 flex items-center justify-center lg:justify-normal gap-3 py-2 px-3 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg sidebar-item text-nowrap';
@endphp


<li class="nav-item relative">
    <a {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>
        {{ $slot }}
        <span class="hidden lg:block absolute left-16 lg:static rounded-lg bg-gray-200 lg:bg-transparent lg:dark:bg-transparent dark:bg-gray-700 px-2 py-1 lg:p-0 transition-all ease-in">{{$title}}</span>
    </a>
</li>