<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Semartec - Home</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

  <style>
    .gradient-bg { background: linear-gradient(to right, #dbeafe, #e0e7ff); }
    footer { background-color: #0056b3; color: white; display: flex; justify-content: space-between; align-items: flex-start; padding: 20px; flex-wrap: wrap; }
    .footer-left { max-width: 400px; }
    .footer-left p { margin: 5px 0; }
    .footer-right { display: flex; gap: 15px; align-items: center; }
    .footer-right a { display: inline-block; }
    .social-icon { width: 35px; height: 35px; transition: transform 0.3s ease; }
    .social-icon:hover { transform: scale(1.1); }
    .hero { background-image: url('images/q3.jpg'); background-size: cover; background-position: center; position: relative; }
    .hero::before { content: ""; position: absolute; inset: 0; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)); }
    .hero-content { position: relative; z-index: 1; }
    .gallery-img { transition: transform 0.4s ease, box-shadow 0.4s ease; width: 100%; height: 400px; object-fit: cover; }
    .gallery-img:hover { transform: scale(1.05); box-shadow: 0 20px 30px rgba(0,0,0,0.3); }
    .card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .card:hover { transform: translateY(-10px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
    .card img { width: 100%; height: 200px; object-fit: cover; }
    .text-blue-500 { color: #3b82f6; }
    .highlight-text { background: linear-gradient(to right, #3b82f6, #60a5fa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .about-section { background: linear-gradient(to right, #dbeafe, #e0e7ff); padding: 60px 20px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin: 20px 0; }
    .about-section h2 { font-size: 36px; color: #3b82f6; margin-bottom: 20px; }
    .about-section p { font-size: 18px; color: #333; line-height: 1.6; }
    .project-section { background: #f4f4f4; padding: 60px 20px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin: 20px 0; }
    .project-section h2 { font-size: 36px; color: #3b82f6; margin-bottom: 20px; text-align: center; }
    .project-section p { font-size: 18px; color: #333; line-height: 1.6; text-align: center; }
    .project-card { background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .project-card:hover { transform: translateY(-10px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
    .project-card img { width: 100%; height: 200px; object-fit: cover; border-radius: 15px; }
    .project-card h3 { font-size: 24px; color: #3b82f6; margin-top: 10px; }
    .project-card p { font-size: 16px; color: #333; line-height: 1.6; }

    /* CÍRCULO DEL USUARIO */
    .user-circle {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #6BCB77; /* Verde claro */
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 16px;
      cursor: pointer;
    }

    .flash {
      position: fixed;
      top: 90px;
      right: 24px;
      z-index: 999;
      background: #e6ffed;
      color: #2b7a3a;
      border: 1px solid #b6f0c6;
      padding: 10px 14px;
      border-radius: 8px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.07);
    }
  </style>
</head>

<body class="min-h-screen bg-white">

  <!-- HEADER -->
  <header class="bg-blue-700 text-white shadow-md fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center py-4">
        <div class="flex items-center space-x-3">
          <img src="logo.png" alt="Semartec Logo" class="w-12 h-12 rounded-full">
          <span class="text-2xl font-bold">Semartec A.C</span>
        </div>

        <nav>
          <ul class="flex space-x-6 text-white font-medium items-center">

            <li><a href="index.php" class="hover:text-gray-200">Home</a></li>
            <li><a href="quienes_somos.php" class="hover:text-gray-200">Who We Are</a></li>
            <li><a href="acceso_tecnologico.php" class="hover:text-gray-200">Technological Access</a></li>
            <li><a href="noticias.php" class="hover:text-gray-200">News</a></li>
            <li><a href="donar.php" class="hover:text-gray-200">Donate</a></li>
            <li><a href="admin.php" class="hover:text-gray-200">Administrator</a></li>

            <!-- BOTÓN INICIAR SESIÓN (solo si NO está logueado) -->
            <?php if (!isset($_SESSION['usuario_nombre'])): ?>
              <li>
                <a href="login.php" class="bg-white text-blue-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
                  Iniciar Sesión
                </a>
              </li>
            <?php endif; ?>

            <!-- CÍRCULO CON INICIAL (solo si SÍ está logueado) -->
            <?php if (isset($_SESSION['usuario_nombre'])):
                $inicial = strtoupper(substr($_SESSION['usuario_nombre'], 0, 1));
            ?>
              <li>
                <a href="logout.php" title="Cerrar sesión">
                  <div class="user-circle"><?php echo htmlspecialchars($inicial); ?></div>
                </a>
              </li>
            <?php endif; ?>

          </ul>
        </nav>
      </div>
    </div>
  </header>

  <!-- MENSAJE FLASH -->
  <?php if (!empty($_SESSION['flash'])): ?>
    <div class="flash">
      <?php
        echo htmlspecialchars($_SESSION['flash']);
        unset($_SESSION['flash']);
      ?>
    </div>

    <script>
      setTimeout(() => {
        const f = document.querySelector('.flash');
        if (f) f.style.display = 'none';
      }, 4000);
    </script>
  <?php endif; ?>


  <!-- HERO -->
  <section class="hero pt-24 pb-10 flex items-center justify-center text-center min-h-[45vh]">
    <div class="hero-content max-w-2xl px-4">
      <h1 class="text-5xl font-bold text-white mb-6 drop-shadow-lg">Semartec A.C.</h1>
      <div class="flex justify-center space-x-4">
        <a href="quienes_somos.html" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">Learn More</a>
        <a href="https://wa.me/527121890269" class="border border-gray-300 hover:border-gray-400 text-white px-8 py-3 rounded-lg font-medium transition-colors">Contact</a>
      </div>
    </div>
  </section>

  <!-- ABOUT US -->
  <section class="about-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-center">Who Are We?</h2>
      <p>
        We are a group of young people with technological knowledge and a strong desire to transform our Mazahua communities...
      </p>
    </div>
  </section>

  <!-- MISSION / VISION / OBJECTIVE -->
  <section class="relative py-24 bg-gradient-to-br from-indigo-600 via-blue-600 to-cyan-400 text-white overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,rgba(255,255,255,0.15),transparent_70%)]"></div>

    <div class="relative max-w-7xl mx-auto px-6 text-center">
      <h2 class="text-4xl md:text-5xl font-extrabold mb-16 tracking-wide drop-shadow-md">Mission, Vision, and Objective</h2>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

        <!-- (TUS 3 CARDS ORIGINALES COMPLETOS, NO SE TOCARON) -->

        <div class="group bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-white/20 transition-all hover:scale-105 hover:bg-white/20">
          <div class="flex flex-col items-center">
            <div class="bg-orange-500 p-6 rounded-full shadow-md mb-5 group-hover:scale-110 transition-transform">
              <i class="fa-solid fa-rocket text-white text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-white mb-4">Our Mission</h3>
            <p class="text-blue-100 leading-relaxed text-center text-lg">
              Improve the quality of education...
            </p>
          </div>
        </div>

        <div class="group bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-white/20 transition-all hover:scale-105 hover:bg-white/20">
          <div class="flex flex-col items-center">
            <div class="bg-sky-500 p-6 rounded-full shadow-md mb-5 group-hover:scale-110 transition-transform">
              <i class="fa-solid fa-eye text-white text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-white mb-4">Our Vision</h3>
            <p class="text-blue-100 leading-relaxed text-center text-lg">
              To be a consolidated civil association...
            </p>
          </div>
        </div>

        <div class="group bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-white/20 transition-all hover:scale-105 hover:bg-white/20">
          <div class="flex flex-col items-center">
            <div class="bg-green-500 p-6 rounded-full shadow-md mb-5 group-hover:scale-110 transition-transform">
              <i class="fa-solid fa-bullseye text-white text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-white mb-4">Our Objective</h3>
            <p class="text-blue-100 leading-relaxed text-center text-lg">
              Improve the quality of education...
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- PROJECTS -->
  <section class="project-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-center">Our Projects</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <div class="project-card">
          <img src="https://pbs.twimg.com/media/EpYFKkHUcAAN7A9.jpg" alt="Project 1" class="gallery-img">
          <h3 class="text-2xl font-semibold text-blue-500 mb-2">Sowing Art and Technology for Education</h3>
          <p class="text-gray-700">We are a group of young people...</p>
        </div>

        <div class="project-card">
          <img src="https://pbs.twimg.com/media/EpYMCQzVgAAseEd.jpg" alt="Project 2" class="gallery-img">
          <h3 class="text-2xl font-semibold text-blue-500 mb-2">Program to Increase Technological Access</h3>
          <p class="text-gray-700">This program aims to improve...</p>
        </div>

        <div class="project-card">
          <img src="https://pbs.twimg.com/media/EpYMAPqVgAAr5UH.jpg" alt="Project 3" class="gallery-img">
          <h3 class="text-2xl font-semibold text-blue-500 mb-2">Presentation of Technological Projects</h3>
          <p class="text-gray-700">This motivated us to form an organization...</p>
        </div>

      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-blue-700 text-white py-8 px-4 flex flex-col md:flex-row justify-between items-center">

    <div class="footer-left mb-4 md:mb-0 max-w-md">
      <p>We are a group of young people with technological knowledge...</p>
      <p class="telefono mt-2">📞 52712124204</p>
      <p class="correo mt-1">✉️ semartec@gmeil.com</p>
    </div>

    <div class="footer-right flex space-x-6 text-3xl">
      <a href="https://www.facebook.com/share/1AQuEKkAmf/" target="_blank" class="hover:text-red-600 transition-colors"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/semartecac/" target="_blank" class="hover:text-pink-500 transition-colors"><i class="fab fa-instagram"></i></a>
      <a href="https://wa.me/527121890269" target="_blank" class="hover:text-green-500 transition-colors"><i class="fab fa-whatsapp"></i></a>
    </div>

  </footer>

</body>
</html>
