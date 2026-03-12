@props([
'formStructure' => [],
'record' => null,
])

<div class="toolbar">

  @if($formStructure['tabs'])
  <x-tabs :tabs="$formStructure['tabs']" />
  @endif

  <x-forms-buttons :formButtons="$formStructure['formButtons']" />
</div>

<x-form-validation />

<x-forms-generator :inputs="$formStructure['inputs']" :record="$record" />