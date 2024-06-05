@php
    $pagesToShow = 2;

    $firstPage = max(1, $paginator->currentPage() - $pagesToShow);
    $lastPage = min($paginator->lastPage(), $paginator->currentPage() + $pagesToShow);

    $prevPage = $paginator->currentPage() - 1;
    $nextPage = $paginator->currentPage() + 1;

    $currentPath = request()->url();
@endphp

<div class="mt-4 flex items-center justify-between pt-3">
    <div class="flex">
        <div class="flex items-center">
            <label for="perPage" class="mr-3 text-sm font-medium text-gray-800 dark:text-gray-300">Per Page</label>
            <select name="pageCount" id="pageCount"
                class="rounded-lg border border-gray-300 bg-white text-sm text-gray-800 focus:border-blue-500 focus:ring-blue-400 dark:bg-gray-900 dark:text-gray-200 dark:focus:border-blue-400 dark:focus:ring-blue-400"
                onchange="paginate({{ $paginator->currentPage() }})">
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
                <li class="page-item">
                    <button
                        class="flex w-1/2 items-center justify-center gap-x-2 rounded-md border bg-white px-5 py-2 text-sm capitalize text-gray-700 transition-colors duration-200 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 sm:w-auto"
                        onclick="paginate(1)">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1"
                            class="h-5 w-5 rtl:-scale-x-100" stroke-width="1.5" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="m10.721,18.342l-5.281-5.281c-.283-.283-.439-.66-.439-1.061s.156-.777.439-1.061l5.281-5.281.707.707-5.281,5.281c-.094.095-.146.22-.146.354s.052.259.146.354l5.281,5.281-.707.707Zm8.052-.707l-5.635-5.635,5.635-5.635-.707-.707-5.871,5.871c-.26.26-.26.683,0,.942l5.871,5.871.707-.707Z" />
                        </svg>
                    </button>
                </li>
            @endif

            <li class="page-item">
                <button id="prev_button"
                    class="{{ $paginator->onFirstPage() ? 'cursor-not-allowed' : '' }} flex w-1/2 items-center justify-center gap-x-2 rounded-md border bg-white px-5 py-2 text-sm capitalize text-gray-700 transition-colors duration-200 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 sm:w-auto"
                    onclick="paginate({{ $nextPage }})" {{ $paginator->onFirstPage() ? 'disabled=1' : '' }}>
                    {{--
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1"
                        class="w-5 h-5 rtl:-scale-x-100 fill-current" stroke-width="1.5" viewBox="0 0 24 24">
                        <path
                        d="M13.775,18.707,8.482,13.414a2,2,0,0,1,0-2.828l5.293-5.293,1.414,1.414L9.9,12l5.293,5.293Z" />
                        </svg>
                    --}}
                    Prev
                </button>
            </li>

            @for ($i = $firstPage; $i <= $lastPage; $i++)
                <li class="page-item">
                    <button {{ $i == $paginator->currentPage() ? 'disabled=1' : '' }}
                        class="{{ $i == $paginator->currentPage() ? 'cursor-not-allowed !bg-gray-200 dark:!bg-gray-800' : '' }} flex w-1/2 items-center justify-center gap-x-2 rounded-md border bg-white px-5 py-2 text-sm capitalize text-gray-700 transition-colors duration-200 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 sm:w-auto"
                        onclick="paginate({{ $i }})">
                        {{ $i }}
                    </button>
                </li>
            @endfor

            <li class="page-item">
                <button id="next_button"
                    class="{{ $paginator->onLastPage() ? 'cursor-not-allowed' : '' }} flex w-1/2 items-center justify-center gap-x-2 rounded-md border bg-white px-5 py-2 text-sm capitalize text-gray-700 transition-colors duration-200 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 sm:w-auto"
                    onclick="paginate({{ $nextPage }})" {{ $paginator->onLastPage() ? 'disabled=1' : '' }}>
                    {{--
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1"
                        class="w-5 h-5 rtl:-scale-x-100 fill-current" stroke-width="1.5" viewBox="0 0 24 24">
                        <path
                        d="M10.811,18.707,9.4,17.293,14.689,12,9.4,6.707l1.415-1.414L16.1,10.586a2,2,0,0,1,0,2.828Z" />
                        </svg>
                    --}}
                    Next
                </button>
            </li>
            @if ($nextPage < $paginator->lastPage())
                <li class="page-item">
                    <button
                        class="flex w-1/2 items-center justify-center gap-x-2 rounded-md border bg-white px-5 py-2 text-sm capitalize text-gray-700 transition-colors duration-200 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800 sm:w-auto"
                        onclick="paginate({{ $paginator->lastPage() }})">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1"
                            class="h-5 w-5 rtl:-scale-x-100" stroke-width="1.5" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="m13.279,18.342l-.707-.707,5.281-5.281c.095-.095.146-.22.146-.354s-.052-.259-.146-.354l-5.281-5.281.707-.707,5.281,5.281c.283.283.439.66.439,1.061s-.156.777-.439,1.061l-5.281,5.281Zm-1.475-5.871c.26-.26.26-.683,0-.942l-5.871-5.871-.707.707,5.635,5.635-5.635,5.635.707.707,5.871-5.871Z" />
                        </svg>
                    </button>
                </li>
            @endif
        </ul>
    </div>
</div>

<script type="module">
    $(document).ready(function() {
        $('#pageCount').val(
            document.location.search.includes('paginate') ?
            new URLSearchParams(document.location.search).get('paginate') :
            10,
        );
    });
</script>

<script>
    function paginate(targetPage) {
        let url = new URL(document.location.href);

        url.searchParams.set('page', targetPage);

        const pageCount = document.querySelector('#pageCount').value;
        url.searchParams.set('paginate', pageCount);

        if ({{ $paginator->currentPage() }} > Math.ceil({{ $paginator->total() }} / pageCount)) {
            url = url.replace(/page=\d+/, 'page=' + Math.ceil({{ $paginator->total() }} / pageCount));
        }

        $.ajax({
            url: url,
            beforeSend: window.Loading.showLoading,
            success: function(res) {
                let parser = new DOMParser();
                let doc = parser.parseFromString(res, 'text/html');
                $('body').html(doc.body.innerHTML);
                window.history.pushState({
                        html: res.html,
                        pageTitle: res.pageTitle,
                    },
                    '',
                    url,
                );
            },
        });
    }
</script>
