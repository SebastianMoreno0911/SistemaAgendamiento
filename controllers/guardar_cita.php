<?php //conexion de la bd 
session_start(); //memoria de sesion
require_once __DIR__ .'/../config/conexionDB.php';

// que exista usuario
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../pages/login.php");
    exit;
}

// recibir datos del form y ayuda del null
$id_usuario =$_SESSION['id_usuario'];
$id_tramite =$_POST['id_tramite'] ?? null;
$id_oficina =$_POST['id_oficina'] ?? null;
$fecha_cita =$_POST['fecha_cita'] ?? null;
$hora_cita =$_POST['hora_cita'] ?? null;
$id_region = $_POST['id_region'] ?? null;
$id_ciudad = $_POST['id_ciudad'] ?? null;


// que no falten datos
if (!$id_tramite || !$id_oficina || !$fecha_cita || !$hora_cita) {
    header("Location: ../pages/servicio.php");
    exit;
}

// estado inicial (activa)
$id_estado = 1;


// ver si la hora esta ocupada antes de guardar (antes) 0 esta libre 1 o mas esta ocupado
//count para contar cuantas citas existen con esa misma oficina fecha y hora
$sql= "SELECT COUNT(*) 
        FROM citas
        WHERE id_oficina = :id_oficina
        AND fecha_cita = :fecha_cita
        AND hora_cita = :hora_cita";

$stmt = $conexion->prepare($sql);

$stmt->execute([
':id_oficina' =>$id_oficina,
':fecha_cita' =>$fecha_cita,
':hora_cita' =>$hora_cita,
]);

$existeCita = $stmt->fetchColumn();

if ($existeCita > 0) {
    header("Location: ../pages/oficina.php?id_tramite=$id_tramite&id_oficina=$id_oficina&fecha_cita=$fecha_cita&id_region=$id_region&id_ciudad=$id_ciudad");
    exit;
}

//guardar la cita (insert)
$sql = "INSERT INTO citas
        (id_usuario, id_oficina, id_tramite, fecha_cita, hora_cita, id_estado)
        VALUES
        (:id_usuario, :id_oficina, :id_tramite, :fecha_cita, :hora_cita, :id_estado)";

$stmt = $conexion->prepare($sql);

$stmt->execute([
    ':id_usuario' => $id_usuario, 
    ':id_oficina' => $id_oficina,
    ':id_tramite' => $id_tramite,
    ':fecha_cita' => $fecha_cita, 
    ':hora_cita' => $hora_cita, 
    ':id_estado' => $id_estado
]);


// guardar la cita (insert)
$sql = "INSERT INTO citas
        (id_usuario, id_oficina, id_tramite, fecha_cita, hora_cita, id_estado)
        VALUES
        (:id_usuario, :id_oficina, :id_tramite, :fecha_cita, :hora_cita, :id_estado)";

$stmt = $conexion->prepare($sql);

$stmt->execute([
    ':id_usuario' => $id_usuario, 
    ':id_oficina' => $id_oficina,
    ':id_tramite' => $id_tramite,
    ':fecha_cita' => $fecha_cita, 
    ':hora_cita' => $hora_cita, 
    ':id_estado' => $id_estado
]);

// Redirigir a ver_citas para mostrar la cita agendada (mantener sesión activa)
header("Location: ../pages/ver_citas.php");
exit;