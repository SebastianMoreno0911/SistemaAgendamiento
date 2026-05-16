<?php 
$redirect = $_POST['redirect'] ?? null;
require_once __DIR__ .'/../config/conexionDB.php';

// recibir los datos del form
$tipo_documento = $_POST['tipo_id'];
$documento = $_POST['numero_id'];

// query para la bd en busca del usuer
$sql =" SELECT * FROM usuarios 
        where tipo_documento = :tipo_documento 
        and documento = :documento";

// preparar la consulta por PDO pero sin ejecutar
$stmt = $conexion->prepare($sql);

// ahora si se ejecuta y se cambian placeholder con los valores reales (que antes ya lo habia hecho pero mejor confirmar)
$stmt ->execute([
        ':tipo_documento' => $tipo_documento,
        ':documento' => $documento
]);




$usuario = $stmt->fetch(PDO::FETCH_ASSOC); // por medio del fetch trae el user y si no se encutra queda false

// aqui hago la pregunta si existe y redirijo al servicio correcto
if($usuario){
        session_start();
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        
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
}else{
        header("Location: ../pages/crear_usuario.php?tipo_documento=$tipo_documento&documento=$documento&redirect=$redirect");
        exit;
}

      ?>