<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>SEMARTEC - News</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
  <style>
    body { font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; background: linear-gradient(135deg,#e0f2fe,#bfdbfe,#93c5fd); min-height:100vh; }
    .card { background: rgba(255,255,255,0.88); border-radius:12px; box-shadow: 0 8px 30px rgba(8,17,43,0.12); overflow:hidden; }
    .carousel-img { width:100%; height:220px; object-fit:cover; display:block; border-bottom:1px solid rgba(0,0,0,0.05); }
    .dot { width:8px;height:8px;border-radius:999px;background:rgba(0,0,0,0.2); display:inline-block;margin:0 4px; }
    .dot.active{ background:#2563eb; }
  </style>
</head>
<body>
  <!-- HEADER -->
  <header class="bg-gradient-to-r from-blue-900 to-blue-600 text-white sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
      <div class="flex items-center gap-3">
        <img src="logo.png" alt="logo" style="height:48px;border-radius:8px;background:white;padding:4px;">
        <h1 class="text-xl font-bold">SEMARTEC, A.C.</h1>
      </div>
      <nav class="text-white">
        <ul class="flex space-x-6 text-white font-medium">
            <li><a href="index.php" class="hover:text-gray-200">Start</a></li>
            <li><a href="quienes_somos.php" class="hover:text-gray-200">Who We Are</a></li>
            <li><a href="acceso_tecnologico.php" class="hover:text-gray-200">Technological Access</a></li>
            <li><a href="noticias.php" class="hover:text-gray-200">News</a></li>
            <li><a href="donar.php" class="hover:text-gray-200">Donate</a></li>
            <li><a href="admin.php" class="hover:text-gray-200">Administrator</a></li>
          </ul>
      </nav>
<?php if (isset($_SESSION['usuario_nombre'])): ?>
    <?php 
        $inicial = strtoupper(substr($_SESSION['usuario_nombre'], 0, 1)); 
    ?>
    <div style="
        background:#7ed957; 
        color:white; 
        width:45px; 
        height:45px; 
        border-radius:50%; 
        display:flex; 
        align-items:center; 
        justify-content:center; 
        font-size:20px; 
        font-weight:bold; 
        box-shadow:0 0 6px rgba(0,0,0,0.3); 
        cursor:pointer;
        margin-left:20px;
    ">
        <?= $inicial ?>
    </div>
<?php else: ?>
    <a href="login.php" class="px-4 py-2 bg-white text-blue-700 font-semibold rounded-lg shadow">
        Iniciar Sesión
    </a>
<?php endif; ?>

    </div>
  </header>

  <!-- MAIN -->
  <main class="max-w-7xl mx-auto p-6">
    <h2 class="text-4xl font-extrabold text-blue-900 mb-6">🚀 Our Activities</h2>
    <p class="text-lg text-slate-700 mb-8">All activities loaded from the admin panel.</p>

    <div id="activitiesGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>

    <p id="emptyMsg" class="mt-8 text-center text-gray-600 hidden">There are no activities. Enter the admin panel to create some.</p>
  </main>

<script>
const STORAGE_KEY = "semartec_activities_v1";

/* If no activities are stored, create the original 3 default ones
   This ensures that on first display there is content (you can delete them later from admin panel) */
function seedDefaultIfEmpty(){
  const raw = localStorage.getItem(STORAGE_KEY);
  if(raw) return;
  const demo = [
    {
      id: 'seed1',
      title: '“KINGS DAY” CAMPAIGN',
      description: 'We delivered toys for Kings Day in coordination with Juguetón. We achieved 650 smiles from children in indigenous and rural communities.',
      images: [
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7ZXk7Yufj7PM3cmcd83nZZJBegaeaP2kmfxvqEoYAm-7DIjP4t1tqy55v6Z9bWDCU77s&usqp=CAU',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNxBjI5wAaj2tC-NjHb-FJWuLmCrHv_Nb4gw&s',
        'https://semartec.org/assets/images/q8.jpg'
      ]
    },
    {
      id: 'seed2',
      title: 'TECHNOLOGICAL ACCESS IN COMMUNITIES',
      description: 'We provide free Internet service to rural schools to improve digital learning, connecting 92 schools and benefiting more than 11,500 students.',
      images: [
        'https://semartec.org/assets/images/q2.jpg',
        'https://semartec.org/assets/images/q1.jpg'
      ]
    },
    {
      id: 'seed3',
      title: 'RESTORING TECHNOLOGICAL EQUIPMENT',
      description: 'We maintain equipment using the free Endless OS and restore interactive whiteboards, benefiting rural schools.',
      images: [
        'https://semartec.org/assets/images/a2.jpg',
        'https://semartec.org/assets/images/sema.jpg',
        'https://semartec.org/assets/images/q5.jpg'
      ]
    }
  ];
  localStorage.setItem(STORAGE_KEY, JSON.stringify(demo));
}

/* load and render */
function loadActivities(){
  const raw = localStorage.getItem(STORAGE_KEY);
  if(!raw) return [];
  try { return JSON.parse(raw); } catch(e){ return []; }
}

function createCard(act){
  const wrapper = document.createElement('div');
  wrapper.className = 'card';
  wrapper.innerHTML = `
    <div class="relative">
      <div class="carousel" data-id="${act.id}" style="position:relative;overflow:hidden;height:220px;background:#eee">
        ${ (act.images && act.images.length) ? act.images.map((u,idx)=>`<img src="${u}" class="carousel-img" style="${idx===0 ? 'display:block' : 'display:none'}" />`).join('') : '<div style="height:220px;display:flex;align-items:center;justify-content:center;color:#666">No image</div>'}
      </div>
    </div>
    <div class="p-4">
      <h3 class="font-semibold text-lg mb-2">${escapeHtml(act.title)}</h3>
      <p class="text-sm text-gray-700 mb-3">${escapeHtml(truncate(act.description, 200))}</p>
      <div class="flex justify-between items-center">
        <button class="px-3 py-1 bg-blue-600 text-white rounded-md viewBtn" data-id="${act.id}">More information</button>
        <div class="dots"></div>
      </div>
    </div>`;
  return wrapper;
}

function escapeHtml(s){ return (s||'').replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;'); }
function truncate(s,n){ return s && s.length>n ? s.slice(0,n)+'…' : (s||''); }

function renderAll(){
  seedDefaultIfEmpty();
  const acts = loadActivities();
  const grid = document.getElementById('activitiesGrid');
  grid.innerHTML = '';
  if(acts.length === 0){
    document.getElementById('emptyMsg').classList.remove('hidden');
    return;
  } else document.getElementById('emptyMsg').classList.add('hidden');

  acts.forEach(act => {
    const card = createCard(act);
    grid.appendChild(card);
  });

  initCarousels();

  document.querySelectorAll('.viewBtn').forEach(btn => {
    btn.addEventListener('click', (e)=>{
      const id = e.currentTarget.dataset.id;
      const act = acts.find(a=>a.id===id);
      if(!act) return;
      openDetail(act);
    });
  });
}

function initCarousels(){
  const carousels = document.querySelectorAll('.carousel');
  carousels.forEach(car => {
    const imgs = Array.from(car.querySelectorAll('img'));
    if(imgs.length <=1) return;
    let i = 0;
    setInterval(()=>{
      imgs.forEach(img=> img.style.display = 'none');
      i = (i+1) % imgs.length;
      imgs[i].style.display = 'block';
    }, 3500);
  });
}

function openDetail(act){
  const w = window.open('', '_blank', 'width=900,height=700');
  const html = `
<html><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>${escapeHtml(act.title)}</title>
<style>body{font-family:Inter,Arial;padding:20px} img{max-width:100%;margin-bottom:10px;border-radius:8px}</style>
</head><body>
  <h1>${escapeHtml(act.title)}</h1>
  <p>${escapeHtml(act.description)}</p>
  <div>${(act.images && act.images.length) ? act.images.map(u=>`<img src="${u}" />`).join('') : '<p>No images available</p>'}</div>
</body></html>`;
  w.document.write(html); w.document.close();
}

/* initialize */
renderAll();
</script>
</body>
</html>
