import store from './redux/store';
import { setTable } from './redux/crud-slice';
export default (() => {

  const tableSection = document.querySelector('.crud-table');

  tableSection?.addEventListener('click', async (event) => {

    if (event.target.closest('.pagination-button')){
      const paginationButton = event.target.closest('.pagination-button')

      if(paginationButton.classList.contains('inactive')){
        return
      }

      try{
        
        let endpoint = paginationButton.dataset.pagination

        const response = await fetch(endpoint, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
          },
          method: 'GET',
        })

        if (response.status === 500) {
          throw response
        }
        const json = await response.json()
        store.dispatch(setTable(json.table))

      }catch(error){

        const json = await error.json()

        document.dispatchEvent(new CustomEvent('notification', {
          detail: {
            message: json.message,
            type: 'error'
          }
        }))
      }
    }
  });
})();
