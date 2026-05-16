<?php
session_start();
require_once __DIR__ . '/../config/conexionDB.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../pages/login.php");
    exit;
}

$id_cita = $_POST['id_cita'] ?? null;
$id_usuario = $_SESSION['id_usuario'];

if (!$id_cita) {
    header("Location: ../pages/ver_citas.php?error=1"); // Error: cita no especificada
    exit;
}

// Verifica que la cita pertenezca al usuario
$sql = "SELECT id_usuario 
        FROM citas 
        WHERE id_cita = :id_cita";
$stmt = $conexion->prepare($sql);
$stmt->execute([':id_cita' => $id_cita]);
$cita = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cita || $cita['id_usuario'] != $id_usuario) {
    header("Location: ../pages/ver_citas.php?error=2"); // Error: no es tu cita
    exit;
}

// Actualizar estado a cancelada (id_estado=2 (cancelada))
$sql = "UPDATE citas SET id_estado = 2 WHERE id_cita = :id_cita";
$stmt = $conexion->prepare($sql);
$stmt->execute([':id_cita' => $id_cita]);

header("Location: ../pages/ver_citas.php?success=cancelada"); // Éxito
exit;
?>