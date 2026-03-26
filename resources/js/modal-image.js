const imageGalleryContainer = document.querySelector('.modal-image');
let uploadImageContainer = null
let image = null


document.addEventListener('openGallery', (event) => {

	uploadImageContainer = event.detail.uploadImageContainer
	image = event.detail.image

	if (image?.getAttribute('src')) {
		imageGalleryContainer.querySelector('.image.selected')?.classList.remove('selected')
		imageGalleryContainer.querySelector('.image[data-filename="' + image.getAttribute('src').split('/').pop() + '"]').classList.add('selected')
		imageGalleryContainer.querySelector('.select-image-button').classList.add('active')
		imageGalleryContainer.querySelector('input[name="alt"]').value = image.getAttribute('alt')
		imageGalleryContainer.querySelector('input[name="title"]').value = image.getAttribute('title')
	}

	imageGalleryContainer.classList.remove('active')
})
imageGalleryContainer?.addEventListener('click', async (event) => {

  if (event.target.closest('.closeModalImage')) {
    imageGalleryContainer.classList.add('active')
		imageGalleryContainer.querySelector('.image.selected')?.classList.remove('selected')
		imageGalleryContainer.querySelector('input[name="alt"]').value = ''
		imageGalleryContainer.querySelector('input[name="title"]').value = ''
		imageGalleryContainer.querySelector('.select-image-button').classList.remove('active')
		uploadImageContainer = null
  }

   if (event.target.closest('.delete-button-modal')) {
    const endpoint = event.target.closest('.delete-button-modal').dataset.endpoint

    const result = await fetch(`${endpoint}`, {
      method: 'DELETE',
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
      }
    })

    const data = await result.json()
    imageGalleryContainer.innerHTML = data.imageGallery
  }

  if (event.target.closest('.image')) {
    imageGalleryContainer.querySelector('.image.selected')?.classList.remove('selected')
    event.target.closest('.image').classList.add('selected')
    imageGalleryContainer.querySelector('.select-image-button').classList.add('active')			
	}

  if (event.target.closest('.select-image-button')) {
    let targetImageContainer = null;

    if(uploadImageContainer.dataset.quantity === 'multiple'){
      if(image?.getAttribute('src')){
        image.src = imageGalleryContainer.querySelector('.image.selected').getAttribute('src')
        image.alt = imageGalleryContainer.querySelector('input[name="alt"]').value
        image.title = imageGalleryContainer.querySelector('input[name="title"]').value
        targetImageContainer = image.closest('.upload-image');
      }else{
        const clone = uploadImageContainer.querySelector('.upload-image').cloneNode(true)
        clone.classList.remove('hidden')
        clone.classList.add('active')
        clone.querySelector('img').src = imageGalleryContainer.querySelector('.image.selected').getAttribute('src')
        clone.querySelector('img').alt = imageGalleryContainer.querySelector('input[name="alt"]').value
        clone.querySelector('img').title = imageGalleryContainer.querySelector('input[name="title"]').value
        uploadImageContainer.appendChild(clone)
        targetImageContainer = clone;
      }
    }else{
      const item = uploadImageContainer.querySelector('.upload-image')
      item.classList.remove('hidden')
      item.classList.add('active')
      item.querySelector('img').src = imageGalleryContainer.querySelector('.image.selected').getAttribute('src')
      item.querySelector('img').alt = imageGalleryContainer.querySelector('input[name="alt"]').value
      item.querySelector('img').title = imageGalleryContainer.querySelector('input[name="title"]').value
      targetImageContainer = item;
    }

    if (targetImageContainer) {
      if (targetImageContainer.querySelector('svg')) {
        targetImageContainer.querySelector('svg').classList.add('hidden')
      }
      if (targetImageContainer.querySelector('img')) {
        targetImageContainer.querySelector('img').classList.remove('hidden')
      }
    }

    imageGalleryContainer.querySelector('.select-image-button').classList.remove('active')
    imageGalleryContainer.querySelector('.image.selected').classList.remove('selected')
    imageGalleryContainer.querySelector('input[name="alt"]').value = ''
    imageGalleryContainer.querySelector('input[name="title"]').value = ''
    imageGalleryContainer.classList.add('active')
    uploadImageContainer = null

  }
})

imageGalleryContainer?.addEventListener('change', async (event) => {
  if(event.target.closest('.upload-image-input')){
    try {
      const endpoint = event.target.closest('.upload-image-input').dataset.endpoint
      const image = event.target.files[0]

      const formData = new FormData()
      formData.append('image', image)

      const result = await fetch(endpoint, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
      })

      const data = await result.json()
      imageGalleryContainer.innerHTML = data.imageGallery
      imageGalleryContainer.querySelector('.select-image-button').classList.add('active')

    } catch (error) {
      console.error(error)
    }
  }
})