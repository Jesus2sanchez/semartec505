<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$pass  = $_POST['password'] ?? '';

if (!$email || !$pass) {
    header('Location: login.php?error=1');
    exit;
}

$stmt = $conn->prepare("SELECT id, nombre, email, password_hash, rol FROM usuarios WHERE email = ? LIMIT 1");
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res && $res->num_rows === 1) {
    $user = $res->fetch_assoc();

    if (password_verify($pass, $user['password_hash'])) {

        session_regenerate_id(true);

        // 🔥 NOMBRES EXACTOS QUE USA TU index.php 🔥
        $_SESSION['usuario_id']     = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];
        $_SESSION['usuario_email']  = $user['email'];
        $_SESSION['usuario_rol']    = $user['rol'];

        // Mensaje flash opcional
        $_SESSION['flash'] = "Sesión iniciada con éxito";

        header('Location: index.php');
        exit;
    }
}

header('Location: login.php?error=1');
exit;
?>