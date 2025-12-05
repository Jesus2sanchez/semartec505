<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$email  = trim($_POST['email'] ?? '');
$pass   = $_POST['password'] ?? '';

if (!$nombre || !$email || !$pass) {
    header('Location: register.php?error=1');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: register.php?error=1');
    exit;
}

// comprobar duplicados
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ? LIMIT 1");
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->close();
    header('Location: register.php?error=1');
    exit;
}
$stmt->close();

$hash = password_hash($pass, PASSWORD_DEFAULT);
$ins = $conn->prepare("INSERT INTO usuarios (nombre, email, password_hash) VALUES (?, ?, ?)");
$ins->bind_param('sss', $nombre, $email, $hash);

if ($ins->execute()) {
    header('Location: login.php?registered=1');
    exit;
} else {
    header('Location: register.php?error=1');
    exit;
}
