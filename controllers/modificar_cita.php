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
    header("Location: ../pages/ver_citas.php?error=1");
    exit;
}

$sql = "SELECT c.id_tramite, o.id_ciudad, ci.id_region, o.id_oficina
        FROM citas c
        JOIN oficinas o ON c.id_oficina = o.id_oficina
        JOIN ciudades ci ON o.id_ciudad = ci.id_ciudad
        WHERE c.id_cita = :id_cita
          AND c.id_usuario = :id_usuario";

$stmt = $conexion->prepare($sql);
$stmt->execute([
    ':id_cita' => $id_cita,
    ':id_usuario' => $id_usuario
]);

$cita = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cita) {
    header("Location: ../pages/ver_citas.php?error=2");
    exit;
}

header("Location: ../pages/oficina.php?id_tramite={$cita['id_tramite']}&id_region={$cita['id_region']}&id_ciudad={$cita['id_ciudad']}&id_oficina={$cita['id_oficina']}");
exit;
?>