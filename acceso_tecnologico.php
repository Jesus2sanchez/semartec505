<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SEMARTEC - How do we carry it out?</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f7fb;
      color: #333;
      overflow-x: hidden;
    }

    /* ===== HEADER ===== */
    header {
      background: linear-gradient(90deg, #004aad, #0073e6);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 6%;
      box-shadow: 0 3px 15px rgba(0,0,0,0.2);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .logo-contenedor {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .logo-contenedor img {
      height: 60px;
      border-radius: 50%;
      background: white;
      padding: 5px;
      box-shadow: 0 0 8px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }
    .logo-contenedor img:hover { transform: scale(1.08); }

    .nombre-logo {
      color: #ffffff;
      font-size: 28px;
      font-weight: 700;
      letter-spacing: 1px;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
      white-space: nowrap;
    }

    nav ul {
      display: flex;
      gap: 25px;
      list-style: none;
    }

    nav ul li a {
      color: white;
      font-weight: 600;
      text-decoration: none;
      font-size: 16px;
      position: relative;
      transition: color 0.3s;
    }

    nav ul li a::after {
      content: "";
      position: absolute;
      left: 0; bottom: -4px;
      width: 0; height: 2px;
      background: #ffcc00;
      transition: 0.3s;
    }

    nav ul li a:hover {
      color: #ffcc00;
    }
    nav ul li a:hover::after { width: 100%; }

    /* ===== HERO ===== */
    .hero {
      position: relative;
      height: 480px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background: linear-gradient(120deg, rgba(0,74,173,0.7), rgba(0,115,230,0.6)),
                  url("https://images.unsplash.com/photo-1581092795360-0e9c7de27f1d?auto=format&fit=crop&w=1200&q=80")
                  no-repeat center center/cover;
      color: white;
      text-align: center;
      padding: 0 10%;
      overflow: hidden;
    }

    .hero h1 {
      font-size: 2.3rem;
      font-weight: 700;
      letter-spacing: 1px;
      z-index: 2;
      animation: fadeInDown 2s ease;
      text-shadow: 0 3px 10px rgba(0,0,0,0.4);
      background: rgba(0, 74, 173, 0.75);
      padding: 8px 18px;
      border-radius: 8px;
      display: inline-block;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 1.1rem;
      max-width: 900px;
      line-height: 1.7;
      background: rgba(0, 0, 0, 0.45);
      padding: 15px 25px;
      border-radius: 10px;
      backdrop-filter: blur(2px);
      animation: fadeInUp 2s ease;
    }

    @keyframes fadeInDown {
      0% { opacity: 0; transform: translateY(-40px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(40px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    /* ===== CONTENT ===== */
    .contenido {
      padding: 80px 10%;
      text-align: center;
    }

    .contenido h2 {
      color: #004aad;
      font-size: 2.7rem;
      margin-bottom: 25px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .contenido p {
      font-size: 1.15rem;
      line-height: 1.8;
      max-width: 850px;
      margin: 0 auto 60px;
      color: #444;
    }

    /* ===== PROGRAMS ===== */
    .programas {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 35px;
    }

    .card {
      background: white;
      width: 310px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      transition: all 0.4s ease;
      position: relative;
      opacity: 0;
      transform: translateY(40px);
    }

    .card.reveal {
      opacity: 1;
      transform: translateY(0);
      transition: all 0.8s ease;
    }

    .card:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 15px 40px rgba(0,0,0,0.25);
    }

    .card img {
      width: 100%;
      height: 210px;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .card:hover img { transform: scale(1.08); }

    .card h3 {
      color: #004aad;
      font-size: 1.4rem;
      padding: 18px 20px 0;
    }

    .card p {
      padding: 12px 22px 25px;
      color: #555;
      font-size: 1rem;
      line-height: 1.6;
    }

    /* ===== NEW SECTION ===== */
    .seccion-problematica {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 60px;
      padding: 90px 10%;
      margin-top: 80px;
      background: linear-gradient(135deg, #ffffff, #eaf2ff);
      border-radius: 25px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .seccion-problematica .texto {
      flex: 1;
    }

    .seccion-problematica .texto h3 {
      color: #ff6600;
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .seccion-problematica .texto h2 {
      font-size: 2rem;
      font-weight: 800;
      color: #222;
      margin-bottom: 20px;
    }

    .seccion-problematica .texto p {
      color: #555;
      font-size: 1.05rem;
      line-height: 1.8;
      text-align: justify;
    }

    .seccion-problematica .imagen {
      flex: 1;
      display: flex;
      justify-content: center;
    }

    .seccion-problematica .imagen img {
      width: 85%;
      max-width: 420px;
      border-radius: 20px;
      box-shadow: 0 6px 25px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }

    .seccion-problematica .imagen img:hover {
      transform: scale(1.05);
    }

    /* ===== FOOTER ===== */
    footer {
      background: linear-gradient(135deg, #004aad, #002b6d);
      color: white;
      padding: 60px 10%;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      align-items: flex-start;
    }

    .footer-left {
      max-width: 400px;
    }

    .footer-left p {
      margin-bottom: 10px;
      line-height: 1.6;
      font-size: 1rem;
    }

    .footer-right {
      display: flex;
      align-items: center;
      gap: 25px;
      margin-top: 20px;
    }

    .footer-right a {
      color: white;
      font-size: 30px;
      transition: all 0.3s ease;
    }

    .footer-right a:hover {
      color: #ffcc00;
      transform: scale(1.25) rotate(8deg);
    }

    @media (max-width: 900px) {
      .seccion-problematica {
        flex-direction: column-reverse;
        text-align: center;
      }
      .seccion-problematica .texto, .seccion-problematica .imagen {
        flex: unset;
      }
      .seccion-problematica .imagen img {
        width: 100%;
        max-width: 350px;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="logo-contenedor">
      <img src="logo.png" alt="SEMARTEC Logo">
      <span class="nombre-logo">SEMARTEC, A.C.</span>
    </div>

    <nav>
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
  </header>

  <section class="hero">
    <h1>How do we carry it out?</h1>
    <p>
      By implementing infrastructures through which wireless links are established,
      allowing us to deliver internet service to hard-to-reach areas. We improve educational quality
      through computer equipment and free wireless internet, including schools on equal terms and reducing
      the digital divide with online educational programs.
    </p>
  </section>

  <section class="contenido">
    <h2>We connect communities to the digital age</h2>
    <p>
      At <strong>SEMARTEC</strong>, we promote digital inclusion through projects that bring 
      technology, training, and connectivity to indigenous and rural communities in the State of Mexico. 
      Our goal is to close the technological gap and open new educational and economic opportunities 
      for everyone.
    </p>

    <div class="programas">
      <div class="card reveal">
        <img src="https://semartec.org/assets/images/q3.jpg" alt="School Connectivity">
        <h3>School Connectivity</h3>
        <p>SEMARTEC works to reduce the digital divide and empower school communities, especially in underserved areas, by providing technological infrastructure and access to digital educational resources.</p>
      </div>

      <div class="card reveal">
        <img src="https://semartec.org/assets/images/q2.jpg" alt="Technological Training">
        <h3>Technological Training</h3>
        <p>Semartec’s technological capacity is focused on the social appropriation of technology and education, rather than large-scale hardware or software development, using ICT as tools for social and educational development.</p>
      </div>

      <div class="card reveal">
        <img src="https://www.semartec.org/assets/images/qa.jpg" alt="Rural Innovation">
        <h3>Rural Innovation</h3>
        <p>SEMARTEC uses technology (ICT) as an educational and social tool to promote sustainable development and improve living conditions in rural areas, rather than focusing on direct agricultural innovations such as drones or field sensors.</p>
      </div>
    </div>
  </section>

  <section class="seccion-problematica">
    <div class="texto">
      <h3>How does the project</h3>
      <h2>help solve the problem?</h2>
      <p>
        In accordance with the Sustainable Development Goals — Quality Education and Industry, Innovation, and Infrastructure — 
        this program expands access to information and communication technologies, encouraging digital inclusion. 
        It promotes universal and affordable access to the internet, strengthening the digital skills of students and communities 
        for employment, education, and sustainable entrepreneurship.
      </p>
    </div>
    <div class="imagen">
      <img src="https://semartec.org/assets/images/q5.jpg" alt="SEMARTEC Project">
    </div>
  </section>

  <footer>
    <div class="footer-left">
      <p>We are a group of young people with technological knowledge and a strong passion for transforming our Mazahua communities through innovation.</p>
      <p class="telefono">📞 52712124204</p>
      <p class="correo">✉️ semartec@gmail.com</p>
    </div>

    <div class="footer-right">
      <a href="https://www.facebook.com/share/1AQuEKkAmf/" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/semartecac/" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://wa.me/527121890269" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>
  </footer>

  <script>
    function revealElements() {
      const reveals = document.querySelectorAll('.reveal, .card');
      for (let i = 0; i < reveals.length; i++) {
        const windowHeight = window.innerHeight;
        const elementTop = reveals[i].getBoundingClientRect().top;
        const revealPoint = 100;

        if (elementTop < windowHeight - revealPoint) {
          reveals[i].classList.add('active', 'reveal');
        } else {
          reveals[i].classList.remove('active');
        }
      }
    }

    window.addEventListener('scroll', revealElements);
    window.addEventListener('load', revealElements);
  </script>
</body>
</html>
