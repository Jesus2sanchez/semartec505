<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar Sesión - SEMARTEC</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-200 to-blue-400 flex items-center justify-center p-6">
  <div class="w-full max-w-md bg-white rounded-2xl p-8 shadow-xl">
    <h2 class="text-2xl font-bold text-center text-blue-700 mb-4">Iniciar Sesión</h2>

    <?php if(isset($_GET['error'])): ?>
      <div class="text-red-600 mb-3">Correo o contraseña incorrectos.</div>
    <?php elseif(isset($_GET['registered'])): ?>
      <div class="text-green-600 mb-3">Cuenta creada. Ya puedes iniciar sesión.</div>
    <?php endif; ?>

    <form action="verify_login.php" method="POST" class="space-y-4">
      <input name="email" type="email" required placeholder="Correo electrónico" class="w-full p-3 border rounded-lg" />
      
      <!-- CORREGIDO: nme -> name -->
      <input name="password" type="password" required placeholder="Contraseña" class="w-full p-3 border rounded-lg" />

      <button class="w-full bg-blue-700 hover:bg-blue-800 text-white py-3 rounded-lg font-bold">Iniciar Sesión</button>
    </form>

    <p class="text-center mt-4">¿No tienes cuenta? 
      <a href="register.php" class="text-blue-700">Crear una</a>
    </p>
  </div>
</body>
</html>
