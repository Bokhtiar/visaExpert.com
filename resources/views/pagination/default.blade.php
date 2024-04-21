@if($paginator->hasPages())
    <div class="d-flex justify-content-end">
        <div class="pagination-wrap hstack gap-2">

            @if($paginator->onFirstPage())
                <a class="page-item pagination-prev disabled" href="javascrpit:void(0)">
                    Previous
                </a>
            @else
                <a class="page-item pagination-prev" href="{{ $paginator->previousPageUrl() }}">
                    Previous
                </a>
            @endif

            <ul class="pagination listjs-pagination mb-0">
                @foreach($elements as $element)
                    @if(is_string($element))
                        <li class="disabled">
                            <a class="page" href="javascript:void(0)">
                                {{ $element }}
                            </a>
                        </li>
                    @endif

                    @if(is_array($element))
                        @foreach ($element as $page=>$url)
                            @if($page == $paginator->currentPage())
                                <li class="active">
                                    <a class="page-link" href="javascript:void(0)">
                                        {{$page}}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="page" href="{{$url}}">{{$page}}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif

                @endforeach
            </ul>

            @if($paginator->hasMorePages())
                <a class="page-item pagination-next" href="{{ $paginator->nextPageUrl() }}">
                    Next
                </a>
            @else
                <a class="page-item pagination-next disabled" href="javascript:void(0);">
                    Next
                </a>
            @endif
        </div>
    </div>
@endif
