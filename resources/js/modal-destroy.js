import store from './redux/store';
import { setTable, setForm } from './redux/crud-slice';

export default (() => {

  const modalSection = document.querySelector('.modal-destroy');

  modalSection?.addEventListener('click', async (event) => {

    if (event.target.closest('.destroy-cancel')) {
      modalSection.classList.remove('active');
    }

    if (event.target.closest('.destroy-confirm')) {
      const currentState = store.getState()
      
      const endpoint = currentState.crud.formElementEndpoint

      try{
        const response = await fetch(endpoint, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
          },
          method: 'DELETE',
        })
  
        if (response.status === 500) {
          throw response
        }
  
        if (response.status === 200) {  
          const json = await response.json();
          modalSection.classList.remove('active');
          store.dispatch(setTable(json.table))
          store.dispatch(setForm({form: json.form, formElementEndpoint: null}))
        }
      }catch(error){

      }
    }
  });
})();
