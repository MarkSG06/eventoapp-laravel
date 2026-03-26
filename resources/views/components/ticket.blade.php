@props([
	'ticket'
])
@php
	$locale = app()->getLocale();
	\Debugbar::info('locale ' . $locale);
	\Debugbar::info('ticket ' . $ticket);
	
@endphp
<section class="ticket">
    <h1>{{ (isset($ticket->locale[$locale]['title'])) ? $ticket->locale[$locale]['title'] : '' }}</h1>
    <span>{{ $ticket->fiscal_name }}</span>
    <p>Fecha y hora: {{ $ticket->datetime }}</p>
    <p>Número de ticket: {{ $ticket->ticket_number }}</p>
    <p>Notas: {{ (isset($ticket->locale[$locale]['notes'])) ? $ticket->locale[$locale]['notes'] : '' }}</p>
		<x-gallery :ticket="$ticket" />
</section>