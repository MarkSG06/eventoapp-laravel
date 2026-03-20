@php
  $filename = $filename ?? null;
@endphp

<div class="modal-image">
  <div class="modal-image-content">
    <div class="modal-image-header">
      <h2>Galería</h2>
      <span class="close">&times;</span>
    </div>
    <div class="modal-image-body">
      <div class="modal-images-container">
        <div class="modal-image-upload">
          <label for="image">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M9,16V10H5L12,3L19,10H15V16H9M5,20V18H19V20H5Z" /></svg>
          </label>
          <input class="modal-image-upload-input" type="file" name="image" data-endpoint="{{ route('images_store') }}" />
        </div>
        @foreach($images as $image)
          <div class="image {{ $image->filename == $filename ? 'selected' : '' }}" data-filename="{{ $image->filename }}">
            <img src="{{ route('images_thumb', $image->filename) }}" />
            <button class="delete-button" data-endpoint="{{ route('images_destroy', $image->filename) }}">X</button>
          </div>
        @endforeach
      </div>
      <div class="modal-image-loader">
        <div class="modal-image-loader-form">
          <div class="modal-image-loader-form">
            <label for="title">Título</label>
            <input type="text" name="title" />
          </div>
          <div class="modal-image-loader-form">
            <label for="description">Texto alternativo</label>
            <input type="text" name="alt" />
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="select-image-button">Elegir imagen</button>
    </div>
  </div>
</div>
