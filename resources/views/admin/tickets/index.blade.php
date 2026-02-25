<x-crud>
    <x-slot:table>
        <x-tables.tickets :records="$records" />
    </x-slot:table>
    <x-slot:form>
        <x-forms.tickets />
    </x-slot:form>
</x-crud>