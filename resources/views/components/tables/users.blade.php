@props([
'records' => [],
])
@vite(['resources/js/table.js'])
<section class="leftPanel">
  <section class="table">
    <div class="table__header">
      <div class="table__header-box">
        <button class="button filter-icon table__header-icon">
          <span class="tooltip">Filtrar</span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
              d="M12 12V19.88C12.04 20.18 11.94 20.5 11.71 20.71C11.32 21.1 10.69 21.1 10.3 20.71L8.29 18.7C8.06 18.47 7.96 18.16 8 17.87V12H7.97L2.21 4.62C1.87 4.19 1.95 3.56 2.38 3.22C2.57 3.08 2.78 3 3 3H17C17.22 3 17.43 3.08 17.62 3.22C18.05 3.56 18.13 4.19 17.79 4.62L12.03 12H12M17.75 21L15 18L16.16 16.84L17.75 18.43L21.34 14.84L22.5 16.25L17.75 21" />
          </svg>
        </button>
      </div>
    </div>
    <div class="table__body">
      @foreach($records as $record)
      <div class="table__body-box">
        <div class="table-box__data" data-id="{{ $record->id }}">
          <h3>{{ $record->name }}</h3>
          <p><span>Email:</span>{{ $record->email }}</p>
        </div>
      </div>
      @endforeach
    </div>
    <div class="table__footer">
      <div class="table__footer-box">
        <div class="table-page-info">
          {{ $records->count() }} registro(s).
        </div>
        <div class="buttonPages">
          <div class="button pagination-button disabled" data-page="1">
            <span class="tooltip">Principio</span>
            <svg viewBox="0 0 512 512" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path
                  d="M297.2,478l20.7-21.6L108.7,256L317.9,55.6L297.2,34L65.5,256L297.2,478z M194.1,256L425.8,34l20.7,21.6L237.3,256 l209.2,200.4L425.8,478L194.1,256z">
                </path>
              </g>
            </svg>
          </div>
          <div class="button pagination-button disabled">
            <span class="tooltip">Anterior</span>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
              viewBox="0 0 24 24" xml:space="preserve" transform="matrix(-1, 0, 0, 1, 0, 0)">
              <g id="SVGRepo_bgCarrier"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <g id="next">
                  <g>
                    <polygon points="6.8,23.7 5.4,22.3 15.7,12 5.4,1.7 6.8,0.3 18.5,12 ">
                    </polygon>
                  </g>
                </g>
              </g>
            </svg>
          </div>
          <div class="pages">
            <p>{{ $records->currentPage() }} / {{ $records->lastPage() }}</p>
          </div>
          <div class="button pagination-button disabled">
            <span class="tooltip">Siguiente</span>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
              viewBox="0 0 24 24" xml:space="preserve" transform="matrix(1, 0, 0, 1, 0, 0)">
              <g id="SVGRepo_bgCarrier"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <g id="next">
                  <g>
                    <polygon points="6.8,23.7 5.4,22.3 15.7,12 5.4,1.7 6.8,0.3 18.5,12 ">
                    </polygon>
                  </g>
                </g>
              </g>
            </svg>
          </div>
          <div class="button pagination-button disabled">
            <span class="tooltip">Final</span>
            <svg viewBox="0 0 512 512" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink" transform="matrix(-1, 0, 0, 1, 0, 0)">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path
                  d="M297.2,478l20.7-21.6L108.7,256L317.9,55.6L297.2,34L65.5,256L297.2,478z M194.1,256L425.8,34l20.7,21.6L237.3,256 l209.2,200.4L425.8,478L194.1,256z">
                </path>
              </g>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="deleteModal">
    <h2>¿Estás seguro de eliminar este usuario?</h2>
    <div class="deleteButtons">
      <div class="button deleteModal-button-cancel">
        <button>Cancelar</button>
      </div>
      <div class="button deleteModal-button-confirm">
        <button>Eliminar</button>
      </div>
    </div>
  </section>
</section>