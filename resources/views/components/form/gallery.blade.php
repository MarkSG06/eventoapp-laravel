@props([
  'form' => '',
  'label' => '',
  'locale' => '',
  'name' => '',
  'quantity' => '',
  'configuration' => [],
  'width' => '',
  'value'
])
<div class="fieldGroup {{ $width }}" style="margin-bottom: 1rem;">
    <label for="{{ $form }}-{{ $name }}">{{ $label }}</label>
    <div class="upload-image-container" data-name="{{ $name }}" data-language="{{ $locale }}" data-quantity="{{ $quantity }}" data-configuration="{{ json_encode($configuration) }}">
			@isset($value['files'])
				@foreach($value['files'] as $file)
					<div class="upload-image {{ $quantity }}">
						<img src="{{ route('images_thumb', $file['filename']) }}" alt="{{ $file['alt'] }}" title="{{ $file['title'] }}" >
						<button class="delete-button">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
							</svg>
						</button>
					</div>
				@endforeach
			@else
				<div class="upload-image {{ $quantity }} hidden">
					<svg xmlns="http://www.w3.org/2000/svg" width="60px" height="60px" viewBox="0 0 256 256"><path fill="currentColor" d="m210.83 85.17l-56-56A4 4 0 0 0 152 28H56a12 12 0 0 0-12 12v176a12 12 0 0 0 12 12h144a12 12 0 0 0 12-12V88a4 4 0 0 0-1.17-2.83M156 41.65L198.34 84H156ZM200 220H56a4 4 0 0 1-4-4V40a4 4 0 0 1 4-4h92v52a4 4 0 0 0 4 4h52v124a4 4 0 0 1-4 4m-45.17-78.83a4 4 0 0 1-5.66 5.66L132 129.66V184a4 4 0 0 1-8 0v-54.34l-17.17 17.17a4 4 0 0 1-5.66-5.66l24-24a4 4 0 0 1 5.66 0Z"/></svg>
					<img class="hidden" src="" alt="" title="" >
					<button class="delete-button">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
							<path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
						</svg>
					</button>
				</div>
			@endif
		</div>
</div>
