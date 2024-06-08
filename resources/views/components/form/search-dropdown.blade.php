 @php
     $dataItems = array_values($items);
 @endphp
 <div x-data="{
     search: '{{ $value }}',
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
     <label for="search-{{ $key }}"
         class="block text-sm capitalize text-gray-700 dark:text-gray-300">{{ $title }}</label>
     <input id="search-{{ $key }}" x-on:click="open = !open" type="search" x-model="search"
         placeholder="{{ $placeholder }}"
         class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-gray-600 placeholder-gray-400 focus:border-green-400 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-40 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-green-300 dark:focus:ring-green-200">

     <input type="hidden" name="{{ $key }}" x-bind:value="data"
         x-effect="if($('{{ $parent }}').find('#display-{{ $key }}').length != 0){console.log(data);$('{{ $parent }}').find('#display-{{ $key }}').val(data)}">

     <div class="absolute top-20 z-30 border rounded-md border-gray-200 dark:border-gray-500 max-h-96 overflow-auto w-full bg-white p-2"
         :class="open ? 'ring border-green-400 ring-green-300 ring-opacity-40' : ''" x-show="open"
         x-on:click.outside="open = !open" x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate" x-transition:enter-end="opacity-100 translate"
         x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate"
         x-transition:leave-end="opacity-0 translate">
         <ul class="">
             <template x-for="item in filteredItems" class="flex flex-col">
                 <li><button
                         class="w-full px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-green-100/80 hover:text-green-900 text-start rounded-md"
                         x-text="item" type="button"
                         x-effect="if(search){Object.keys(items).forEach((key)=> {if(items[key]==item) data = key});search = item;}"
                         @click="Object.keys(items).forEach((key)=> {if(items[key]==item) data = key});search = item;open = false;"></button>
                 </li>
             </template>
         </ul>
     </div>

 </div>
