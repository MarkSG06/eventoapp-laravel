@props([
'records',
])

<div class="table__footer">
  <div class="table__footer-box">
    <div class="table-page-info">
      <span>{{trans_choice('admin/pagination.total', $records->total(), ['count' => $records->total()])}}</span>
    </div>
    <div class="buttonPages">
      @if (!$records->onFirstPage())
      <div class="pagination-button" data-pagination="{{$records->previousPageUrl()}}">
        <button>
          <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <path
                d="M6 4a1 1 0 011 1v10a1 1 0 11-2 0V5a1 1 0 011-1zm7.219.376a1 1 0 111.562 1.249L11.28 10l3.5 4.375a1 1 0 11-1.562 1.249l-4-5a1 1 0 010-1.25l4-5z">
              </path>
            </g>
          </svg>
        </button>
      </div>
      @endif

      <div class="pagination-button {{ $records->currentPage() == 1 ? 'active' : '' }}"
        data-pagination="{{$records->url(1)}}">
        <button>1</button>
      </div>

      @if($records->currentPage() > 2 && $records->lastPage() > 2)
      <div class="table-pagination-ellipsis">
        <span>...</span>
      </div>
      @endif

      @if(!in_array($records->currentPage(), [1, $records->lastPage()]))
      <div class="pagination-button-disabled active">
        <button>{{ $records->currentPage() }}</button>
      </div>
      @endif

      @if($records->currentPage() < $records->lastPage() - 1 && $records->lastPage() > 2)
        <div class="table-pagination-ellipsis">
          <span>...</span>
        </div>
        @endif

        @if($records->lastPage() > 1)
        <div class="pagination-button {{ $records->currentPage() == $records->lastPage() ? 'active' : '' }}"
          data-pagination="{{$records->url($records->lastPage())}}">
          <button>{{ $records->lastPage() }}</button>
        </div>
        @endif

        @if ($records->hasMorePages())
        <div class="pagination-button" data-pagination="{{$records->nextPageUrl()}}">
          <button>
            <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path
                  d="M14 4a1 1 0 011 1v10a1 1 0 11-2 0V5a1 1 0 011-1zm-7.219.376l4 5a1 1 0 010 1.249l-4 5a1 1 0 11-1.562-1.25l3.5-4.374-3.5-4.376a1 1 0 111.562-1.25z">
                </path>
              </g>
            </svg>
          </button>
        </div>
        @endif
    </div>
  </div>
</div>