<x-crud>
    <x-slot:table>
        <x-tables.users :records="$records" />
    </x-slot:table>
    <x-slot:form>
        <x-forms.users />
    </x-slot:form>
</x-crud>