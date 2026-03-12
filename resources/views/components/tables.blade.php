@props([
'tableStructure' => [],
'records' => [],
])

@if(in_array('filterButton', $tableStructure['tableButtons']))
<x-table-filter :filters="$tableStructure['filters']" :endpoint="$tableStructure['endpoint']" />
@endif

<x-table-buttons :tableButtons="$tableStructure['tableButtons']" />

<x-table-records :records="$records" :columns="$tableStructure['columns']"
  :endpoint="$tableStructure['elementEndpoint']" />

<x-table-pagination :records="$records" :endpoint="$tableStructure['endpoint']" />