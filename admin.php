<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin - SEMARTEC</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
  <style>
    body { background: linear-gradient(135deg,#0f172a,#1e3a8a); min-height:100vh; }
    .card { background: rgba(255,255,255,0.96); box-shadow: 0 8px 30px rgba(2,6,23,0.5); border-radius: 12px; }
    .tiny { font-size: 0.85rem; color: #555; }
    .img-preview { width:100%; height:120px; object-fit:cover; border-radius:8px; }
    .small-btn { padding:6px 10px; border-radius:8px; }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

  <!-- LOGIN BOX -->
  <div id="loginBox" class="w-full max-w-md card p-6">
    <h2 class="text-2xl font-bold text-slate-800 mb-3 text-center">Panel Administrativo — SEMARTEC</h2>
    <p class="tiny mb-4 text-center">Ingresa la contraseña para poder acceder.</p>

    <input id="pwd" type="password" placeholder="Contraseña" class="w-full p-3 rounded-md border mb-4" />
    
    <div class="flex gap-3 mb-3">
      <button id="enterBtn" class="w-full bg-blue-700 text-white py-2 rounded-md">Entrar</button>
     
    </div>

    <!-- 🔵 BOTÓN NUEVO: REGRESAR -->
    <button onclick="goHome()" class="w-full bg-gray-300 text-slate-800 py-2 rounded-md mb-3">
      ⬅ Regresar al inicio
    </button>

    <p id="loginErr" class="text-red-600 mt-3 hidden">Contraseña incorrecta</p>
    <p class="tiny mt-4">Contraseña por defecto: <span class="font-medium">SemartecAdmin2025</span></p>
  </div>

  <!-- ADMIN PANEL -->
  <div id="adminPanel" class="hidden w-full max-w-5xl card p-6 space-y-6">
    <div class="flex justify-between items-center">

      <h2 class="text-2xl font-bold text-slate-800">Administración de Actividades</h2>

      <div class="flex items-center gap-3">

        <!-- 🔵 BOTÓN NUEVO: REGRESAR -->
        <button onclick="goHome()" class="px-4 py-2 bg-gray-400 text-black rounded-md">
          ⬅ Regresar
        </button>

        <button id="logoutBtn" class="px-4 py-2 bg-red-600 text-white rounded-md">Salir</button>
      </div>
    </div>

    <!-- FORM: añadir / editar -->
    <div id="formCard" class="p-4 border rounded-md">
      <h3 class="font-semibold mb-2">Agregar / Editar Actividad</h3>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <input id="titleInput" placeholder="Título" class="p-2 border rounded-md" />
        <input id="mainImageInput" placeholder="URL imagen principal (opcional)" class="p-2 border rounded-md" />
      </div>

      <textarea id="descInput" rows="4" placeholder="Descripción" class="w-full p-2 border rounded-md mt-3"></textarea>

      <!-- imagenes dinámicas -->
      <div class="mt-3">
        <label class="font-medium">Imágenes (puedes agregar varias URLs)</label>
        <div id="imagesList" class="space-y-2 mt-2"></div>
        <div class="flex gap-2 mt-2">
          <input id="newImageUrl" placeholder="URL de imagen" class="p-2 border rounded-md flex-1" />
          <button id="addImageBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md">Agregar imagen</button>
        </div>
        <p class="tiny mt-1">Puedes añadir 0, 1 o muchas imágenes — el frontend las rotará automáticamente.</p>
      </div>

      <div class="flex gap-3 mt-4">
        <button id="saveBtn" class="px-4 py-2 bg-green-600 text-white rounded-md">Guardar actividad</button>
        <button id="resetForm" class="px-4 py-2 bg-gray-200 rounded-md">Limpiar</button>
      </div>

      <input id="editingId" type="hidden" />
    </div>

    <!-- LISTA ACTIVIDADES -->
    <div>
      <h3 class="font-semibold mb-3">Actividades guardadas</h3>
      <div id="activitiesContainer" class="space-y-4"></div>
      <p id="noActivities" class="tiny text-gray-600 mt-2 hidden">No hay actividades. Usa el formulario para agregar la primera.</p>
    </div>

    <div class="text-right tiny text-gray-500">Datos guardados localmente en tu navegador (localStorage).</div>
  </div>

<script>
/* ==========================
   Función para regresar
   ========================== */
function goHome(){
  window.location.href = "index.php";
}

/* ==========================
   Configuración y utilidades
   ========================== */

const PASSWORD = "123";
const STORAGE_KEY = "semartec_activities_v1";

const loginBox = document.getElementById('loginBox');
const adminPanel = document.getElementById('adminPanel');
const loginErr = document.getElementById('loginErr');

const enterBtn = document.getElementById('enterBtn');
const pwd = document.getElementById('pwd');
const logoutBtn = document.getElementById('logoutBtn');
const fillDemo = document.getElementById('fillDemo');

const titleInput = document.getElementById('titleInput');
const descInput = document.getElementById('descInput');
const mainImageInput = document.getElementById('mainImageInput');
const imagesList = document.getElementById('imagesList');
const newImageUrl = document.getElementById('newImageUrl');
const addImageBtn = document.getElementById('addImageBtn');
const saveBtn = document.getElementById('saveBtn');
const resetForm = document.getElementById('resetForm');
const editingId = document.getElementById('editingId');

const activitiesContainer = document.getElementById('activitiesContainer');
const noActivities = document.getElementById('noActivities');

let activities = [];

/* LOGIN */
enterBtn.addEventListener('click', () => {
  const value = pwd.value || "";
  if (value === PASSWORD) {
    loginBox.classList.add('hidden');
    adminPanel.classList.remove('hidden');
    loadActivities();
    renderActivities();
    pwd.value = "";
    loginErr.classList.add('hidden');
  } else {
    loginErr.classList.remove('hidden');
  }
});
pwd.addEventListener('keydown', (e)=>{ if(e.key === 'Enter') enterBtn.click(); });

logoutBtn.addEventListener('click', () => {
  adminPanel.classList.add('hidden');
  loginBox.classList.remove('hidden');
  clearForm();
});

/* DEMO */
fillDemo.addEventListener('click', () => {
  if (!confirm('Esto creará 3 actividades de ejemplo en localStorage. ¿Continuar?')) return;
  const demo = [
    {
      id: genId(),
      title: 'CAMPAÑA “DÍA DE REYES”',
      description: 'Realizamos la entrega de juguetes con motivo del Día de Reyes en coordinación con Juguetón. Logramos 650 sonrisas de niños y niñas en comunidades indígenas y rurales.',
      images: [
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7ZXk7Yufj7PM3cmcd83nZZJBegaeaP2kmfxvqEoYAm-7DIjP4t1tqy55v6Z9bWDCU77s&usqp=CAU',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNxBjI5wAaj2tC-NjHb-FJWuLmCrHv_Nb4gw&s',
        'https://semartec.org/assets/images/q8.jpg'
      ]
    }
  ];
  localStorage.setItem(STORAGE_KEY, JSON.stringify(demo));
  alert('Demo cargado. Ahora entra con la contraseña.');
});

/* STORAGE */
function loadActivities(){
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    activities = raw ? JSON.parse(raw) : [];
  } catch { activities = []; }
}
function saveActivities(){
  localStorage.setItem(STORAGE_KEY, JSON.stringify(activities));
}

/* CRUD */
function genId(){ return 'a_' + Date.now() + '_' + Math.floor(Math.random()*9000); }

function clearForm(){
  titleInput.value = '';
  descInput.value = '';
  mainImageInput.value = '';
  imagesList.innerHTML = '';
  newImageUrl.value = '';
  editingId.value = '';
  saveBtn.textContent = 'Guardar actividad';
}

/* Agregar imagen */
function addImageToList(url){
  if(!url) return;
  const id = 'img_' + Math.random().toString(36).slice(2,9);
  const div = document.createElement('div');
  div.className = 'flex items-center gap-3';
  div.id = id;
  div.innerHTML = `
    <img src="${url}" class="img-preview w-32 h-20 rounded-md" />
    <div class="flex-1">
      <input class="w-full p-2 border rounded-md image-url-input" value="${url}" />
      <div class="tiny mt-1 text-gray-500">Puedes poner otra URL o borrar.</div>
    </div>
    <button class="small-btn bg-red-500 text-white ml-2" onclick="removeImage('${id}')">
      <i class="fa fa-trash"></i>
    </button>
  `;
  imagesList.appendChild(div);
}
window.removeImage = function(id){
  const el = document.getElementById(id);
  if(el) el.remove();
};

addImageBtn.addEventListener('click', (e)=>{
  e.preventDefault();
  const url = newImageUrl.value.trim();
  if(!url){ alert('Ingresa la URL'); return; }
  addImageToList(url);
  newImageUrl.value = '';
});

/* Guardar actividad */
saveBtn.addEventListener('click', ()=>{
  const title = titleInput.value.trim();
  const desc = descInput.value.trim();
  const mainImg = mainImageInput.value.trim();
  if(!title){ alert('Título obligatorio'); return; }

  const imgs = Array.from(imagesList.querySelectorAll('.image-url-input'))
                    .map(i => i.value.trim()).filter(Boolean);

  if(imgs.length === 0 && mainImg) imgs.push(mainImg);

  const id = editingId.value;

  if(id){
    const idx = activities.findIndex(a => a.id === id);
    if(idx === -1){ alert('No encontrado'); return; }
    activities[idx].title = title;
    activities[idx].description = desc;
    activities[idx].images = imgs;
  } else {
    const newAct = { id: genId(), title, description: desc, images: imgs };
    activities.unshift(newAct);
  }

  saveActivities();
  renderActivities();
  clearForm();
});

/* Renderizar lista */
function renderActivities(){
  loadActivities();
  activitiesContainer.innerHTML = '';
  if(activities.length === 0){
    noActivities.classList.remove('hidden');
    return;
  }
  noActivities.classList.add('hidden');

  activities.forEach(act => {
    const div = document.createElement('div');
    div.className = 'p-4 border rounded-md flex gap-4 items-start';
    div.innerHTML = `
      <div style="width:140px;flex-shrink:0;">
        <img src="${(act.images && act.images[0]) ? act.images[0] : 'https://via.placeholder.com/300x200?text=Sin+imagen'}" class="w-full h-28 object-cover rounded-md" />
      </div>
      <div class="flex-1">
        <h4 class="font-semibold text-lg">${escapeHtml(act.title)}</h4>
        <p class="tiny text-gray-700 mt-1">${escapeHtml(truncate(act.description, 220))}</p>
        <div class="flex gap-2 mt-3">
          <button class="px-3 py-1 bg-yellow-400 rounded-md" onclick="startEdit('${act.id}')">✏️ Editar</button>
          <button class="px-3 py-1 bg-red-500 text-white rounded-md" onclick="removeActivity('${act.id}')">🗑️ Eliminar</button>
          <button class="px-3 py-1 bg-sky-600 text-white rounded-md" onclick="viewActivity('${act.id}')">👁️ Ver</button>
        </div>
      </div>
    `;
    activitiesContainer.appendChild(div);
  });
}

/* Ver actividad */
window.viewActivity = function(id){
  const act = activities.find(a=>a.id===id);
  if(!act) return alert('No encontrado');

  const w = window.open('', '_blank', 'width=900,height=700');
  const html = `
  <html><head>
    <meta charset="utf-8">
    <title>${escapeHtml(act.title)}</title>
    <style>body{font-family:Arial;padding:20px}img{max-width:100%;border-radius:8px;margin-bottom:10px}</style>
  </head><body>
    <h1>${escapeHtml(act.title)}</h1>
    <p>${escapeHtml(act.description)}</p>
    <div>${(act.images && act.images.length) ? act.images.map(u=>`<img src="${u}" />`).join('') : '<p>No hay imágenes</p>'}</div>
  </body></html>`;
  w.document.write(html); w.document.close();
};

/* Editar */
window.startEdit = function(id){
  const act = activities.find(a=>a.id===id);
  if(!act) return alert('No encontrado');

  titleInput.value = act.title;
  descInput.value = act.description || '';
  mainImageInput.value = (act.images && act.images[0]) ? act.images[0] : '';
  imagesList.innerHTML = '';

  if(act.images){
    act.images.forEach(url => addImageToList(url));
  }

  editingId.value = act.id;
  saveBtn.textContent = 'Actualizar actividad';
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

/* Eliminar */
window.removeActivity = function(id){
  if(!confirm('¿Eliminar actividad?')) return;
  activities = activities.filter(a => a.id !== id);
  saveActivities();
  renderActivities();
};

function escapeHtml(text){ return (text||'').replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;'); }
function truncate(s, n){ return s && s.length > n ? s.slice(0,n) + '…' : (s||''); }

function init(){
  loadActivities();
  renderActivities();
}
init();

console.log('Admin panel listo.');
</script>

</body>
</html>
