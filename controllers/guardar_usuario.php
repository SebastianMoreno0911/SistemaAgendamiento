<?php
session_start();
require_once __DIR__ . '/../config/conexionDB.php';

$nombre = $_POST['nombre'] ?? null;
$apellido = $_POST['apellido'] ?? null;
$tipo_documento = $_POST['tipo_documento'] ?? null;
$documento = $_POST['documento'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$correo_electronico = $_POST['correo_electronico'] ?? null;
$redirect = $_POST['redirect'] ?? null;

if (!$nombre || !$apellido || !$tipo_documento || !$documento || !$telefono || !$correo_electronico) {
    header("Location: ../pages/login.php");
    exit;
}

$sql = "INSERT INTO usuarios
(nombre, apellido, tipo_documento, documento, telefono, correo_electronico)
VALUES
(:nombre, :apellido, :tipo_documento, :documento, :telefono, :correo_electronico)
";

// Preparar la consulta
$stmt = $conexion->prepare($sql);

// Ejecutar con los valores reales (esto es lo que faltaba)
$stmt->execute([
    ':nombre' => $nombre,
    ':apellido' => $apellido,
    ':tipo_documento' => $tipo_documento,
    ':documento' => $documento,
    ':telefono' => $telefono,
    ':correo_electronico' => $correo_electronico
]);

// Ahora si capturamos el ID del usuario recien creado
$id_usuario = $conexion->lastInsertId();

$_SESSION['id_usuario'] = $id_usuario;

if ($redirect === "ver_citas") {
    header("Location: ../pages/ver_citas.php");
    exit;
}

if ($redirect === "cancelar_cita") {
    header("Location: ../pages/ver_citas.php?mode=cancelar");
    exit;
}

header("Location: ../pages/servicio.php");
exit;