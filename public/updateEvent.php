<?php
// Conectar a la base de datos
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Carga el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$conexion = mysqli_connect(
  $_ENV['DB_HOST'],
  $_ENV['DB_USERNAME'],
  $_ENV['DB_PASSWORD'],
  $_ENV['DB_DATABASE'],
  $_ENV['DB_PORT']
);
// Obtener los datos enviados por AJAX
$id = $_POST["id"];
$newStart = $_POST["start"];
$newEnd = $_POST["end"];

// Escribir la consulta SQL de actualización
$sql = "UPDATE calendario SET start='$newStart', end='$newEnd' WHERE id='$id'";

// Ejecutar la consulta SQL
if (mysqli_query($conexion, $sql)) {
  echo json_encode(array("success" => true));
} else {
  echo json_encode(array("success" => false, "error" => mysqli_error($conexion)));
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
