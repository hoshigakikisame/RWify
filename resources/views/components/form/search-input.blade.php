<div id="search" class="relative mt-4 flex items-center justify-items-end md:mt-0" x-data="{ search: '' }">
    <span class="absolute">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="mx-3 h-5 w-5 text-gray-400 dark:text-gray-600">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
    </span>
    <input x-model="search" @keyup.enter="window.utils.Request.searchRequest(search,event)" type="text"
        placeholder="{{ $placeholder }}"
        class="block rounded-lg border border-gray-200 bg-white py-1.5 pl-11 pr-5 text-gray-700 placeholder-gray-400/70 focus:border-green-400 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-darkBg dark:text-gray-300 dark:focus:border-green-300 md:w-80 lg:w-full rtl:pl-5 rtl:pr-11" />
</div>
