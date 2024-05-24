 @php
     $dataItems = array_values($items);
 @endphp
 <div x-data="{
     search: '',
     items: {{ json_encode($items) }},
     open: false,
     data: '',
 
     get filteredItems() {
         this.items = JSON.parse(JSON.stringify(this.items))
         if (this.search === '') {
             return this.items;
         }
         return Object.values(this.items).filter((item) => {
             return item.toLowerCase().includes(this.search.toLowerCase());
         });
     }
 }" class="relative mt-4">
     <label for="{{ $key }}"
         class="block text-sm capitalize text-gray-700 dark:text-gray-300">{{ $title }}</label>
     <input id="search-{{ $key }}" x-on:click="open = !open" type="search" x-model="search"
         placeholder="{{ $placeholder }}"
         class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-gray-600 placeholder-gray-400 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-300 dark:focus:ring-blue-200">

     <input type="hidden" name="{{ $key }}" x-bind:value="data">

     <ul id="" x-show="open" x-on:click.outside="open = !open"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate"
         x-transition:enter-end="opacity-100 translate" x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate" x-transition:leave-end="opacity-0 translate"
         class="border rounded-md border-gray-200 dark:border-gray-500 absolute top-20 z-30 w-full bg-white p-2"
         :class="open ? 'ring border-blue-400 ring-blue-300 ring-opacity-40' : ''">
         <template x-for="item in filteredItems" :key="item" class="flex flex-col">
             <li><button
                     class="w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-blue-100/80 hover:text-blue-900 text-start rounded-md"
                     x-text="item"
                     @click="Object.keys(items).forEach((key)=> {if(items[key]==item) data = key});document.getElementById('search-{{ $key }}').value = item;open = false"></button>
             </li>
         </template>
     </ul>

 </div>