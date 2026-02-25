export default (() => {

  const tableSection = document.querySelector('.table');
  if (!tableSection) return;

  const baseEndpoint = '/admin/usuarios';

  document.addEventListener("refreshTable", event => {
    if (!event.detail?.table) return;
    tableSection.innerHTML = event.detail.table;
  });

  tableSection.addEventListener('click', async (event) => {

    const box = event.target.closest('.table-box__data');
    if (box) {

      const id = box.dataset.id;
      if (!id) return;

      const endpoint = `${baseEndpoint}/${id}/edit`;

      try {
        const response = await fetch(endpoint, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
          method: 'GET',
        });

        if (!response.ok) throw response;

        const json = await response.json();

        document.dispatchEvent(new CustomEvent('refreshForm', {
          detail: { form: json.form }
        }));

      } catch (error) {

        document.dispatchEvent(new CustomEvent('notification', {
          detail: {
            message: 'Error al cargar usuario',
            type: 'error'
          }
        }));
      }

      return;
    }

  });

})();