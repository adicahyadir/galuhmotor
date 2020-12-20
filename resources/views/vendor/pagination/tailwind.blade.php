@if ($paginator->hasPages())
    <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800" >
        <span class="flex items-center col-span-3"> Showing {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} of {{ $paginator->total() }} </span>
        <span class="col-span-2"></span>
        <!-- Pagination -->
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">
                    {{-- Previous Page Link --}}
                    <li>
                        @if ($paginator->onFirstPage())
                            <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple cursor-default" aria-label="{{ __('pagination.previous') }}">
                        @else
                            <button onclick="window.location.href='{{ $paginator->previousPageUrl() }}'" rel="prev" class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="{{ __('pagination.previous') }}">
                        @endif
                            <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20" >
                                <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </li>

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li>
                                <span class="px-3 py-1">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <li>
                                    @if ($page == $paginator->currentPage())
                                        <button class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">{{ $page }}</button>
                                    @else
                                        <button onclick="window.location.href='{{ $url }}'" class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">{{ $page }}</button>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                    {{-- Next Page Link --}}
                    <li>
                        @if ($paginator->hasMorePages())
                            <button onclick="window.location.href='{{ $paginator->nextPageUrl() }}'" rel="next" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="{{ __('pagination.next') }}">
                        @else
                            <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple cursor-default" aria-label="{{ __('pagination.next') }}">
                        @endif
                            <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </li>
                </ul>
            </nav>
        </span>
    </div>
@endif
