import store from './redux/store';
import { setForm, setTable } from './redux/crud-slice';

export default (() => {

  const formSection = document.querySelector('.crud-form');
  let form = null
  
  store.subscribe(() => {
    const currentState = store.getState()

    if (currentState.crud.form !== form) {
      formSection.innerHTML = currentState.crud.form
      form = currentState.crud.form
    }
  })

  formSection?.addEventListener('click', async (event) => {
    if (event.target.closest('.store-button')) {

      const storeButton = event.target.closest('.store-button')
      const endpoint = storeButton.dataset.endpoint;
      const form = document.querySelector('.admin-form');
      const formData = new FormData(form);

      if(formSection.querySelector('.upload-image-container')){
        const images = []
        const uploadImageContainers = formSection.querySelectorAll('.upload-image-container')

        uploadImageContainers.forEach(uploadImageContainer => {

          const image = {
            name: uploadImageContainer.dataset.name,
            languageAlias: uploadImageContainer.dataset.language,
            imageConfigurations: JSON.parse(uploadImageContainer.dataset.configuration),
            files: []
          }

          uploadImageContainer.querySelectorAll('img').forEach(img => {
            if(img.getAttribute('src')){
              image.files.push({
                filename: img.getAttribute('src').split('/').pop(),
                alt: img.getAttribute('alt'),
                title: img.getAttribute('title')
              })
            }
          })

          images.push(image)
        })

        formData.append('images', JSON.stringify(images))
      }

      try{
        const response = await fetch(endpoint, {
          headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
          },
          method: 'POST',
          body: formData
        })
  
        if (response.status === 500 || response.status === 422) {
          throw response
        }
  
        if (response.status === 200) {  
  
          const json = await response.json()

          store.dispatch(setTable(json.table))
          store.dispatch(setForm(json.form))

          document.dispatchEvent(new CustomEvent('notification', {
            detail: {
              message: json.message,
              type: 'success'
            }
          }))
        }

      }catch(error){

        if (error.status === 422) {

          const json = await error.json();

          document.dispatchEvent(new CustomEvent('showformValidations', {
            detail: {
              formValidation: form.previousElementSibling,
              errors: json.errors
            }
          }))
        }

        if (error.status === 500) {

          const json = await error.json();

          document.dispatchEvent(new CustomEvent('notification', {
            detail: {
              message: json.message,
              type: 'error'
            }
          }))
        }
      }
    }

    if (event.target.closest('.create-button')) {

      const cleanButton = event.target.closest('.create-button')
      const endpoint = cleanButton.dataset.endpoint;

      try{
        const response = await fetch(endpoint, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
          },
          method: 'GET',
        })
  
        if (response.status === 500) {
          throw response
        }
  
        if (response.status === 200) {  
          const json = await response.json()
          store.dispatch(setForm(json.form))
        }
      }catch(error){
        document.dispatchEvent(new CustomEvent('notification', {
          detail: {
            message: 'La acción no se pudo completar por un fallo en el servidor.',
            type: 'error'
          }
        }))
      }
    }

    if (event.target.closest('.destroy-button')) {
      const modalDelete = document.querySelector('.modal-destroy');
      modalDelete.classList.add('active');    
    }

		if (event.target.closest('.upload-image-container .delete-button')) {
			event.preventDefault()

			const uploadImage = event.target.closest('.upload-image-container .delete-button').parentElement

			uploadImage.querySelector('img').src = ''
			uploadImage.querySelector('img').alt = ''
			uploadImage.querySelector('img').title = ''
			uploadImage.classList.add('hidden')
			uploadImage.classList.remove('active')

			return
		}

		if (event.target.closest('.upload-image-container')) {
      event.preventDefault();

			let image = null;
			if (event.target.closest('.upload-image')) {
				image = event.target.closest('.upload-image').querySelector('img');
			}

      document.dispatchEvent(new CustomEvent('openGallery', {
        detail: {
          uploadImageContainer: event.target.closest('.upload-image-container'),
          image: image
        }
      }))
    }
		
		if (event.target.closest('.square-button')) {
			event.preventDefault();
			const uploadImageContainer = event.target.closest('.upload-image-container')
			const image = uploadImageContainer.querySelector('img')

			document.dispatchEvent(new CustomEvent('openGallery', {
				detail: {
					uploadImageContainer: uploadImageContainer,
					image
				}
			}))
		}
		
  });
	
	formSection?.addEventListener('input', async (event) => {
    if (event.target.closest('[type="range')) {

      const inputRange = event.target.closest('[type="range');
      const rangeValue = inputRange.parentElement.querySelector('.range-value');

      rangeValue.innerText = inputRange.value
    }
  });
})();