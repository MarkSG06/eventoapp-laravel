<x-crud>
    <x-slot name="table">
        <x-tables :tableStructure="$tableStructure" :records="$records" />
    </x-slot>

    <x-slot name="form">
        <x-forms :formStructure="$formStructure" :record="$record" />
    </x-slot>
</x-crud>