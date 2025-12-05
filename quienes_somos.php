<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SEMARTEC, A.C.</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f7fb;
      color: #333;
      scroll-behavior: smooth;
    }

    /* HEADER */
    header {
      backdrop-filter: blur(10px);
      background: rgba(0, 74, 173, 0.85);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 6%;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .logo-contenedor {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    header img.logo {
      height: 70px;
      border-radius: 50%;
      background: white;
      padding: 4px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }

    .nombre-logo {
      font-size: 26px;
      font-weight: 800;
      color: #fff;
      letter-spacing: 1px;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
    }

    nav ul li a {
      color: #fff;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
      position: relative;
    }

    nav ul li a::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -5px;
      width: 0%;
      height: 2px;
      background: #ffcc00;
      transition: width 0.3s ease;
    }

    nav ul li a:hover::after {
      width: 100%;
    }

    /* MAIN TITLE */
    .titulo-seccion {
      position: relative;
      height: 280px;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #004aad, #0080ff);
      overflow: hidden;
    }

    .titulo-seccion::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: radial-gradient(circle, rgba(255,255,255,0.1), transparent 70%);
      animation: movimiento 8s linear infinite;
    }

    @keyframes movimiento {
      from { transform: translate(-50%, -50%) rotate(0deg); }
      to { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .titulo-seccion h1 {
      position: relative;
      z-index: 2;
      font-size: 58px;
      font-weight: 900;
      color: white;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-shadow: 0 5px 15px rgba(0,0,0,0.4);
      background: linear-gradient(to right, #fff, #ffcc00);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: fadeDown 1.5s ease-in-out;
    }

    @keyframes fadeDown {
      from { opacity: 0; transform: translateY(-40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* WHO WE ARE */
    .quienes-somos {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 70px 8%;
      background: #fff;
      border-radius: 20px;
      margin: 50px 6%;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      gap: 40px;
    }

    .quienes-somos .texto {
      flex: 1;
    }

    .quienes-somos .texto h2 {
      color: #004aad;
      font-size: 34px;
      margin-bottom: 20px;
    }

    .quienes-somos .texto p {
      font-size: 18px;
      color: #555;
      line-height: 1.8;
    }

    .quienes-somos .slider {
      flex: 1;
      height: 320px;
      border-radius: 15px;
      overflow: hidden;
      position: relative;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .quienes-somos .slider img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      opacity: 0;
      transition: opacity 1s;
    }

    .quienes-somos .slider img.active {
      opacity: 1;
    }

    /* NEW SECTION */
    .en-que-consiste {
      background: linear-gradient(120deg, #e0ecff, #ffffff);
      padding: 70px 8%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-radius: 20px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
      margin: 50px 6%;
      gap: 40px;
    }

    .en-que-consiste .texto {
      flex: 1;
    }

    .en-que-consiste .texto h2 {
      color: #004aad;
      font-size: 32px;
      margin-bottom: 15px;
    }

    .en-que-consiste .texto p {
      font-size: 17px;
      color: #444;
      margin-bottom: 15px;
      line-height: 1.8;
    }

    .en-que-consiste .slider {
      flex: 1;
      height: 320px;
      border-radius: 15px;
      overflow: hidden;
      position: relative;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .en-que-consiste .slider img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    .en-que-consiste .slider img.active {
      opacity: 1;
    }

    /* MISSION, VISION, OBJECTIVE */
    .mvo {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      gap: 35px;
      padding: 60px 8%;
      background: #fff;
      border-radius: 20px;
      margin: 50px 6%;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }

    .mvo-item {
      width: 300px;
      background: #f8fbff;
      border-radius: 15px;
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }

    .mvo-item:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .mvo-item .img-box {
      width: 100%;
      height: 220px;
      position: relative;
      overflow: hidden;
    }

    .mvo-item .img-box img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    .mvo-item .img-box img.active {
      opacity: 1;
    }

    .mvo-item button {
      width: 100%;
      border: none;
      padding: 14px 0;
      font-size: 18px;
      background: linear-gradient(135deg, #004aad, #0073e6);
      color: #fff;
      cursor: pointer;
      transition: background 0.3s;
      font-weight: 600;
      letter-spacing: 1px;
    }

    .mvo-item button:hover {
      background: linear-gradient(135deg, #002f7a, #005dc0);
    }

    .mvo-item p {
      padding: 18px;
      display: none;
      font-size: 16px;
      color: #555;
    }

    /* INDICATORS */
    .indicadores {
      text-align: center;
      padding: 80px 8%;
      background: linear-gradient(180deg, #ffffff, #e3eeff);
      margin-top: 40px;
    }

    .indicadores h2 {
      color: #004aad;
      font-size: 36px;
      margin-bottom: 50px;
      text-transform: uppercase;
      font-weight: 800;
    }

    .indicadores-contenedor {
      display: flex;
      justify-content: center;
      gap: 50px;
      flex-wrap: wrap;
    }

    .indicador {
      background: white;
      width: 230px;
      padding: 30px 20px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .indicador:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 25px rgba(0,0,0,0.2);
    }

    .indicador i {
      font-size: 50px;
      color: #35a62b;
      margin-bottom: 10px;
    }

    .indicador h3 {
      font-size: 40px;
      color: #004aad;
    }

    .indicador p {
      font-weight: 500;
      color: #333;
      margin-top: 5px;
    }

    /* FOOTER */
    footer {
      background: #004aad;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 40px 10%;
      flex-wrap: wrap;
      box-shadow: 0 -4px 20px rgba(0,0,0,0.2);
    }

    .footer-left {
      max-width: 400px;
    }

    .footer-right {
      display: flex;
      gap: 20px;
      font-size: 30px;
    }

    .footer-right a {
      color: white;
      transition: 0.3s;
    }

    .footer-right a:hover {
      color: #ffcc00;
      transform: scale(1.2);
    }
  </style>
</head>

<body>
  <header>
    <div class="logo-contenedor">
      <img src="logo.png" alt="Semartec Logo" class="logo">
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

  <section class="titulo-seccion">
    <h1>SEMARTEC, A.C.</h1>
  </section>

  <section class="quienes-somos">
    <div class="texto">
      <h2>Who Are We?</h2>
      <p>We are a group of young people with technological knowledge and a strong desire to transform our Mazahua communities, legally established since 2013. We joined together upon seeing the needs present in the indigenous and rural communities of the Municipality of San José del Rincón, mainly because the educational level in marginalized areas is low, and one of the causes is the limited use of technology.</p>
    </div>
    <div class="slider">
      <img src="https://pbs.twimg.com/media/EpYFKkHUcAAN7A9.jpg" class="active">
      <img src="https://pbs.twimg.com/ext_tw_video_thumb/959229397076123648/pu/img/16BUrDJcQUqKfrWS.jpg">
      <img src="https://pbs.twimg.com/media/EpYPChAVQAAi3qN.jpg">
    </div>
  </section>

  <section class="en-que-consiste">
    <div class="texto">
      <h2>What Does Our Program Consist Of?</h2>
      <p>It is a program whose objective is to contribute to improving the quality of education by providing technological access to rural and indigenous communities in the Municipality of San José del Rincón.

Through this program, beneficiaries will have the possibility and facility to continue their distance studies as a consequence of the Covid-19 Pandemic contingency.</p>
    </div>
    <div class="slider">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBOdIkRIsLHcApzRgbD5a5gaRfkO_Hsj97-g&s" class="active">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSgy0GmUGfcGKls9uX8iiAb7bJNTHwP7glcpQ&s">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmLhOj8Gg2zTMYL3Axudt9kSGeWLuYzDUTog&s">
    </div>
  </section>

  <section class="mvo">
    <div class="mvo-item">
      <div class="img-box">
        <img src="https://semartec.org/assets/images/sema.jpg" class="active">
        <img src="https://semartec.org/assets/images/q3.jpg">
      </div>
      <button onclick="toggleTexto(0)">Mission</button>
      <p>Improve the quality of education for children and young people through ICT tools and training, contributing to the community development of the northwest region of the State of Mexico.</p>
    </div>

    <div class="mvo-item">
      <div class="img-box">
        <img src="https://semartec.org/assets/images/q2.jpg" class="active">
        <img src="https://semartec.org/assets/images/q1.jpg">
      </div>
      <button onclick="toggleTexto(1)">Vision</button>
      <p>To be a consolidated civil association, empowering communities with better development opportunities, achieving a better educational level through the use of technological tools.</p>
    </div>

    <div class="mvo-item">
      <div class="img-box">
        <img src="https://semartec.org/assets/images/q3.jpg" class="active">
        <img src="https://semartec.org/assets/images/a3.jpg">
      </div>
      <button onclick="toggleTexto(2)">Objective</button>
      <p>Improve the Quality of Education in indigenous and rural communities through Technological Access.</p>
    </div>
  </section>

  <section class="indicadores">
    <h2>BENEFICIARIES</h2>
    <div class="indicadores-contenedor">
      <div class="indicador">
        <i class="fa-solid fa-school"></i>
        <h3>92</h3>
        <p>Connected Schools</p>
      </div>
      <div class="indicador">
        <i class="fa-solid fa-tower-cell"></i>
        <h3>80</h3>
        <p>Intervened Communities</p>
      </div>
      <div class="indicador">
        <i class="fa-solid fa-user-graduate"></i>
        <h3>11,572</h3>
        <p>Benefited Students</p>
      </div>
      <div class="indicador">
        <i class="fa-solid fa-face-smile"></i>
        <h3>5000</h3>
        <p>Smiles Received</p>
      </div>
    </div>
  </section>

  <footer>
    <div class="footer-left">
      <p>We are a group of young people with technological knowledge...</p>
      <p>📞 52712124204</p>
      <p>✉️ semartec@gmail.com</p>
    </div>
    <div class="footer-right">
      <a href="https://www.facebook.com/share/1AQuEKkAmf/" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/semartecac/" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://wa.me/527121890269" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>
  </footer>

  <script>
    const sliders = document.querySelectorAll('.slider');
    sliders.forEach(slider => {
      const imgs = slider.querySelectorAll('img');
      let i = 0;
      setInterval(() => {
        imgs[i].classList.remove('active');
        i = (i + 1) % imgs.length;
        imgs[i].classList.add('active');
      }, 4000);
    });

    function toggleTexto(index) {
      const textos = document.querySelectorAll('.mvo-item p');
      textos[index].style.display = textos[index].style.display === 'block' ? 'none' : 'block';
    }
  </script>
</body>
</html>
