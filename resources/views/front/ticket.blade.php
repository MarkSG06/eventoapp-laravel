<x-layouts.public :languages="$languages">
    <section class="ticket">
        <h1>{{ $ticket->locale[app()->getLocale()]['title'] }}</h1>
        <span>{{ $ticket->fiscal_name }}</span>
        <p>Fecha y hora: {{ $ticket->datetime }}</p>
        <p>Número de ticket: {{ $ticket->ticket_number }}</p>
        <p>Notas: {{ $ticket->locale[app()->getLocale()]['notes'] }}</p>
    </section>
</x-layouts.public>