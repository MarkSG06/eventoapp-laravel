@props([
'columns' => [],
'records' => [],
'endpoint' => null
])

<div class="table__body">
  @if (count($records) == 0)
  <div class="table-no-records">
    <p>No hay registros</p>
  </div>
  @endif
  @foreach ($records as $record)
  <article class="table__body-box">
    <div class="table-box__data" data-endpoint={{route($endpoint, $record->id)}}>
      <ul>
        @foreach($columns as $column => $label)
        <li><span>{{ $label }}: </span>{{ $record->{$column} }}</li>
        @endforeach
      </ul>
    </div>
  </article>
  @endforeach
</div>