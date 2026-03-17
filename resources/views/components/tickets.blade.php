@props([
	'tickets'
])
<style>
	/* TITULO */
	h1 {
			font-size: 2.2rem;
			font-weight: 700;
			margin: 40px 0 20px;
			text-align: center;
			color: #1f2937;
	}

	/* CONTENEDOR */
	.tickets {
			width: 100%;
			max-width: 1200px;
			margin: auto;
			padding: 20px;

			display: grid;
			grid-template-columns: repeat(3, 1fr);
			gap: 25px;
	}

	/* TARJETA TICKET */
	.ticket {
			background: white;
			border-radius: 12px;
			padding: 20px;
			box-shadow: 0 8px 25px rgba(0,0,0,0.08);
			transition: all 0.25s ease;
			border: 1px solid #f1f1f1;

			display: flex;
			flex-direction: column;
			gap: 10px;
	}

	/* HOVER */
	.ticket:hover {
			transform: translateY(-5px);
			box-shadow: 0 14px 40px rgba(0,0,0,0.12);
	}

	/* NOMBRE EMPRESA */
	.ticket h2 {
			font-size: 1.4rem;
			font-weight: 600;
			color: #111827;
			margin-bottom: 8px;
	}

	/* TEXTO */
	.ticket p {
			font-size: 0.95rem;
			color: #4b5563;
			line-height: 1.5;
	}

	/* LINK */
	.ticket a {
			margin-top: 10px;
			align-self: flex-start;

			text-decoration: none;
			font-size: 0.9rem;
			font-weight: 600;

			color: white;
			background: #2563eb;
			padding: 8px 14px;
			border-radius: 6px;

			transition: background 0.2s ease;
	}

	/* HOVER LINK */
	.ticket a:hover {
			background: #1d4ed8;
	}

	/* RESPONSIVE */
	@media (max-width: 600px) {

			h1 {
					font-size: 1.8rem;
			}

			.tickets {
					padding: 10px;
					gap: 15px;
			}

			.ticket {
					padding: 16px;
			}

	}
</style>
<h1>Tickets:</h1>
<section class="tickets">
	@foreach ($tickets as $ticket)
		<div class="ticket">
			<h2>{{ $ticket->fiscal_name }}</h2>
			<p>Fecha y hora: {{ $ticket->datetime }}</p>
			<p>Número de ticket: {{ $ticket->ticket_number }}</p>
			<p>Notas: {{ $ticket->locale[app()->getLocale()]['notes'] }}</p>
			<a href="{{ route(app()->getLocale() . '.ticket', ['title' => $ticket->locale[app()->getLocale()]['title']]) }}">{{ __('front/tickets.view') }}</a>
		</div>
	@endforeach
</section>

