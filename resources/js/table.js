import store from './redux/store';
import { setTable, setForm } from './redux/crud-slice';

export default (() => {

  const tableSection = document.querySelector('.crud-table')
  let table = null

  store.subscribe(() => {
    const currentState = store.getState()

    if (currentState.crud.table !== table) {
        tableSection.innerHTML = currentState.crud.table
        table = currentState.crud.table
    }
  })
  
  tableSection?.addEventListener('click', async (event) => {

    if (event.target.closest('.table__body')) {
      const editButton = event.target.closest('.table-box__data');
      const endpoint = editButton.dataset.endpoint;

      try {
          const response = await fetch(endpoint);
          const json = await response.json();
          store.dispatch(setForm({form: json.form, formElementEndpoint: endpoint}));
      } catch (error) { 
          console.log('Error en fetch:', error);
      }
    }

    if (event.target.closest('.table__header-icon')) {
      const filter = document.querySelector(".filter");
      filter.classList.add("active");
    }

    if (event.target.closest('.filter-cancel')) {
      const filter = document.querySelector(".filter");
      filter.classList.remove('active');
    }

    if(event.target.closest('.filter-confirm')) {
      const endpoint = event.target.closest('.filter-confirm').dataset.endpoint
      const form = document.querySelector('form.table-filter')
      const formData = new FormData(form)

      const queryString = new URLSearchParams(formData).toString()
      const url = endpoint + '?' + queryString

      const response = await fetch(url, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
        },
        method: 'GET',
      })

      const json = await response.json()
      store.dispatch(setTable(json.table))
    }

  });
})();
