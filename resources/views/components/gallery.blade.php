@props(['ticket'])
@php
	$locale = app()->getLocale();
@endphp
<style>
	.galleryContent {
		margin: auto;
	}

	.galleryContent h3 {
		font-size: 2rem;
		font-weight: 700;
		margin: 40px 0 20px;
		text-align: center;
		color: #1f2937;
	}

	.gallery {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 1rem;
	}
	.gallery img {
		margin: auto;
		width: 200px;
		object-fit: cover;
	}
</style>
<section class="galleryContent">
	<h3>Galeria</h3>
	<div class="gallery">
		@foreach($ticket->images[$locale]['thumbnail']['gallery'] as $index => $image)
			<div class="image-element" data-original-filename="{{ $image['originalFilename'] }}">
				<img
					srcset="
						{{ route('image', ['entity' => 'tickets', 'entityId' => $ticket->id, 'filename' => $ticket->images[$locale]['xs']['gallery'][$index]['filename']]) }} 480w,
						{{ route('image', ['entity' => 'tickets', 'entityId' => $ticket->id, 'filename' => $image['filename']]) }} 768w
					"
					sizes="(max-width: 480px) 25vw, 15vw"
					src="{{ $image['filename'] ? route('image', ['entity' => 'tickets', 'entityId' => $ticket->id, 'filename' => $image['filename']]) : '' }}"
					alt="{{ $image['alt'] }}"
					title="{{ $image['title'] }}"
				>
			</div>
		@endforeach
	</div>
</section>
