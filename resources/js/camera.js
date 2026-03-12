const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const botonFoto = document.getElementById('tomarFoto');
const loading = document.getElementById('loading');
const ticketEditorEl = document.getElementById('ticketEditor');
const ticketJson = document.getElementById('ticketJson');

let streamActivo = null;
let responseBody = null;
let editor = null;

/* =========================
   CAMARA
========================= */

async function encenderCamara ()
{
  if (streamActivo) return;

  try {
    streamActivo = await navigator.mediaDevices.getUserMedia({
      video: {
        facingMode: 'environment',
        width: { ideal: 4096 },
        height: { ideal: 2160 }
      },
      audio: false
    });

    video.srcObject = streamActivo;

  } catch (err) {
    console.error('No se pudo acceder a la cámara:', err);
  }
}

encenderCamara();


/* =========================
   MONACO INIT (UNA SOLA VEZ)
========================= */

function initMonaco ()
{
  return new Promise(resolve =>
  {

    if (editor) return resolve(editor);

    require.config({
      paths: { vs: 'https://unpkg.com/monaco-editor@0.47.0/min/vs' }
    });

    require(['vs/editor/editor.main'], function ()
    {

      editor = monaco.editor.create(ticketEditorEl, {
        value: '{\n  "waiting": true\n}',
        language: 'json',
        theme: 'vs-dark',
        fontSize: 14,
        automaticLayout: true,
        minimap: { enabled: false },
        formatOnPaste: true,
        formatOnType: true,
        tabSize: 2,
        insertSpaces: true
      });

      resolve(editor);
    });

  });
}


/* =========================
   CAPTURA + OCR
========================= */

botonFoto.addEventListener('click', async () =>
{

  if (!streamActivo) return;

  loading.style.display = 'flex';

  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;

  const ctx = canvas.getContext('2d');

  // filtro OCR fuerte
  ctx.filter = 'invert(1) grayscale(1) contrast(2)';
  ctx.drawImage(video, 0, 0);

  const base64Full = canvas.toDataURL('image/jpeg', 0.9);
  const base64 = base64Full.split(',')[1];

  try {

    const response = await fetch('/extract-data', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document
          .querySelector('meta[name="csrf-token"]')
          ?.getAttribute('content')
      },
      body: JSON.stringify({ image: base64 })
    });

    responseBody = await response.json();

    if (!response.ok || !responseBody.success) {
      throw new Error(responseBody.message || 'Error OCR');
    }

    /* ===== Mostrar panel ===== */
    ticketJson.classList.remove('active');


    /* ===== Monaco listo ===== */

    await initMonaco();

    /* ===== Cargar JSON OCR ===== */

    const jsonText = JSON.stringify(responseBody?.data ?? {}, null, 2);
    editor.setValue(jsonText);

    /* ===== Formatear ===== */

    editor.getAction('editor.action.formatDocument').run();


  }
  catch (error) {
    console.error('Error enviando imagen:', error);
  }
  finally {
    loading.style.display = 'none';
  }

});


/* =========================
   BOTÓN GUARDAR
========================= */
document.getElementById('guardar')?.addEventListener('click', async () =>
{

  if (!editor) return;

  let parsed;

  // validar JSON
  try {
    parsed = JSON.parse(editor.getValue());
  }
  catch {
    return;
  }

  // guardar en servidor
  try {

    const response = await fetch('/admin/tickets', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document
          .querySelector('meta[name="csrf-token"]')
          ?.getAttribute('content')
      },
      body: JSON.stringify({ data: parsed })
    });

    const text = await response.text();

    const responseBody = JSON.parse(text);

    if (!response.ok || !responseBody.success) {
      throw new Error(responseBody.message || 'Error guardando ticket');
    }


  }
  catch (error) {
    console.error(error);
  }

});