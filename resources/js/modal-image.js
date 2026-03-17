export default (() => {
	const imageGalleryContainer = document.querySelector('.modal-image');

	document.addEventListener('click', (event) => {
		if (event.target.closest('button[type="button"]')) {
			imageGalleryContainer.classList.remove('hidden');
		}
	});

	imageGalleryContainer?.addEventListener('click', async (event) => {
		if (event.target.closest('.closeModalImage')) {
			imageGalleryContainer.classList.add('hidden');
		}

		// if (event.target.closest('.upload-image')) {
		// 	document.querySelector('.upload-image-input').click()
		// 	console.log('hola')

		// }

		if (event.target.closest('.delete-button')) {
			const endpoint = event.target.closest('.delete-button').dataset.endpoint

			const result = await fetch(`${endpoint}`, {
				method: 'DELETE',
				headers: {
					'Accept': 'application/json',
					'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
				}
			})

			console.log(result)

			const data = await result.json()
			imageGalleryContainer.innerHTML = data.imageGallery
		}
	})

	document.querySelector('.upload-image-input').addEventListener('change', async (event) => {
		try {
			const endpoint = document.querySelector('.upload-image-input').dataset.endpoint
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

		} catch (error) {
			console.error(error)
		}
	})
})();