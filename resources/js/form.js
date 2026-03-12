import store from './redux/store';
import { setForm, setTable } from './redux/crud-slice';

export default (() => {

  const formSection = document.querySelector('.crud-form');
  let form = null

  function updateDestroyButton() {
    const destroyButton = document.querySelector('.destroy-button');
    const idInput = document.querySelector('input[name="id"]');

    const id = idInput?.value || "";

    if (id && id !== "0") {
      destroyButton.classList.remove('hidden');
    } else {
      destroyButton.classList.add('hidden');
    }
  }
  
  store.subscribe(() => {
    const currentState = store.getState()

    if (currentState.crud.form !== form) {
      formSection.innerHTML = currentState.crud.form
      form = currentState.crud.form

      updateDestroyButton()
    }
  })

  formSection?.addEventListener('click', async (event) => {

    if (event.target.closest('.store-button')) {

      const storeButton = event.target.closest('.store-button')
      const endpoint = storeButton.dataset.endpoint;
      const form = document.querySelector('.admin-form');
      const formData = new FormData(form);

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
          const json = await response.json();
          store.dispatch(setTable(json.table))
          store.dispatch(setForm({form: json.form, formElementEndpoint: null}))
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

      const createButton = event.target.closest('.create-button')
      const endpoint = createButton.dataset.endpoint;

      try {
        const response = await fetch(endpoint, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
          },
          method: 'GET',
        })

        if (response.status === 500 || response.status === 422) {
          throw response
        }

        if (response.status === 200) {
          const json = await response.json();
          store.dispatch(setForm({form: json.form, formElementEndpoint: endpoint}))
        }

      } catch (error) {
        console.error(error)
      }
    }

    if (event.target.closest('.destroy-button')) {

      const modalDelete = document.querySelector('.modal-destroy');
      modalDelete.classList.add('active');    
      
    }


  });

})();
