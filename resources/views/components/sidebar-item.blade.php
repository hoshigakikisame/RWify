<li class="nav-item relative">
    <a href="{{ $href }}" class="w-full text-gray-800 flex items-center justify-center lg:justify-normal gap-3 py-2 px-3 hover:bg-gray-100 rounded-lg fill-inherit sidebar-item">
        {{ $slot }}
        <span class="text-md hidden absolute px-3 py-1 lg:p-0 text-nowrap z-20 bg-gray-100 rounded-lg left-16 lg:bg-transparent lg:static lg:block">{{$title}}</span>
    </a>
</li>