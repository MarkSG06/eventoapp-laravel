@props([
'form',
'record' => null,
'locale' => '',
'name',
'label',
'type' => 'text',
'width' => 'full-width',
'value' => '',
'inputAttributes' => [],
])

@php
if ($record) $value = $record[$name . '.' . $locale] ?? $record->{$name} ?? '';
if ($locale) $name = 'locale[' . $name . '.' . $locale . ']';
@endphp

<div class="fieldGroup {{ $width }}">
  <label for="{{ $form }}-{{ $name }}">{{ $label }}</label>
  <input type="{{ $type }}" name="{{ $name }}" id="{{ $form }}-{{ $name }}" value="{{ $value }}"
    @foreach($inputAttributes as $key=> $value)
  {{ $key }}="{{ $value }}"
  @endforeach
  >
</div>