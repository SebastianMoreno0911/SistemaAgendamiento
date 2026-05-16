<?php require_once __DIR__ . '/PDOconfig.php';

try{
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "conectado a $dbname desde $host";
} catch (PDOException $pe) { 
    // die ("no se conecta a la base de datos $dbname :" . $pe->getMessage());
}