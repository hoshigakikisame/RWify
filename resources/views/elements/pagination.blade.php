@php
$pagesToShow = 2;

$firstPage = max(1, $paginator->currentPage() - $pagesToShow);
$lastPage = min($paginator->lastPage(), $paginator->currentPage() + $pagesToShow);

$prevPage = $paginator->currentPage() - 1;
$nextPage = $paginator->currentPage() + 1;

$currentPath = request()->url();
@endphp

<div class="flex justify-between items-center mt-4 pt-3">
        <div class="flex">
            <div class="flex items-center">
                <label for="perPage" class=" mr-3 text-sm font-medium text-gray-800 dark:text-gray-300">Per Page</label>
                <select name="pageCount" id="pageCount" class="bg-white border border-gray-300 dark:bg-gray-900 text-gray-800 dark:text-gray-200 text-sm rounded-lg focus:border-blue-500 focus:ring-blue-400 dark:focus:border-blue-400 dark:focus:ring-blue-400" onchange="paginate({{$paginator->currentPage()}})">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    <div aria-label="pagination">
        <ul class="pagination flex gap-1">
            @if ($paginator->currentPage() > 1)
            <li class="page-item"><button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800" onclick="paginate(1)">
                    << </button></li>
            @endif
            <li class="page-item"><button id="prev_button" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 {{$paginator->onFirstPage() ? 'cursor-not-allowed' : ''}}" onclick="paginate({{$nextPage}})" {{$paginator->onFirstPage() ? 'disabled=1' : ''}}>
                    Prev
                </button></li>
    
            @for ($i = $firstPage; $i <= $lastPage; $i++)
                <li class="page-item"><button {{$i == $paginator->currentPage() ? 'disabled=1' : ''}} class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 {{$i == $paginator->currentPage() ? '!bg-gray-200 cursor-not-allowed' : ''}}" onclick="paginate({{$i}})">
                        {{$i}}
                    </button></li>
            @endfor
    
            <li class="page-item"><button id="next_button" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 {{$paginator->onLastPage() ? 'cursor-not-allowed' : ''}}" onclick="paginate({{$nextPage}})" {{$paginator->onLastPage() ? 'disabled=1' : ''}}>
                    Next
                </button></li>
            @if ($nextPage < $paginator->lastPage())
                <li class="page-item"><button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800" onclick="paginate({{$paginator->lastPage()}})">
                    >></button></li>
            @endif
        </ul>
    </div>

</div>



<script type="module" >
  $(document).ready(function(){
        $('#pageCount').val(document.location.search.includes('paginate') ? new URLSearchParams(document.location.search).get('paginate') : 5)
    });
</script>

<script>
  

  function paginate(targetPage) { 
      let url = document.location

      if(url.search.includes("page")){
          url = url.origin + url.pathname + url.search.replace({{$paginator->currentPage()}},targetPage)
      }else{
          url = url.origin + url.pathname + "?" + "page" + "=" + targetPage
      }

      const pageCount = document.querySelector('#pageCount').value
      if (url.includes('paginate')) {
          url = url.replace(/paginate=\d+/, `paginate=${pageCount}`)
      } else {
          url = url + `&paginate=${pageCount}`
      }

      if({{$paginator->currentPage()}} > Math.ceil({{$paginator->total()}}/pageCount)){
          url = url.replace(/page=\d+/, 'page='+ Math.ceil({{$paginator->total()}}/pageCount))
      }
      
      $.ajax({
          url: url,
          beforeSend: window.Loading.showLoading,
          success:function (res) {
              let parser = new DOMParser();
              let doc = parser.parseFromString(res, 'text/html');
              $('body').html(doc.body.innerHTML)
              window.history.pushState({"html":res.html,"pageTitle":res.pageTitle},"", url);
          }
      })
   }
</script>