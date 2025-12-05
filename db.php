<?php
// db.php
$DB_HOST = 'localhost';
$DB_USER = 'root';    // ajusta según tu entorno
$DB_PASS = '';        // ajusta según tu entorno
$DB_NAME = 'semartec_users';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_errno) {
    die("DB connection error: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
