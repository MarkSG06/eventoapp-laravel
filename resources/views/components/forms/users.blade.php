@vite(['resources/js/form.js'])
@props([
'records' => [],
])
<section class="rightPanel">
  <div class="form">
    <div class="toolbar">
      <div class="tabs">
        <div class="tab active-tab" data-tab="general">
          <span>General</span>
        </div>
      </div>
      <div class="toolbarSVGs">
        <div class="button clean-button">
          <span class="tooltip">Limpiar</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" viewBox="0 0 24 24">
            <path fill="none" stroke="#000000" stroke-width="2" d="M10,4 C10,2.8954305 10.8954305,2 12,2 C13.1045695,2 14,2.8954305 14,4 L14,10 L20,10 L20,14 L4,14 L4,10 L10,10 L10,4 Z 
                    M4,14 L20,14 L20,22 L12,22 L4,22 L4,14 Z 
                    M16,22 L16,16.3646005 M8,22 L8,16.3646005 M12,22 L12,16.3646005" />
          </svg>
        </div>
        <div class="button save-button">
          <span class="tooltip">Guardar</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" viewBox="0 0 32 32">
            <path fill="none" stroke="#000000" stroke-width="2" d="M4 4 H28 V28 H4 Z
                    M10 4 V12 H22 V4
                    M10 28 V20
                    M16 28 V20
                    M22 28 V20" />
          </svg>
        </div>
        <div class="button delete-icon">
          <span class="tooltip">Eliminar</span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
          </svg>
        </div>
      </div>
    </div>
    <div class="sectionMain">
      <div class="validation-errors">
        <p>Error en la validación, revisa los siguientes errores: </p>
        <ul></ul>
        <div class="button close-validation-errors">
          <span class="tooltip">Cerrar</span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
              d="M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22C17.53,22 22,17.53 22,12C22,6.47 17.53,2 12,2M14.59,8L12,10.59L9.41,8L8,9.41L10.59,12L8,14.59L9.41,16L12,13.41L14.59,16L16,14.59L13.41,12L16,9.41L14.59,8Z" />
          </svg>
        </div>
      </div>
      <form>
        <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
        <div class="tab-content active" data-tab="general">
          <div class="fieldGroup">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ $user->name ?? '' }}">
          </div>
          <div class="fieldGroup">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="{{ $user->email ?? '' }}">
          </div>
          <div class="fieldGroup">
            <label>Password</label>
            <input type="password" name="password">
          </div>

          <div class="fieldGroup">
            <label>Confirmar Password</label>
            <input type="password" name="password_confirmation">
          </div>
        </div>
      </form>
    </div>
  </div>
</section>