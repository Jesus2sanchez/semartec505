<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Crear Cuenta - SEMARTEC</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-200 to-blue-400 flex items-center justify-center p-6">
  <div class="w-full max-w-md bg-white rounded-2xl p-8 shadow-xl">
    <h2 class="text-2xl font-bold text-center text-blue-700 mb-4">Crear Cuenta</h2>

    <?php if(isset($_GET['error'])): ?>
      <div class="text-red-600 mb-3">Error al crear la cuenta. Intenta de nuevo.</div>
    <?php endif; ?>

    <form action="save_user.php" method="POST" class="space-y-4">
      <input name="nombre" type="text" required placeholder="Nombre completo" class="w-full p-3 border rounded-lg" />
      <input name="email" type="email" required placeholder="Correo electrónico" class="w-full p-3 border rounded-lg" />
      <input name="password" type="password" required placeholder="Contraseña" class="w-full p-3 border rounded-lg" />
      <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-bold">Registrarme</button>
    </form>

    <p class="text-center mt-4">¿Ya tienes cuenta? <a href="login.php" class="text-blue-700">Iniciar sesión</a></p>
  </div>
</body>
</html>
