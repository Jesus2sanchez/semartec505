<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SEMARTEC - Donate</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

  <style>
    body {
      background: linear-gradient(120deg, #004aad, #0073e6, #00aaff);
      background-size: 600% 600%;
      animation: gradientMove 15s ease infinite;
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    header {
      background: rgba(0, 0, 0, 0.45);
      backdrop-filter: blur(15px);
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      box-shadow: 0 5px 25px rgba(0,0,0,0.3);
    }

    header nav a {
      transition: 0.3s;
    }

    header nav a:hover {
      color: #ffcc00;
    }

    .hero {
      text-align: center;
      color: white;
      padding: 180px 10% 60px;
    }

    .hero h1 {
      font-size: 2.7rem;
      font-weight: 800;
      background: rgba(0, 74, 173, 0.75);
      padding: 10px 25px;
      border-radius: 10px;
      display: inline-block;
      margin-bottom: 20px;
      text-shadow: 0 3px 10px rgba(0,0,0,0.4);
      animation: fadeInDown 1.5s ease;
    }

    .hero p {
      font-size: 1.15rem;
      max-width: 700px;
      margin: 0 auto;
      line-height: 1.7;
      color: rgba(255,255,255,0.9);
      background: rgba(0,0,0,0.4);
      padding: 15px 25px;
      border-radius: 12px;
      animation: fadeInUp 1.5s ease;
    }

    @keyframes fadeInDown {
      0% { opacity: 0; transform: translateY(-40px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(40px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .donar-card {
      backdrop-filter: blur(25px);
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 1.5rem;
      box-shadow: 0 10px 40px rgba(0,0,0,0.25);
      max-width: 600px;
      margin: 3rem auto 6rem;
      padding: 2.5rem;
      text-align: center;
      color: white;
      transition: all 0.4s ease;
      animation: fadeInUp 1.8s ease;
    }

    .donar-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 50px rgba(0,0,0,0.4);
    }

    .donar-btn {
      background: rgba(255,255,255,0.15);
      border: 1px solid rgba(255,255,255,0.3);
      color: white;
      font-weight: 600;
      padding: 0.8rem 1.6rem;
      border-radius: 50px;
      transition: all 0.3s ease;
    }

    .donar-btn:hover {
      background: rgba(255,255,255,0.3);
      transform: scale(1.08);
      box-shadow: 0 0 15px rgba(255,255,255,0.7);
    }

    input {
      background: rgba(255,255,255,0.15);
      border: 1px solid rgba(255,255,255,0.3);
      color: white;
      border-radius: 50px;
      text-align: center;
      padding: 0.7rem;
      width: 100%;
      transition: all 0.3s ease;
    }

    input:focus {
      outline: none;
      box-shadow: 0 0 10px #ffcc00;
    }

    footer {
      background: linear-gradient(135deg, #004aad, #002b6d);
      color: white;
      padding: 60px 10%;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      align-items: flex-start;
    }

    footer a {
      color: white;
      font-size: 30px;
      transition: 0.3s ease;
    }

    footer a:hover {
      color: #ffcc00;
      transform: scale(1.2) rotate(5deg);
    }
  </style>
</head>

<body>

  <!-- HEADER -->
  <header class="text-white py-4 px-6 flex justify-between items-center">
    <div class="logo-contenedor">
      <img src="logo.png" alt="Semartec Logo" style="height:55px;width:55px;border-radius:50%">
      <span class="nombre-logo">SEMARTEC, A.C.</span>
    </div>

    <nav>
      <ul class="flex space-x-6 text-white font-medium">
        <li><a href="index.php">Start</a></li>
        <li><a href="quienes_somos.php">Who We Are</a></li>
        <li><a href="acceso_tecnologico.php">Technological Access</a></li>
        <li><a href="noticias.php">News</a></li>
        <li><a href="donar.php">Donate</a></li>
        <li><a href="admin.php">Administrator</a></li>
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

  <!-- HERO -->
  <section class="hero">
    <h1>💙 Donate and Change Lives</h1>
    <p>
      With your support we bring technology, education, and opportunities to communities in need.
    </p>
  </section>

  <!-- DONATION CARD -->
  <div class="donar-card">

    <div class="mb-6">
      <i class="fa-solid fa-hand-holding-heart text-6xl text-yellow-300 drop-shadow-lg"></i>
    </div>

    <h2 class="text-2xl font-bold mb-3">Your Contribution Makes a Difference</h2>
    <p class="text-white text-opacity-90 mb-6">
      Select an amount or enter your own 💙
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
      <button class="donar-btn">$100 MXN</button>
      <button class="donar-btn">$250 MXN</button>
      <button class="donar-btn">$500 MXN</button>
    </div>

    <input type="number" placeholder="Other amount..." class="mb-6">

    <!-- NEW MODERN PAYMENT FORM -->
    <form id="paymentForm" class="mt-10 p-6 rounded-2xl bg-white/20 backdrop-blur-xl border border-white/30 shadow-xl space-y-5">

      <h3 class="text-xl font-bold text-center text-white mb-4">
        💳 Secure Payment Information
      </h3>

      <div class="flex items-center bg-white/20 rounded-full px-4 py-2 border border-white/30">
        <i class="fa-solid fa-user text-white mr-3"></i>
        <input type="text" id="name" placeholder="Full Name" required class="bg-transparent text-white placeholder-white/70 w-full focus:outline-none">
      </div>

      <div class="flex items-center bg-white/20 rounded-full px-4 py-2 border border-white/30">
        <i class="fa-solid fa-envelope text-white mr-3"></i>
        <input type="email" id="email" placeholder="Email" required class="bg-transparent text-white placeholder-white/70 w-full focus:outline-none">
      </div>

      <div class="flex items-center bg-white/20 rounded-full px-4 py-2 border border-white/30">
        <i class="fa-solid fa-credit-card text-white mr-3"></i>
        <input type="text" id="cardNumber" maxlength="16" placeholder="Card Number" required class="bg-transparent text-white placeholder-white/70 w-full focus:outline-none">
      </div>

      <div class="grid grid-cols-2 gap-4">

        <div class="flex items-center bg-white/20 rounded-full px-4 py-2 border border-white/30">
          <i class="fa-solid fa-calendar text-white mr-3"></i>
          <input type="text" id="expiration" maxlength="5" placeholder="MM/YY" required class="bg-transparent text-white placeholder-white/70 w-full focus:outline-none">
        </div>

        <div class="flex items-center bg-white/20 rounded-full px-4 py-2 border border-white/30">
          <i class="fa-solid fa-lock text-white mr-3"></i>
          <input type="text" id="cvv" maxlength="3" placeholder="CVV" required class="bg-transparent text-white placeholder-white/70 w-full focus:outline-none">
        </div>

      </div>

      <p id="errorMsg" class="text-red-300 font-bold hidden text-center"></p>

      <button type="submit" class="w-full mt-4 py-3 rounded-full bg-yellow-400 font-bold text-black text-lg hover:bg-yellow-300 transition-transform transform hover:scale-[1.03]">
        <i class="fa-solid fa-credit-card"></i> Donate Now
      </button>

    </form>

    <p class="text-sm mt-4 text-white text-opacity-80">
      💯 100% of your donation goes to technological and community projects.
    </p>

  </div>

  <!-- FOOTER -->
  <footer>
    <div class="max-w-md">
      <p>
        We are a group of young people with technological knowledge and a great passion
        for transforming our Mazahua communities through innovation.
      </p>
      <p class="mt-3">📞 52712124204</p>
      <p>✉️ semartec@gmail.com</p>
    </div>

    <div class="flex gap-6 mt-6 md:mt-0">
      <a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
      <a href="https://www.instagram.com/jesus_sc_4?igsh=bGZpZDFidngyMGpj" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://wa.me/527121741780" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>
  </footer>

  <!-- JS VALIDATION -->
  <script>
    document.getElementById("paymentForm").addEventListener("submit", function(e) {
      e.preventDefault();

      const cardNumber = document.getElementById("cardNumber").value;
      const errorMsg = document.getElementById("errorMsg");

      const validCard = "5555444433332222";

      if (cardNumber !== validCard) {
        errorMsg.textContent = "Card number does not exist.";
        errorMsg.classList.remove("hidden");
        return;
      }

      errorMsg.classList.add("hidden");
      alert("Donation completed successfully! (Simulation Only)");
    });
  </script>

</body>
</html>
