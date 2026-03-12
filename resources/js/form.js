export default (() => {

  const formSection = document.querySelector('.form');
  if (!formSection) return;

  const baseEndpoint = '/admin/usuarios';
  let currentDeleteEndpoint = null;

  document.addEventListener("refreshForm", event => {
    if (!event.detail?.form) return;
    formSection.innerHTML = event.detail.form;
  });

  formSection.addEventListener('click', async (event) => {
    /* =========================
       SAVE (POST / PUT)
    ========================== */

    if (event.target.closest('.save-button')) {

      const form = formSection.querySelector('form');
      if (!form) return;

      const formData = new FormData(form);
      const data = Object.fromEntries(formData.entries());

      let endpoint = baseEndpoint;
      let method = 'POST';

      if (data.id) {
        endpoint = `${baseEndpoint}/${data.id}`;
        method = 'PUT';
      }

      try {

        const response = await fetch(endpoint, {
          method: method,
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify(data)
        });

        if (response.status === 422) {
          const json = await response.json();
          console.log(json.errors);
          return;
        }

        if (!response.ok) throw response;

        const json = await response.json();

        document.dispatchEvent(new CustomEvent('refreshTable', {
          detail: { table: json.table }
        }));

        document.dispatchEvent(new CustomEvent('notification', {
          detail: {
            message: 'Guardado correctamente',
            type: 'success'
          }
        }));

        form.reset();

      } catch (error) {

        document.dispatchEvent(new CustomEvent('notification', {
          detail: {
            message: 'Error al guardar',
            type: 'error'
          }
        }));
      }
    }

    /* =========================
       DELETE (abrir modal)
    ========================== */

    if (event.target.closest('.create-button')) {

      const form = formSection.querySelector('form');
      const id = form?.querySelector('[name="id"]')?.value;

      if (!id) {
        document.dispatchEvent(new CustomEvent('notification', {
          detail: {
            message: 'Selecciona un usuario primero',
            type: 'error'
          }
        }));
        return;
      }

      currentDeleteEndpoint = `${baseEndpoint}/${id}`;
      document.querySelector('.deleteModal').style.display = 'flex';
    }

    /* =========================
       CONFIRM DELETE
    ========================== */

    if (event.target.closest('.deleteModal-button-confirm')) {

      if (!currentDeleteEndpoint) return;

      try {

        const response = await fetch(currentDeleteEndpoint, {
          method: 'DELETE',
          headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        });

        if (!response.ok) throw response;

        document.dispatchEvent(new CustomEvent('refreshTable'));

        document.dispatchEvent(new CustomEvent('notification', {
          detail: {
            message: 'Usuario eliminado correctamente',
            type: 'success'
          }
        }));

        const form = formSection.querySelector('form');
        form?.reset();

        document.querySelector('.deleteModal').style.display = 'none';
        currentDeleteEndpoint = null;

      } catch (error) {

        document.dispatchEvent(new CustomEvent('notification', {
          detail: {
            message: 'No se pudo eliminar el usuario',
            type: 'error'
          }
        }));
      }
    }

    /* =========================
       CANCEL DELETE
    ========================== */

    if (event.target.closest('.deleteModal-button-cancel')) {
      document.querySelector('.deleteModal').style.display = 'none';
      currentDeleteEndpoint = null;
    }

    /* =========================
       CLEAN FORM
    ========================== */
    if (event.target.closest('.clean-button')) {
      formSection.querySelector('form').reset();
    }
  });
})();