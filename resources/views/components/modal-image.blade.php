<?php

$images = $images ?? [];

?>

<div class="container">
	<div class="headerContainer">
		<h1>Biblioteca</h1>			
		<div class="closeModal">
			<svg class="closeModalImage" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/></svg>
		</div>
	</div>
	<div class="modal-content">
		<div class="modal-images-container">
			<label for="image" class="upload-image">
				<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8v2H5v14h14v-7h2v7q0 .825-.587 1.413T19 21zm1-4h12l-3.75-5l-3 4L9 13zm12-7V5.825L16.4 7.4L15 6l4-4l4 4l-1.4 1.4L20 5.825V10z"/></svg>
			</label>
			<input data-endpoint="{{ route('images_store') }}" class="upload-image-input" type="file" name="image" id="image" hidden>
			@foreach ($images as $image)
				<div class="image-item">
					<img 
						class="image" 
						src="{{ route('images_thumb', $image->filename) }}" 
						data-filename="{{ route('images_thumb', $image->filename) }}"
						alt="{{ $image->alt }}"
						title="{{ $image->title }}"
					>

					<button class="delete-button disabled" data-endpoint="{{ route('images_destroy', $image->filename) }}">
						X
					</button>
				</div>
			@endforeach
		</div>
		<div class="modal-image-create">
			<input type="text" name="alt" placeholder="Alt">
			<input type="text" name="title" placeholder="Título">
			<button type="button" class="select-image-button">Seleccionar</button>
		</div>
	</div>
	
</div>